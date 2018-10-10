<?php
session_start();
 if (empty($_SESSION['guru_id'])){
  header("location:../../index.php");
}else{
include "../../../config/koneksi.php";
$module=$_GET['q'];
$act=$_GET['act'];

if ($module=='pilih-mapel' AND $act=='pilih'){

  $cek = mysqli_query($conn, "SELECT * FROM tb_pilih_mapel WHERE guru_id = '$_SESSION[guru_id]' AND  mapel_id ='$_POST[mapel_id]'");
  if(mysqli_num_rows($cek)==1){
  header('location:../../pages.php?q='.$module);
  }else{
  mysqli_query($conn, "INSERT INTO tb_pilih_mapel(guru_id,mapel_id) 
	                       VALUES('$_SESSION[guru_id]','$_POST[mapel_id]')");
  header('location:../../pages.php?q='.$module);
}
}


if ($module=='pilih-mapel' AND $act=='batal'){
     mysqli_query($conn, "DELETE FROM tb_pilih_mapel WHERE pilih_mapel_id = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);
}
}
?>
