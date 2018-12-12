<?php
// session_start();
include "../../../config/koneksi.php";
if (empty($_SESSION['admin_id'])){
  echo "string";
} else {

$module=$_GET['q'];
$act=$_GET['act'];

if ($module=='kelas' AND $act=='input'){
  
  $cek = mysqli_query($conn, "SELECT * FROM tb_kelas where kelas = '$_POST[kelas]'");
  if(mysqli_num_rows($cek)>=1){
    die("Kelas sudah diinput !");
  }

  mysqli_query($conn, "INSERT INTO tb_kelas(kelas) 
	                       VALUES('$_POST[kelas]')");
  header('location:../../pages.php?q='.$module);
}

elseif ($module=='kelas' AND $act=='update'){
 
    mysqli_query($conn, "UPDATE tb_kelas SET kelas   = '$_POST[kelas]'
                           WHERE  kelas_id     = '$_POST[id]'");
 
  header('location:../../pages.php?q='.$module);
}

elseif ($module=='kelas' AND $act=='hapus'){
 
    mysqli_query($conn, "DELETE FROM tb_kelas
                           WHERE  kelas_id     = '$_GET[id]'");
 
  header('location:../../pages.php?q='.$module);
}

if ($module=='kelas' AND $act=='blokir'){
     mysqli_query($conn, "UPDATE tb_kelas SET blokir   = 'y'
                           WHERE  kelas_id     = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);
  }

if ($module=='kelas' AND $act=='batal'){
     mysqli_query($conn, "UPDATE tb_kelas SET blokir   = 'n'
                           WHERE  kelas_id     = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);
  }
}
?>
