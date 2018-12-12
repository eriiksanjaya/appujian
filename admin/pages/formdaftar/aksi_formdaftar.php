<?php
// session_start();
 if (empty($_SESSION['admin_id'])){
  echo "string";
}
else{

include "../../../config/koneksi.php";

$module=$_GET['q'];
$act=$_GET['act'];

if ($module=='formdaftar' AND $act=='on'){
     mysqli_query($conn, "UPDATE tb_set SET status = 'on'  
                           WHERE set_id      = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);

  }


if ($module=='formdaftar' AND $act=='off'){
     mysqli_query($conn, "UPDATE tb_set SET status = 'off'  
                           WHERE set_id      = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);

  }



}
?>
