<section class="content-header">
      <h1>
        Nilai
        <small></small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
<?php
 if (empty($_SESSION['siswa_id'])){
  header("location:../../index.php");
}
else{
error_reporting(0);
include'../../config/fungsi_indotgl.php';

$aksi="pages/nilai/aksi_nilai.php";

switch($_GET['act']){



  default:

      $tampil = mysqli_query($conn, "SELECT
tb_soal_aktif.soal_aktif_id,
tb_soal_aktif.materi_soal_id,
tb_soal_aktif.kelas_sub_id,
tb_soal_aktif.menit,
tb_soal_aktif.detik,
tb_soal_aktif.aktif,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_kelas_sub.nama_kelas,
tb_pilih_mapel.pilih_mapel_id,
tb_mapel.mata_pelajaran,
tb_nilai_siswa.tgl,
tb_nilai_siswa.jam,
tb_nilai_siswa.siswa_id,
tb_nilai_siswa.materi_soal_id
FROM
tb_soal_aktif
INNER JOIN tb_materi_soal ON tb_soal_aktif.materi_soal_id = tb_materi_soal.materi_soal_id
INNER JOIN tb_kelas_sub ON tb_soal_aktif.kelas_sub_id = tb_kelas_sub.kelas_sub_id
INNER JOIN tb_nilai_siswa ON tb_soal_aktif.materi_soal_id = tb_nilai_siswa.materi_soal_id
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
INNER JOIN tb_siswa ON tb_nilai_siswa.siswa_id = tb_siswa.siswa_id AND tb_siswa.kelas_sub_id = tb_soal_aktif.kelas_sub_id
WHERE tb_nilai_siswa.siswa_id = '$_SESSION[siswa_id]'
GROUP BY tb_nilai_siswa.materi_soal_id, tb_nilai_siswa.tgl
ORDER BY tb_nilai_siswa.tgl DESC, tb_mapel.mata_pelajaran ASC, tb_materi_soal.materi ");


      echo "
      <div class='col-md-10'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'></h3>
            </div>
            <div class='box-body'>

            <div class='table-responsive'>
  <table id='example' class='table table-striped table-bordered' cellspacing='0' width='100%'>
    <thead>
          <tr>
          <th>No</th>
          <th>Kelas</th>
          <th>Mata Pelajaran</th>
          <th>Materi Soal</th>
          <th>Tgl</th>
          <th>Jam</th>
          <th>Aksi</th>
          </tr></thead>";
    $no = 1;
    while ($r=mysqli_fetch_assoc($tampil)){
  
  $tgl = app_date_value($r['tgl'], "d M Y");

       echo "<tbody>
          <tr>
          <td>$no</td>
             <td>$r[nama_kelas]</td>
             <td>$r[mata_pelajaran]</td>
             <td>$r[materi]</td>
             <td>$tgl</td>
             <td>$r[jam]</td>
             <td><div class='btn-group'><a href=?q=lihat-nilai&act=tampilnilai&msi=$r[materi_soal_id]&ksi=$r[kelas_sub_id]&tgl=$r[tgl]><button type='button' class='btn btn-inverse btn-xs'>Lihat</button></a>
       </div></td></tr>
       </tbody>";
      $no++;
    }
    echo "</table></div></div></div></div>";
    break;



    case "tampilnilai";

    if ($_SESSION['siswa_id']){

    $tampil = mysqli_query($conn, "SELECT
tb_nilai_siswa.nilai_id,
tb_nilai_siswa.siswa_id,
tb_nilai_siswa.materi_soal_id,
tb_nilai_siswa.benar,
tb_nilai_siswa.salah,
tb_nilai_siswa.nilai,
tb_nilai_siswa.tgl,
tb_nilai_siswa.jam,
tb_siswa.nis,
tb_siswa.nama,
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.nama_kelas,
tb_materi_soal.guru_id,
tb_materi_soal.materi
FROM
tb_nilai_siswa
INNER JOIN tb_siswa ON tb_nilai_siswa.siswa_id = tb_siswa.siswa_id
INNER JOIN tb_kelas_sub ON tb_siswa.kelas_sub_id = tb_kelas_sub.kelas_sub_id
INNER JOIN tb_materi_soal ON tb_nilai_siswa.materi_soal_id = tb_materi_soal.materi_soal_id
WHERE tb_nilai_siswa.materi_soal_id = '$_GET[msi]' AND tb_kelas_sub.kelas_sub_id = '$_GET[ksi]' AND tb_nilai_siswa.siswa_id = '$_SESSION[siswa_id]' AND tb_nilai_siswa.tgl = '$_GET[tgl]'
ORDER BY tb_nilai_siswa.tgl DESC, tb_nilai_siswa.jam ASC");


    $he = mysqli_query($conn, "SELECT
tb_siswa.nis,
tb_siswa.nama as nama_siswa,
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.nama_kelas,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_siswa.siswa_id,
tb_pilih_mapel.pilih_mapel_id,
tb_mapel.mapel_id,
tb_mapel.mata_pelajaran,
tb_nilai_siswa.materi_soal_id,
tb_nilai_siswa.tgl,
tb_nilai_siswa.jam,
tb_guru.nip,
tb_guru.nama
FROM
tb_nilai_siswa
INNER JOIN tb_siswa ON tb_nilai_siswa.siswa_id = tb_siswa.siswa_id
INNER JOIN tb_kelas_sub ON tb_siswa.kelas_sub_id = tb_kelas_sub.kelas_sub_id
INNER JOIN tb_materi_soal ON tb_nilai_siswa.materi_soal_id = tb_materi_soal.materi_soal_id
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
INNER JOIN tb_guru ON tb_materi_soal.guru_id = tb_guru.guru_id
WHERE tb_nilai_siswa.materi_soal_id = '$_GET[msi]' AND tb_kelas_sub.kelas_sub_id = '$_GET[ksi]' AND tb_nilai_siswa.siswa_id = '$_SESSION[siswa_id]' AND tb_nilai_siswa.tgl = '$_GET[tgl]'");
$h=mysqli_fetch_assoc($he);
$tgl = app_date_value($h['tgl'], "d M Y");



  echo "<div class='col-md-10'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'></h3>
            </div>
            <div class='box-body'>

  <dl class='dl-horizontal ifo-order'>
  <dt>Nis :</dt><dd> $h[nis]</dd>
  <dt>Nama Siswa :</dt><dd> $h[nama_siswa]</dd>
  <dt>Pengajar :</dt><dd> $h[nama]</dd>
  <dt>Kelas :</dt><dd> $h[nama_kelas]</dd>
  <dt>Mata Pelajaran :</dt><dd> $h[mata_pelajaran]</dd>
  <dt>Materi Soal :</dt><dd> $h[materi]</dd>
  <dt>Tanggal :</dt><dd> $tgl</dd>
  </dl>


    <div class='table-responsive'>
  <table id='example' class='table table-striped table-bordered' cellspacing='0' width='100%'>
    <thead>
          <tr>
          <th>No</th>
          <th>Benar</th>
          <th>Salah</th>
          <th>Nilai</th>
          <th>Jam</th>
          </tr></thead>";
    $no = 1;
    while ($r=mysqli_fetch_assoc($tampil)){
       echo "<tbody>
          <tr>
          <td>$no</td>
             <td>$r[benar]</td>
             <td>$r[salah]</td>
             <td>$r[nilai]</td>
             <td>$r[jam]</td>
             </td></tr>
       </tbody>";
      $no++;
    }
    echo "</table></div></div></div></div>";
}
    break;


}
}
?>
</div>
</section>