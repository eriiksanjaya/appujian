<?php
session_start();
if (empty($_SESSION['guru_id'])){
  header("location:../../index.php");
}else{
include'../../../config/koneksi.php';
include'../../../config/datetime.php';

$he = mysqli_query($conn, "SELECT
tb_siswa.nis,
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

$guru = str_replace(' ','',$h['nama']);
$kls = str_replace(' ','',$h['nama_kelas']);
$mp = str_replace(' ','',$h['mata_pelajaran']);
$tg = str_replace(' ','',$h['tgl']);



// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");


// Mendefinisikan nama file ekspor "hasil-export.xls"
$filename = "nilai-siswa-$guru-$kls-$mp-$tg.xls";
header("Content-Disposition: attachment; filename=\"".$filename."\"");

// Mendefinisikan nama file ekspor "hasil-export.xls"
// header("Content-Disposition: attachment; filename=nilai.xls");
 
// Tambahkan table
include 'o_nilai.php';
}
?>