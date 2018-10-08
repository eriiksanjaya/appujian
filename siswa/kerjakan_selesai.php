<?php

    include '../config/koneksi.php';
    include '../config/datetime.php';
    include '../config/url.php';

    session_start();


    // update selesai - history in ujian_kerjakan
    // ambil pilihan
    $get_data = mysqli_query($conn, "SELECT * FROM ujian_kerjakan WHERE kerjakan_userid = '$_SESSION[siswa_id]'
        AND YEAR(kerjakan_createdate) = '$y' AND MONTH(kerjakan_createdate) = '$m' AND DAY(kerjakan_createdate) = '$d'
        AND kerjakan_soalaktifid = '$_GET[sai]' AND kerjakan_materisoalid = '$_GET[msi]'");
    $row=mysqli_fetch_assoc($get_data);

    $kolom = "kerjakan_status = 'selesai', kerjakan_lastupdate = '$tgl', kerjakan_info = 'history'";
    $where = "kerjakan_id = $row[kerjakan_id]";

    $update = edit('ujian_kerjakan',$kolom,$where, $conn);

    $kerjakan = json_decode($row['kerjakan_data']);

    if (count($kerjakan->jawaban) > 0) {
        $opt = [];
        foreach ($kerjakan->jawaban as $key => $value) { 
            $opt['pilihan'][$key] = $key.$value;
        }

        // ambil kunci jawaban
        $kunci_soal = mysqli_query($conn, "SELECT * FROM vw_soal where aktif ='aktif' AND blokir ='n' AND materi_soal_id = '$_GET[msi]' AND siswa_id = '$_SESSION[siswa_id]'");
        // $pilihan = $r['jawaban'];
        $jml_soal = mysqli_num_rows($kunci_soal);

        while($r = mysqli_fetch_assoc($kunci_soal)){
            $data[] = $r;
        }

        $erik = [];
        foreach ($data as $key => $value) {
            $erik['kunci'][$value['soal_id']] = $value['soal_id'].$value['jawaban'];
        }

        // trace($opt);
        $benar = count(array_intersect($opt['pilihan'], $erik['kunci']));
        $salah = $jml_soal - $benar;
        // trace($salah);

        $persen_benar = round(($benar/$jml_soal)*100);
        $persen_salah = round(($salah/$jml_soal)*100);


        // cek nilai udah ada / belum
        $cek_nilai = mysqli_query($conn, "SELECT * FROM tb_nilai_siswa WHERE siswa_id = '$_SESSION[siswa_id]'
            AND materi_soal_id = '$_GET[msi]' AND YEAR(tgl) = '$y' AND MONTH(tgl) = '$m' AND DAY(tgl) = '$d'");
        if (mysqli_num_rows($cek_nilai) <= 0) {
        // save nilai
            $kolom = "(siswa_id,materi_soal_id,benar,salah,nilai,tgl,jam)";
            $nilai = "('$_SESSION[siswa_id]','$_GET[msi]','$benar','$salah','$persen_benar','$tgl','$jam')";
            $save = simpan('tb_nilai_siswa',$kolom,$nilai, $conn);
            $save = simpan('tb_nilai_guru',$kolom,$nilai, $conn);
        }
    }
?>
                
        <div class='col-md-12'>
            <div class='box box-primary'>
                <div class='box-body'>
                    <div class='callout callout-success'>
                        <h4>Perhatian!</h4>
                        <h4><i class='fa fa-info-circle sign'></i> Anda telah menyelesaikan soal, klik di <span class='badge btn-twitter'> <a href='<?php echo $base_url; ?>/siswa/pages.php?q=lihat-nilai'>sini</a> </span> untuk melihat semua nilai Anda  !</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class='col-md-12'>
            <div class="row">
                <div class='col-md-4'>
                    <div class="info-box">
                        <div class="">
                            <span class="text-center text-green"><p style="font-size: 18px; padding-top: 10px;">Nilai Benar</p></span>
                            <span class="text-center"><p style="font-size: 50px;"><?php echo @$benar ?></p></span>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class="info-box">
                        <div class="">
                            <span class="text-center text-red"><p style="font-size: 18px; padding-top: 10px;">Nilai Salah</p></span>
                            <span class="text-center"><p style="font-size: 50px;"><?php echo @$salah ?></p></span>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class="info-box">
                        <div class="">
                            <span class="text-center text-blue"><p style="font-size: 18px; padding-top: 10px;">Nilai Anda</p></span>
                            <span class="text-center"><p style="font-size: 50px;"><?php echo @$persen_benar ?></p></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class='box box-primary'>
                <div class='box-body'>
                    <?php
                    if($persen_benar >=90){
                        echo "
                        <h2 class='text-center'>Halo $_SESSION[nama_siswa], Nilai Anda <span class='text-primary'><strong>MEMUASKAN</strong> <i class='fa fa-smile-o'></i> <i class='fa fa-thumbs-o-up'></i> <i class='fa fa-trophy'></i></span></h2>";
                    } elseif ($persen_benar>=80) {
                        echo "
                        <h2 class='text-center'>Halo $_SESSION[nama_siswa], Nilai Anda <span class='text-success'><strong>BAGUS</strong> <i class='fa fa-smile-o'></i> <i class='fa fa-thumbs-o-up'></i></span></h2>";
                    } elseif ($persen_benar>=65) {
                        echo "
                        <h2 class='text-center'>Halo $_SESSION[nama_siswa], Nilai Anda <span class='text-warning'><strong>CUKUP</strong> <i class='fa fa-smile-o'></i></span></h2>";
                    } else {
                        echo "
                        <h2 class='text-center'>Halo $_SESSION[nama_siswa], Nilai Anda <span class='text-danger'><strong>KURANG</strong> <i class='fa fa-frown-o'></i></span></h2>";
                    }
                    ?>
                </div>
            </div>
        </div>
