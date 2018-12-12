<div class="col-md-9">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body" id="page_soal">

            <?php
                error_reporting(0);
                if (!($_SESSION['siswa_id'])) {
                    header("location:$base_url");
                }
                else
                {
                    include "../config/datetime.php";

                    if ($_SESSION['siswa_id'])
                    {

                        $get_soal = mysqli_query($conn, "SELECT * FROM vw_soal WHERE aktif ='aktif' AND blokir ='n' AND soal_aktif_id = '$_GET[sai]' AND materi_soal_id = '$_GET[msi]' AND siswa_id = '$_SESSION[siswa_id]'") or die(mysqli_error());

                        $status_soal = mysqli_query($conn, "SELECT * FROM tb_soal_aktif WHERE materi_soal_id = '$_GET[msi]' AND soal_aktif_id = '$_GET[sai]'");

                        $c = mysqli_fetch_assoc($status_soal);
                        $status = mysqli_num_rows($status_soal);

                        if($status<=0)
                        {
                            echo "status soal tidak aktif";
                        }
                        else
                        {

                            // cek lagi ada yang dikerjain apa tidak
                            $cari_mulai = mysqli_query($conn, "SELECT * FROM ujian_kerjakan WHERE kerjakan_userid = '$_SESSION[siswa_id]' 
                            AND kerjakan_status = 'mulai'
                            AND kerjakan_soalaktifid != '$_GET[sai]' AND kerjakan_materisoalid != '$_GET[msi]'");
                            $cek_mulai = mysqli_num_rows($cari_mulai);

                            if($cek_mulai > 0)
                            {
                                echo"
                                <div class='alert alert-warning alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                <h4><i class='icon fa fa-warning'></i> Peringatan</h4>
                                <h4>Anda masih mengerjakan tugas lain, klik di <span class='badge btn-twitter'> <a href='$base_url/siswa/pages.php?q=pilih-soal'>sini</a> </span> untuk kembali !</h4?
                                </div>";
                                die();
                            }

                            // cek di ujian_kerjakan ada data / tidak
                            $get_kerjakan = mysqli_query($conn, "SELECT * FROM ujian_kerjakan WHERE kerjakan_userid = '$_SESSION[siswa_id]' 
                            AND YEAR(kerjakan_createdate) = '$y' AND MONTH(kerjakan_createdate) = '$m' AND DAY(kerjakan_createdate) = '$d'
                            AND kerjakan_soalaktifid = '$_GET[sai]' AND kerjakan_materisoalid = '$_GET[msi]'");
                            $cek_kerjakan = mysqli_num_rows($get_kerjakan);

                            if ($cek_kerjakan == 0) {

                                // $data = mysqli_fetch_assoc($get_soal);
                                // trace($data);
                                // die();

                                $mulai = $c['tgl'] .' '.$c['jam'];
                                $selesai = date('Y-m-d H:i:s', strtotime("+ $c[menit] minutes", strtotime($mulai)));

                                $jam_selesai = strtotime($selesai);
                                $now = strtotime(date('Y-m-d H:i:s'));

                                // trace($jam_selesai);
                                // trace($now);
                                // die();

                                if($jam_selesai<$now)
                                {
                                    echo"
                                    <div class='alert alert-warning alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                    <h4><i class='icon fa fa-warning'></i> Peringatan</h4>
                                    <h4>Tanggal dan jam selesai TUGAS telah lewat, klik di <span class='badge btn-twitter'> <a href='$base_url/siswa/pages.php?q=pilih-soal'>sini</a> </span> untuk kembali !</h4?
                                    </div>";
                                    die();
                                }
                                elseif (strtotime($mulai) > strtotime(date("Y-m-d H:i:s")))
                                {
                                    echo"
                                    <div class='alert alert-warning alert-dismissible'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                                    <h4><i class='icon fa fa-warning'></i> Peringatan</h4>
                                    <h4>Belum Saatnya Anda mengerjakan !, klik di <span class='badge btn-twitter'> <a href='$base_url/siswa/pages.php?q=pilih-soal'>sini</a> </span> untuk kembali !</h4?
                                    </div>";
                                    die();
                                }



                                // $jam_selesai = $data['kerjakan_selesai'];
                                // print_r($jam_selesai);
                                // die();


                                /*proses simpan*/

                                $field_value['id']      = rand(9, 999999);
                                $field_value            = ['mulai' => $mulai, 'selesai' => $selesai];

                                while($soal= mysqli_fetch_assoc($get_soal)){
                                    $soal = preg_replace('/\s+/', ' ', $soal);
                                    $field_value['soal'][]  = str_replace(array("<p>","</p>","\n","\r",'"',"alt= "), "", $soal);
                                }

                                $array = json_encode($field_value, JSON_UNESCAPED_UNICODE);


                                // print_r($array);
                                // die();

                                $kolom = "(kerjakan_userid,kerjakan_data,kerjakan_status,kerjakan_createdate,kerjakan_soalaktifid,kerjakan_materisoalid,kerjakan_mulai,kerjakan_selesai)";
                                $nilai = "('$_SESSION[siswa_id]','$array','mulai','$tgl','$_GET[sai]','$_GET[msi]','$mulai','$selesai')";

                                $save = simpan('ujian_kerjakan',$kolom,$nilai, $conn);

                                $get_data = mysqli_query($conn, "SELECT * FROM ujian_kerjakan WHERE kerjakan_userid = '$_SESSION[siswa_id]'
                                AND YEAR(kerjakan_createdate) = '$y' AND MONTH(kerjakan_createdate) = '$m' AND DAY(kerjakan_createdate) = '$d'
                                AND kerjakan_status = 'mulai' AND kerjakan_info = 'mengerjakan'
                                AND kerjakan_soalaktifid = '$_GET[sai]' AND kerjakan_materisoalid = '$_GET[msi]'");
                                $row=mysqli_fetch_assoc($get_data);
                                $kerjakan = json_decode($row['kerjakan_data']);

                                // trace($kerjakan);
                                // die('erik');

                                $no=1;

                                shuffle($kerjakan->soal);

                                echo "<input type='hidden' id='final_date' value='$kerjakan->selesai'>";

                                foreach ($kerjakan->soal as $key => $value) { ?>
                                    <form action=?q=hasil&msi=<?php echo $_GET['msi']?>&sai=<?php echo $_GET['sai']?> method='post'>
                                    <h4><span class="badge btn-twitter"><?php echo $no.'</span> <span class="pilihan-ep">'.$value->soal; ?></span></h4>
                                    <div class='row'>
                                    <div class='col-md-12'>
                                    <span class="badge bg-teal">A</span> <input <?php if(is_pilih($value->soal_id.'a',$value->soal_aktif_id,$value->materi_soal_id, $conn) == '1') echo 'checked'; ?> type='radio' value='a' name='pilih[<?php echo $value->soal_id; ?>]' onclick="update_ganda(<?php echo $value->soal_id ?>,'a',<?php echo $value->soal_aktif_id ?>,<?php echo $value->materi_soal_id ?>)"><span class="pilihan-ep"><?php echo $value->a ?></span><br>
                                    <span class="badge bg-teal">B</span> <input <?php if(is_pilih($value->soal_id.'b',$value->soal_aktif_id,$value->materi_soal_id, $conn) == '1') echo 'checked'; ?> type='radio' value='b' name='pilih[<?php echo $value->soal_id; ?>]' onclick="update_ganda(<?php echo $value->soal_id ?>,'b',<?php echo $value->soal_aktif_id ?>,<?php echo $value->materi_soal_id ?>)"><span class="pilihan-ep"><?php echo $value->b ?></span><br>
                                    <span class="badge bg-teal">C</span> <input <?php if(is_pilih($value->soal_id.'c',$value->soal_aktif_id,$value->materi_soal_id, $conn) == '1') echo 'checked'; ?> type='radio' value='c' name='pilih[<?php echo $value->soal_id; ?>]' onclick="update_ganda(<?php echo $value->soal_id ?>,'c',<?php echo $value->soal_aktif_id ?>,<?php echo $value->materi_soal_id ?>)"><span class="pilihan-ep"><?php echo $value->c ?></span><br>
                                    <span class="badge bg-teal">D</span> <input <?php if(is_pilih($value->soal_id.'d',$value->soal_aktif_id,$value->materi_soal_id, $conn) == '1') echo 'checked'; ?> type='radio' value='d' name='pilih[<?php echo $value->soal_id; ?>]' onclick="update_ganda(<?php echo $value->soal_id ?>,'d',<?php echo $value->soal_aktif_id ?>,<?php echo $value->materi_soal_id ?>)"><span class="pilihan-ep"><?php echo $value->d ?></span><br>
                                    <span class="badge bg-teal">E</span> <input <?php if(is_pilih($value->soal_id.'e',$value->soal_aktif_id,$value->materi_soal_id, $conn) == '1') echo 'checked'; ?> type='radio' value='e' name='pilih[<?php echo $value->soal_id; ?>]' onclick="update_ganda(<?php echo $value->soal_id ?>,'e',<?php echo $value->soal_aktif_id ?>,<?php echo $value->materi_soal_id ?>)"><span class="pilihan-ep"><?php echo $value->e ?></span><br><br>
                                    </div>
                                    </div><br>

                                <?php $no++; } ?>

                                <button type='submit' id="submit" onClick="return confirm('Yakin dengan jawaban Anda ?')" class="btn btn bg-purple btn-flat">S E L E S A I</button>
                                <input type='submit' id="kirim">
                                </form>

                            <?php } else {

                                $get_data = mysqli_query($conn, "SELECT * FROM ujian_kerjakan WHERE kerjakan_userid = '$_SESSION[siswa_id]'
                                AND YEAR(kerjakan_createdate) = '$y' AND MONTH(kerjakan_createdate) = '$m' AND DAY(kerjakan_createdate) = '$d'
                                AND kerjakan_status = 'mulai' AND kerjakan_info = 'mengerjakan'
                                AND kerjakan_soalaktifid = '$_GET[sai]' AND kerjakan_materisoalid = '$_GET[msi]'");
                                $row=mysqli_fetch_assoc($get_data);
                                $kerjakan = json_decode($row['kerjakan_data']);

                                // trace(mysqli_num_rows($get_data));
                                // die();

                                if(mysqli_num_rows($get_data) == 0){
                                    echo"
                                    <div class='callout callout-warning'>
                                    <h4>Perhatian!</h4>
                                    <p>Anda telah mengerjakan soal ini ! Klik di <span class='badge btn-twitter'> <a href='pages.php?q=pilih-soal'>sini</a> </span> untuk kembali.</p>
                                    </div>";

                                } else {

                                    $no=1;

                                // trace($kerjakansoal->soal);
                                // die();



                                    shuffle($kerjakan->soal);

                                    echo "<input type='hidden' id='final_date' value='$kerjakan->selesai'>";

                                    foreach ($kerjakan->soal as $key => $value) { ?>
                                        <form action=?q=hasil&msi=<?php echo $_GET['msi']?>&sai=<?php echo $_GET['sai']?> method='post'>

                                        <h4><span class="badge btn-twitter"><?php echo $no.'</span> <span class="pilihan-ep">'.$value->soal; ?></span></h4>
                                        <div class='row'>
                                        <div class='col-md-12'>
                                        <span class="badge bg-teal">A</span> <input <?php if(is_pilih($value->soal_id.'a',$value->soal_aktif_id,$value->materi_soal_id, $conn) == '1') echo 'checked'; ?> type='radio' value='a' name='pilih[<?php echo $value->soal_id; ?>]' onclick="update_ganda(<?php echo $value->soal_id ?>,'a',<?php echo $value->soal_aktif_id ?>,<?php echo $value->materi_soal_id ?>)"><span class="pilihan-ep"><?php echo $value->a ?></span><br>
                                        <span class="badge bg-teal">B</span> <input <?php if(is_pilih($value->soal_id.'b',$value->soal_aktif_id,$value->materi_soal_id, $conn) == '1') echo 'checked'; ?> type='radio' value='b' name='pilih[<?php echo $value->soal_id; ?>]' onclick="update_ganda(<?php echo $value->soal_id ?>,'b',<?php echo $value->soal_aktif_id ?>,<?php echo $value->materi_soal_id ?>)"><span class="pilihan-ep"><?php echo $value->b ?></span><br>
                                        <span class="badge bg-teal">C</span> <input <?php if(is_pilih($value->soal_id.'c',$value->soal_aktif_id,$value->materi_soal_id, $conn) == '1') echo 'checked'; ?> type='radio' value='c' name='pilih[<?php echo $value->soal_id; ?>]' onclick="update_ganda(<?php echo $value->soal_id ?>,'c',<?php echo $value->soal_aktif_id ?>,<?php echo $value->materi_soal_id ?>)"><span class="pilihan-ep"><?php echo $value->c ?></span><br>
                                        <span class="badge bg-teal">D</span> <input <?php if(is_pilih($value->soal_id.'d',$value->soal_aktif_id,$value->materi_soal_id, $conn) == '1') echo 'checked'; ?> type='radio' value='d' name='pilih[<?php echo $value->soal_id; ?>]' onclick="update_ganda(<?php echo $value->soal_id ?>,'d',<?php echo $value->soal_aktif_id ?>,<?php echo $value->materi_soal_id ?>)"><span class="pilihan-ep"><?php echo $value->d ?></span><br>
                                        <span class="badge bg-teal">E</span> <input <?php if(is_pilih($value->soal_id.'e',$value->soal_aktif_id,$value->materi_soal_id, $conn) == '1') echo 'checked'; ?> type='radio' value='e' name='pilih[<?php echo $value->soal_id; ?>]' onclick="update_ganda(<?php echo $value->soal_id ?>,'e',<?php echo $value->soal_aktif_id ?>,<?php echo $value->materi_soal_id ?>)"><span class="pilihan-ep"><?php echo $value->e ?></span><br><br>
                                        </div>
                                        </div><br>

                                    <?php $no++; } ?>

                                    <button type='submit' id="submit" onClick="return confirm('Yakin dengan jawaban Anda ?')" class="btn btn bg-purple btn-flat">S E L E S A I</button>
                                    <input type='submit' id="kirim">
                                    </form>
                                <?php }
                            }
                        }
                    }
                }
            ?>

            <script type="text/javascript">
                function update_ganda(soal_id,soal_pilihan_id,sai,msi) {
                    $.ajax({
                        type : "POST",
                        url  : "pages/kerjakansoal/update.php",
                        data : "soal_id=" + soal_id + "&soal_pilihan_id=" + soal_pilihan_id + "&sai=" + sai  + "&msi=" + msi
                    });
                }
            </script>
        </div>
    </div>
</div>