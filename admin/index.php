<?php
include '../config/koneksi.php';
include '../config/url.php';

session_start();
if(isset($_SESSION['admin_id'])){
    header("location:$base_url/admin/pages.php?q=beranda");
}else{
  header("location:$base_url");
}
?>
