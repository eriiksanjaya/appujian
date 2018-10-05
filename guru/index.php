<?php
include '../config/koneksi.php';
include '../config/url.php';

session_start();
if(isset($_SESSION['guru_id'])){
    header("location:$base_url/guru/pages.php?q=beranda");
}else{
  header("location:$base_url");
}
?>
