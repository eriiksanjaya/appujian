<?php
session_start();
 if (empty($_SESSION['admin_id'])){
  echo "string";
}
else{
include "../../../config/koneksi.php";

$module=$_GET['q'];
$act=$_GET['act'];

if ($module=='sub_kelas' AND $act=='input'){

    $cek = mysqli_query($conn, "SELECT * FROM tb_kelas_sub where nama_kelas = '$_POST[nama_kelas]'");
  if(mysqli_num_rows($cek)>=1){
    die("Nama Kelas sudah diinput !");
  }

  mysqli_query($conn, "INSERT INTO tb_kelas_sub(kelas_id,nama_kelas) 
	                       VALUES('$_POST[kelas_id]','$_POST[nama_kelas]')");
  header('location:../../pages.php?q='.$module);
}

elseif ($module=='sub_kelas' AND $act=='update'){
 
  mysqli_query($conn, "UPDATE tb_kelas_sub SET kelas_id   = '$_POST[kelas_id]',
											nama_kelas   = '$_POST[nama_kelas]'
                           WHERE  kelas_sub_id     = '$_POST[id]'");

  header('location:../../pages.php?q='.$module);
}


elseif ($module=='sub_kelas' AND $act=='hapus'){
 
    mysqli_query($conn, "DELETE FROM tb_kelas_sub
                           WHERE  kelas_sub_id     = '$_GET[id]'");
 
  header('location:../../pages.php?q='.$module);
}


if ($module=='sub_kelas' AND $act=='blokir'){
     mysqli_query($conn, "UPDATE tb_kelas_sub SET blokir   = 'y'
                           WHERE  kelas_sub_id     = '$_GET[id]'");
   
  header('location:../../pages.php?q='.$module);
  }
if ($module=='sub_kelas' AND $act=='batal'){
     mysqli_query($conn, "UPDATE tb_kelas_sub SET blokir   = 'n'
                           WHERE  kelas_sub_id     = '$_GET[id]'");
   
  header('location:../../pages.php?q='.$module);
  }

}
?>
