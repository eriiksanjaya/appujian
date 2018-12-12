<?php
include '../config/url.php';
session_start();
if(empty($_SESSION['siswa_id']) AND empty($_SESSION['nis'])){
    header("location:$base_url");
}else{
    header("location:$base_url/siswa/pages.php?q=beranda");
}
?>
