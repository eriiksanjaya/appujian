<section class="content-header">
  <h1>
    Nilai Siswa
  </h1>
</section>

<section class="content">
  <div class="row">
<?php
 if (empty($_SESSION['guru_id'])){
  header("location:../../index.php");
}
else{

switch(@$_GET['act']){

  default:
  echo"<div class='col-md-12'>
        <div class='box'>
        <div class='box-body'>";
  $menu=mysqli_query($conn, "SELECT
tb_siswa.siswa_id,
tb_pilih_kelas.guru_id,
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.nama_kelas
FROM
tb_siswa
INNER JOIN tb_pilih_kelas ON tb_siswa.kelas_sub_id = tb_pilih_kelas.kelas_sub_id
INNER JOIN tb_kelas_sub ON tb_pilih_kelas.kelas_sub_id = tb_kelas_sub.kelas_sub_id
INNER JOIN tb_nilai_guru ON tb_nilai_guru.siswa_id = tb_siswa.siswa_id
WHERE
tb_pilih_kelas.guru_id = '$_SESSION[guru_id]'
GROUP BY
tb_kelas_sub.kelas_sub_id
ORDER BY
tb_kelas_sub.nama_kelas ASC");

while($r=mysqli_fetch_assoc($menu)){
	echo"

				<a class='btn btn-app' href=?q=nilai-siswa&act=tampilmateri&kelas_sub_id=$r[kelas_sub_id]>
          <span class='badge bg-aqua'></span>
          <i class='fa fa-home'></i> $r[nama_kelas]
        </a>
      ";


}
echo"</div>";
break;

case "tampilmateri";


    if ($_SESSION['guru_id']){
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
tb_nilai_guru.tgl,
tb_nilai_guru.jam,
tb_nilai_guru.siswa_id
FROM
tb_soal_aktif
INNER JOIN tb_materi_soal ON tb_soal_aktif.materi_soal_id = tb_materi_soal.materi_soal_id
INNER JOIN tb_kelas_sub ON tb_soal_aktif.kelas_sub_id = tb_kelas_sub.kelas_sub_id
INNER JOIN tb_nilai_guru ON tb_soal_aktif.materi_soal_id = tb_nilai_guru.materi_soal_id
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
INNER JOIN tb_siswa ON tb_nilai_guru.siswa_id = tb_siswa.siswa_id AND tb_siswa.kelas_sub_id = tb_soal_aktif.kelas_sub_id
WHERE tb_materi_soal.guru_id='$_SESSION[guru_id]' AND tb_soal_aktif.kelas_sub_id = '$_GET[kelas_sub_id]'
GROUP BY materi_soal_id, tb_nilai_guru.tgl
ORDER BY tb_nilai_guru.nilai_id DESC");


      echo "
      <div class='col-md-12'>
  <div class='box'>
    <div class='box-header with-border'>
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
       echo "<tbody>
          <tr>
          <td>$no</td>
             <td>$r[nama_kelas]</td>
             <td>$r[mata_pelajaran]</td>
             <td>$r[materi]</td>
             <td>$r[tgl]</td>
             <td>$r[jam]</td>
             <td><div class='btn-group'><a href=?q=nilai-siswa&act=tampilnilai&msi=$r[materi_soal_id]&ksi=$r[kelas_sub_id]&tgl=$r[tgl]><button type='button' class='btn btn-primary btn-xs'>Lihat</button></a>
       </div></td></tr>
       </tbody>";
      $no++;
    }
    echo "</table></div>
          </div>
        </div>
      </div>";
}
    break;



    case "tampilnilai";

    if ($_SESSION['guru_id']){

    $tampil = mysqli_query($conn, "SELECT
tb_nilai_guru.nilai_id,
tb_nilai_guru.siswa_id,
tb_nilai_guru.materi_soal_id,
tb_nilai_guru.benar,
tb_nilai_guru.salah,
tb_nilai_guru.nilai,
tb_nilai_guru.tgl,
tb_nilai_guru.jam,
tb_siswa.nis,
tb_siswa.nama,
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.nama_kelas,
tb_materi_soal.guru_id,
tb_materi_soal.materi
FROM
tb_nilai_guru
INNER JOIN tb_siswa ON tb_nilai_guru.siswa_id = tb_siswa.siswa_id
INNER JOIN tb_kelas_sub ON tb_siswa.kelas_sub_id = tb_kelas_sub.kelas_sub_id
INNER JOIN tb_materi_soal ON tb_nilai_guru.materi_soal_id = tb_materi_soal.materi_soal_id

WHERE tb_materi_soal.guru_id='$_SESSION[guru_id]'
AND tb_nilai_guru.materi_soal_id = '$_GET[msi]' AND tb_kelas_sub.kelas_sub_id = '$_GET[ksi]'
AND tb_nilai_guru.tgl = '$_GET[tgl]'
ORDER BY tb_nilai_guru.nilai_id DESC");


    $he = mysqli_query($conn, "SELECT
tb_siswa.nis,
tb_siswa.nama,
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.nama_kelas,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_siswa.siswa_id,
tb_pilih_mapel.pilih_mapel_id,
tb_mapel.mapel_id,
tb_mapel.mata_pelajaran,
tb_nilai_guru.materi_soal_id,
tb_nilai_guru.tgl,
tb_nilai_guru.jam,
tb_guru.nip,
tb_guru.nama
FROM
tb_nilai_guru
INNER JOIN tb_siswa ON tb_nilai_guru.siswa_id = tb_siswa.siswa_id
INNER JOIN tb_kelas_sub ON tb_siswa.kelas_sub_id = tb_kelas_sub.kelas_sub_id
INNER JOIN tb_materi_soal ON tb_nilai_guru.materi_soal_id = tb_materi_soal.materi_soal_id
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
INNER JOIN tb_guru ON tb_materi_soal.guru_id = tb_guru.guru_id
WHERE tb_materi_soal.guru_id='$_SESSION[guru_id]'
AND tb_nilai_guru.tgl = '$_GET[tgl]' AND tb_nilai_guru.materi_soal_id = '$_GET[msi]' AND tb_kelas_sub.kelas_sub_id = '$_GET[ksi]'");
$h=mysqli_fetch_assoc($he);
$tgl = app_date_value($h['tgl'], "d M Y");



  echo "
  <div class='col-md-12'>
  <div class='box'>
    <div class='box-header with-border'>
    </div>
    <div class='box-body'>

  <dl class='dl-horizontal ifo-order'>
  <dt>Pengajar :</dt><dd> $h[nama]</dd>
  <dt>Kelas :</dt><dd> $h[nama_kelas]</dd>
  <dt>Mata Pelajaran :</dt><dd> $h[mata_pelajaran]</dd>
  <dt>Materi Soal :</dt><dd> $h[materi]</dd>
  <dt>Tanggal :</dt><dd> $tgl</dd>
  <dt>Download :</dt><dd> <a href='pages/nilai/export.php?msi=$_GET[msi]&ksi=$_GET[ksi]&tgl=$_GET[tgl]'>Excel</a></dd>
  </dl>
    <div class='table-responsive'>
  <table id='example' class='table table-striped table-bordered' cellspacing='0' width='100%'>
    <thead>
          <tr>
          <th>No</th>
          <th>Nis</th>
          <th>Nama</th>
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
             <td>$r[nis]</td>
             <td>$r[nama]</td>
             <td>$r[benar]</td>
             <td>$r[salah]</td>
             <td>$r[nilai]</td>
             <td>$r[jam]</td>
             </td></tr>
       </tbody>";
      $no++;
    }
    echo "</table></div></div></div>";
}
    break;


}
}
?>
</div>
</section>

