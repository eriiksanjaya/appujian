<?php
session_start();
 if (empty($_SESSION['guru_id'])){
  header("location:../../index.php");
}else{
include "../../../config/koneksi.php";
$module=$_GET['q'];
$act=$_GET['act'];

if ($module=='pilih-kelas' AND $act=='pilih'){

  $cek = mysqli_query($conn, "SELECT * FROM tb_pilih_kelas WHERE guru_id = '$_SESSION[guru_id]' AND  kelas_sub_id ='$_POST[kelas_sub_id]'");
  if(mysqli_num_rows($cek)==1){
  header('location:../../pages.php?q='.$module);
  }else{
  mysqli_query($conn, "INSERT INTO tb_pilih_kelas(guru_id,kelas_sub_id) 
	                       VALUES('$_SESSION[guru_id]','$_POST[kelas_sub_id]')");
  header('location:../../pages.php?q='.$module);
}
}


if ($module=='pilih-kelas' AND $act=='batal'){
     mysqli_query($conn, "DELETE FROM tb_pilih_kelas WHERE pilih_kelas_id = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);
}
}
?>
