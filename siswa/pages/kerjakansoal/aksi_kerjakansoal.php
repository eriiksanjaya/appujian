    <section class="content">
      <div class="row">
    <?php include"col-3.php"; ?>

<?php
error_reporting(0);
if (!($_SESSION['siswa_id'])){
  header("location:../../../");
}else{
  include "../config/datetime.php";
?>

<?php

if($_SERVER['REQUEST_METHOD'] != 'POST'){
  echo "
    <div class='col-md-9'>
      <div class='box box-primary'>
        <div class='box-body'>
          <div class='callout callout-danger'>
            <h4>Perhatian!</h4>
            <h3><i class='fa fa-exclamation-circle'></i><strong>Error!</strong> Ayo, mau ngapain ? :p</h3>
          </div>
        </div>
      </div>
    </div>
    ";
}
else
{
  // update selesai - history in cpns_kerjakan

  

  // ambil pilihan
  $get_data = mysqli_query($conn, "SELECT * FROM ujian_kerjakan WHERE kerjakan_userid = '$_SESSION[siswa_id]'
              AND YEAR(kerjakan_createdate) = '$y' AND MONTH(kerjakan_createdate) = '$m' AND DAY(kerjakan_createdate) = '$d'
              AND kerjakan_soalaktifid = '$_GET[sai]' AND kerjakan_materisoalid = '$_GET[msi]'");
  $row=mysqli_fetch_assoc($get_data);

  $kolom = "kerjakan_status = 'selesai', kerjakan_lastupdate = '$tgl', kerjakan_info = 'history'";
  $where = "kerjakan_id = $row[kerjakan_id]";

  $update = edit('ujian_kerjakan',$kolom,$where, $conn);

  $kerjakan = json_decode($row['kerjakan_data']);
  $opt = [];
  foreach ($kerjakan->jawaban as $key => $value) { 
    $opt['pilihan'][$key] = $key.$value;
  }

  // trace($_GET);


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
  if(mysqli_num_rows($cek_nilai) < 1){
    // save nilai
    $kolom = "(siswa_id,materi_soal_id,benar,salah,nilai,tgl,jam)";
    $nilai = "('$_SESSION[siswa_id]','$_GET[msi]','$benar','$salah','$persen_benar','$tgl','$jam')";
    $save = simpan('tb_nilai_siswa',$kolom,$nilai, $conn);
    $save = simpan('tb_nilai_guru',$kolom,$nilai, $conn);
  }


  echo"
  <div class='col-md-9'>
    <div class='box box-primary'>
      <div class='box-body'>
        <div class='callout callout-success'>
          <h4>Perhatian!</h4>
          <h4><i class='fa fa-info-circle sign'></i> Anda telah menyelesaikan soal, klik di <span class='badge btn-twitter'> <a href='$base_url/siswa/pages.php?q=lihat-nilai'>sini</a> </span> untuk melihat semua nilai Anda  !</h4>
        </div>
      </div>
    </div>
  </div>";


  ?>
<div class='col-md-9'>

<div class="row">
<div class='col-md-4'>
  <div class="info-box">
    <span class="info-box-icon bg-green"><i class="fa fa-check-circle"></i></span>
    <div class="info-box-content">
      <span class="info-box-text text-green">Nilai Benar</span>
      <span class="info-box-number"><h3><?php echo @$benar ?></h3><small></small></span>
    </div>
  </div>
</div>

<div class='col-md-4'>
  <div class="info-box">
    <span class="info-box-icon bg-red"><i class="fa fa-times"></i></span>
    <div class="info-box-content">
      <span class="info-box-text text-red">Nilai Salah</span>
      <span class="info-box-number"><h3><?php echo @$salah ?></h3><small></small></span>
    </div>
  </div>
</div>

<div class='col-md-4'>
  <div class="info-box">
    <span class="info-box-icon bg-aqua"><i class="fa fa-hand-o-right"></i></span>
    <div class="info-box-content">
      <span class="info-box-text text-blue">Nilai Anda</span>
      <span class="info-box-number"><h3><?php echo @$persen_benar ?></h3><small></small></span>
    </div>
  </div>
</div>
</div>

    <div class='box box-primary'>
      <div class='box-body'>

  <?php
  if($persen_benar >=90){
    echo "
      <h2 class='text-center'>Halo $_SESSION[nama_siswa], Nilai Anda <span class='text-primary'><strong>MEMUASKAN</strong> <i class='fa fa-smile-o'></i> <i class='fa fa-thumbs-o-up'></i> <i class='fa fa-trophy'></i></span></h2>
  ";
  }elseif ($persen_benar>=80) {
    echo "
      <h2 class='text-center'>Halo $_SESSION[nama_siswa], Nilai Anda <span class='text-success'><strong>BAGUS</strong> <i class='fa fa-smile-o'></i> <i class='fa fa-thumbs-o-up'></i></span></h2>
  ";
  }elseif ($persen_benar>=65) {
    echo "
      <h2 class='text-center'>Halo $_SESSION[nama_siswa], Nilai Anda <span class='text-warning'><strong>CUKUP</strong> <i class='fa fa-smile-o'></i></span></h2>
  ";
  }else{
    echo "
      <h2 class='text-center'>Halo $_SESSION[nama_siswa], Nilai Anda <span class='text-danger'><strong>KURANG</strong> <i class='fa fa-frown-o'></i></span></h2>
  ";
  }
}

}
?>

  </div>
  </div>
  </div>


</div>
</section>