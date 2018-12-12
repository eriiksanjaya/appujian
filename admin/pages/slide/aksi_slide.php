<?php
session_start();
 if (empty($_SESSION['admin_id'])){
  echo "string";
}
else{

include "../../../config/koneksi.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['q'];
$act=$_GET['act'];

if ($module=='slide' AND $act=='input'){

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $ukuran         = $_FILES['fupload']['size'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $image_size_info  = getimagesize($lokasi_file); //get image size
  
  if(!$image_size_info){
    die("File tidak valid!");
  }

  echo"file yang Anda upload adalah ".$tipe_file." <br>";
  if($tipe_file != "image/jpeg"){
    die("Ekstensi tidak valid!");
   }

UploadImage($nama_file_unik);

  mysql_query("INSERT INTO tb_slide (slide) VALUES 
    ('$nama_file_unik')") or die (mysql_error());

  header('location:../../pages.php?q='.$module);
}

elseif ($module=='slide' AND $act=='update'){

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $ukuran         = $_FILES['fupload']['size'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $image_size_info  = getimagesize($lokasi_file); //get image size
  
  if(!$image_size_info){
    die("File tidak valid!");
  }

  echo"file yang Anda upload adalah ".$tipe_file." <br>";
  if($tipe_file != "image/jpeg"){
    die("Ekstensi tidak valid!");
   }
  UploadImage($nama_file_unik);
  mysql_query("UPDATE tb_slide SET slide = '$nama_file_unik'
                                 WHERE  slide_id   = '$_POST[id]'");
  unlink("../../../data1/images/$_POST[img]"); 
  unlink("../../../data1/tooltips/$_POST[img]"); 
  header('location:../../pages.php?q='.$module);
}

elseif ($module=='slide' AND $act=='hapus'){
  mysql_query("DELETE FROM tb_slide WHERE slide_id='$_GET[id]'");
  unlink("../../../data1/images/$_GET[img]"); 
  unlink("../../../data1/tooltips/$_GET[img]"); 
  header('location:../../pages.php?q='.$module);
}


elseif ($module=='slide' AND $act=='on'){
  mysql_query("UPDATE tb_slide SET status = 'on'
                                 WHERE  slide_id   = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);
}

elseif ($module=='slide' AND $act=='off'){
  mysql_query("UPDATE tb_slide SET status = 'off'
                                 WHERE  slide_id   = '$_GET[id]'");
  header('location:../../pages.php?q='.$module);
}

}
?>
