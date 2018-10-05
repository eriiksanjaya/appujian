<?php
include "../config/koneksi.php";
include "../config/url.php";

if($_SERVER['REQUEST_METHOD'] != 'POST'){
  header("location:$base_url/admin");
}else{
$user = $_POST['user'];
$pass     = md5($_POST['pass']);
$login=mysqli_query($conn, "SELECT * FROM tb_admin WHERE email='$user' AND pass='$pass'");
$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_assoc($login);
if ($ketemu > 0){
  session_start();
  $_SESSION['KCFINDER']=array();
  $_SESSION['KCFINDER']['disabled'] = false;
  $_SESSION['KCFINDER']['uploadURL'] = "img_soal/";
  $_SESSION['KCFINDER']['uploadDir'] = "";
  $_SESSION['admin_id']     = $r['admin_id'];
  $_SESSION['nama_admin']   = $r['nama'];
  $_SESSION['email_admin']  = $r['email'];
  $_SESSION['pass_admin']   = $r['pass'];
  $_SESSION['level']        = $r['level'];
  header("location:$base_url/admin/pages.php?q=beranda");
}else{
  header("location:$base_url");
}
}
?>
