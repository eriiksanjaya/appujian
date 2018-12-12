<?php
// session_start();
include "../../../config/koneksi.php";
include '../../../config/url.php';
?>
<link href='<?php echo $base_url ?>/assets/css/bootstrap.min.css' rel='stylesheet'>
<?php
if (empty($_SESSION['admin_id'])){
  header("location:../../index.php");
} elseif ($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:../../logout.php');
} else {

$passo = md5($_POST['passo']);
$passn = md5($_POST['passn']);

$mail = $_POST['email'];
$nama = $_POST['nama'];
$kel = $_POST['kelamin'];
    if(empty($_POST['passn'])){
      mysqli_query($conn, "UPDATE tb_admin set email = '$mail', nama = '$nama', kelamin = '$kel' WHERE admin_id = '$_SESSION[admin_id]'");
  header('location:../../pages.php?q=profil');
    }else{
    $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE pass = '$passo' AND admin_id = '$_SESSION[admin_id]'");
    if(mysqli_num_rows($cek)>0){
      mysqli_query($conn, "UPDATE tb_admin SET email = '$mail', pass = '$passn', nama = '$nama', kelamin = '$kel'
                           WHERE admin_id      = '$_SESSION[admin_id]'");
      echo"<div class='alert alert-success'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
    <h4><i class='fa fa-info-circle sign'></i> Password berhasil diperbarui, klik di <a href='$base_url/admin/pages.php?q=profil'>sini</a> untuk kembali  !</h4>
</div>";
    }else{
      die("<div class='alert alert-warning'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
    <h4><i class='fa fa-exclamation-triangle'></i><strong> Peringatan!</strong> Password Lama tidak sesuai ! , klik di <a href='$base_url/admin/pages.php?q=profil'>sini</a> untuk kembali  !</h4>
</div>");
    }

  }

}
?>
