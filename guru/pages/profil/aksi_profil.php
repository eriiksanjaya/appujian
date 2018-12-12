<?php
include"../../../config/url.php";
?>
<link href='<?php echo $base_url ?>/assets/css/bootstrap.min.css' rel='stylesheet'>
<?php
session_start();
 if (empty($_SESSION['guru_id'])){
  header("location:../../index.php");
}
elseif($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:../../logout.php');
    }
    else{

include "../../../config/koneksi.php";


$passo = md5($_POST['passo']);
$passn = md5($_POST['passn']);
$nip = $_POST['nip'];
$nama = $_POST['nama'];
$kel = $_POST['kelamin'];

    if(empty($_POST['passn'])){
    $u = mysqli_query($conn, "UPDATE tb_guru set nip = '$nip', nama = '$nama', kelamin = '$kel' WHERE guru_id = '$_SESSION[guru_id]'");
  header('location:../../pages.php?q=profil');

    }else{
    $cek = mysqli_query($conn, "SELECT * FROM tb_guru WHERE pass = '$passo' AND guru_id = '$_SESSION[guru_id]'");
    if(mysqli_num_rows($cek)>0){
      mysqli_query($conn, "UPDATE tb_guru SET nip = '$nip', pass = '$passn', nama = '$nama', kelamin = '$kel'
                           WHERE guru_id      = '$_SESSION[guru_id]'");
      echo"<div class='alert alert-success'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
    <h4><i class='fa fa-info-circle sign'></i> Password berhasil diperbarui, klik di <a href='$base_url/guru/pages.php?q=profil'>sini</a> untuk kembali  !</h4>
</div>";
    }else{
      die("<div class='alert alert-warning'>
  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
    <h4><i class='fa fa-exclamation-triangle'></i><strong> Peringatan!</strong> Password Lama tidak sesuai ! , klik di <a href='$base_url/guru/pages.php?q=profil'>sini</a> untuk kembali  !</h4>
</div>");
    }

  }

}
?>
