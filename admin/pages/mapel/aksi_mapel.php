<?php
session_start();
 if (empty($_SESSION['admin_id'])){
  echo "string";
}
else{
include "../../../config/koneksi.php";

$module=$_GET['q'];
$act=$_GET['act'];

if ($module=='mapel' AND $act=='input'){

  $cek = mysqli_query($conn, "SELECT * FROM tb_mapel where mata_pelajaran = '$_POST[nama_mapel]'");
  if(mysqli_num_rows($cek)>=1){
    die("Mata pelajaran sudah diinput !");
  }

  mysqli_query($conn, "INSERT INTO tb_mapel(mata_pelajaran) 
	                       VALUES('$_POST[nama_mapel]')");
  header('location:../../pages.php?q='.$module);
}

elseif ($module=='mapel' AND $act=='update'){
 
    mysqli_query($conn, "UPDATE tb_mapel SET mata_pelajaran   = '$_POST[nama_mapel]'
                           WHERE  mapel_id     = '$_POST[id]'");
  header('location:../../pages.php?q='.$module);
  }


elseif ($module=='mapel' AND $act=='hapus'){
 
    mysqli_query($conn, "DELETE FROM tb_mapel
                           WHERE  mapel_id     = '$_GET[id]'");
 
  header('location:../../pages.php?q='.$module);
}

if ($module=='mapel' AND $act=='blokir'){
     mysqli_query($conn, "UPDATE tb_mapel SET blokir   = 'y'
                           WHERE  mapel_id     = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);
  }

  if ($module=='mapel' AND $act=='batal'){
     mysqli_query($conn, "UPDATE tb_mapel SET blokir   = 'n'
                           WHERE  mapel_id     = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);
  }
}
?>
