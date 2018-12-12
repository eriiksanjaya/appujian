<?php
error_reporting(0);
// session_start();
include "../../../config/koneksi.php";
include "../../../config/datetime.php";

if (empty($_SESSION['guru_id'])){
  echo "string";
} else {

$module=$_GET['q'];
$act=$_GET['act'];


$sad = $_GET['sad'];
$pmi = $_POST['pilih_mapel_id'];
$msi = $_POST['materi_soal_id'];
$ksi = $_POST['kelas_sub_id'];
$menit = $_POST['menit'];
$detik = $menit * 60;


$jaman = mktime(date("H"),date("i")+$menit,date("s"));
$end   = date("H:i:s", $jaman);

if ($module=='aktifkan-soal' AND $act=='input'){

  $cek = mysqli_query($conn, "SELECT
tb_soal_aktif.soal_aktif_id,
tb_soal_aktif.materi_soal_id,
tb_soal_aktif.kelas_sub_id,
tb_soal_aktif.menit,
tb_soal_aktif.detik,
tb_soal_aktif.aktif,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir
FROM
tb_soal_aktif
INNER JOIN tb_materi_soal ON tb_soal_aktif.materi_soal_id = tb_materi_soal.materi_soal_id
WHERE tb_materi_soal.guru_id = '$_SESSION[guru_id]' 
AND  tb_soal_aktif.materi_soal_id='$_POST[materi_soal_id]' AND tb_soal_aktif.kelas_sub_id='$_POST[kelas_sub_id]'");
  if(mysqli_num_rows($cek)==1){
    header('location:../../pages.php?q='.$module);
  }else{
  mysqli_query($conn, "INSERT INTO tb_soal_aktif(materi_soal_id,kelas_sub_id,menit,detik,tgl,jam,selesai) 
	                       VALUES('$msi','$ksi','$menit','$detik','$tgl','$jam','$end')");
  header('location:../../pages.php?q='.$module);
}
}


if ($module=='aktifkan-soal' AND $act=='update'){
     mysqli_query($conn, "UPDATE tb_soal_aktif SET kelas_sub_id = '$ksi',
                                           menit        = '$menit',
                                           detik        = '$detik',
                                           tgl          = '$tgl',
                                           jam          = '$jam',
                                           selesai      = '$end'
                                       WHERE soal_aktif_id = $sad");
  header('location:../../pages.php?q='.$module);
}

elseif ($module=='aktifkan-soal' AND $act=='hapus'){
 
    mysqli_query($conn, "DELETE FROM tb_soal_aktif
                           WHERE  soal_aktif_id     = $sad");
 
  header('location:../../pages.php?q='.$module);
}

if ($module=='aktifkan-soal' AND $act=='aktif'){
  $m = $_GET['m'];
  $jaman = mktime(date("H"),date("i")+$m,date("s"));
  $end   = date("H:i:s", $jaman);
  mysqli_query($conn, "UPDATE tb_soal_aktif SET aktif        = 'aktif',
                                        tgl          = '$tgl',
                                        jam          = '$jam',
                                        selesai      = '$end'
                                    WHERE soal_aktif_id = $sad");
  header('location:../../pages.php?q='.$module);
}

if ($module=='aktifkan-soal' AND $act=='nonaktif'){
  $m = $_GET['m'];
  $jaman = mktime(date("H"),date("i")+$m,date("s"));
  $end   = date("H:i:s", $jaman);
  mysqli_query($conn, "UPDATE tb_soal_aktif SET aktif        = '-',
                                        tgl          = '$tgl',
                                        jam          = '$jam',
                                        selesai      = '$end'
                                       WHERE soal_aktif_id = $sad");
  header('location:../../pages.php?q='.$module);
}

}
?>
