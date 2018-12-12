<?php
// session_start();
include "../../../config/koneksi.php";
if (empty($_SESSION['guru_id'])){
  header("location:../../index.php");
} else {

$module=$_GET['q'];
$act=$_GET['act'];

if ($module=='materi-soal' AND $act=='input'){
  mysqli_query($conn, "INSERT INTO tb_materi_soal(guru_id,pilih_mapel_id,materi) 
	                       VALUES('$_SESSION[guru_id]','$_POST[pilih_mapel_id]','$_POST[materi]')");
  header('location:../../pages.php?q='.$module);
}

elseif ($module=='materi-soal' AND $act=='update'){
 
    mysqli_query($conn, "UPDATE tb_materi_soal SET materi   = '$_POST[materi]',
                                           pilih_mapel_id   = '$_POST[pilih_mapel_id]'
                           WHERE  materi_soal_id     = '$_POST[id]'");
 
  header('location:../../pages.php?q='.$module);
}


elseif ($module=='materi-soal' AND $act=='hapus'){
 
    mysqli_query($conn, "DELETE FROM tb_materi_soal
                           WHERE  materi_soal_id     = '$_GET[id]'");
 
  header('location:../../pages.php?q='.$module);
}

if ($module=='materi-soal' AND $act=='blokir'){
     mysqli_query($conn, "UPDATE tb_materi_soal SET blokir   = 'y'
                           WHERE  materi_soal_id     = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);
  }

if ($module=='materi-soal' AND $act=='batal'){
     mysqli_query($conn, "UPDATE tb_materi_soal SET blokir   = 'n'
                           WHERE  materi_soal_id     = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);
  }
}
?>
