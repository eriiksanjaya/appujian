<?php
// session_start();
include "../../../config/koneksi.php";
include"../../../config/url.php";
?>
<link href='<?php echo $base_url_assets ?>/assets/css/bootstrap.min.css' rel='stylesheet'>
<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo"ayooo, mau ngapain??? :p";
}
else
{

  @$ksi = $_POST['subkelas'];

  $passo = md5($_POST['passo']);
  $passn = md5($_POST['passn']);

  $nis = $_POST['nis'];
  $nama = $_POST['nama'];
  $panggilan = $_POST['panggilan'];
  $kel = $_POST['kelamin'];

  if(empty($_POST['passn'])){

    $status = app_setting('editkelas', $conn); 
    if($status['status']=='off')
    {
      mysqli_query($conn, "UPDATE tb_siswa SET nis = '$nis', nama = '$nama', panggilan = '$panggilan', kelamin = '$kel'
                   WHERE siswa_id      = '$_SESSION[siswa_id]'");
    }
    else
    {
      mysqli_query($conn, "UPDATE tb_siswa SET kelas_sub_id = '$ksi', nis = '$nis', nama = '$nama', panggilan = '$panggilan', kelamin = '$kel'
                   WHERE siswa_id      = '$_SESSION[siswa_id]'");
    }

    
    echo"<script>window.location = '../../pages.php?q=profil';</script>";
  }
  else
  {
    $cek = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE pass = '$passo' AND siswa_id = '$_SESSION[siswa_id]'");
    if(mysqli_num_rows($cek)>0){

      $status = app_setting('editkelas', $conn); 
      if($status['status']=='off')
      {
        mysqli_query($conn, "UPDATE tb_siswa SET nis = '$nis', pass = '$passn', nama = '$nama', panggilan = '$panggilan', kelamin = '$kel'
                             WHERE siswa_id      = '$_SESSION[siswa_id]'");
        echo"<div class='alert alert-success'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
                <h4><i class='fa fa-info-circle sign'></i> Password berhasil diperbarui, klik di <a href='$base_url/siswa/pages.php?q=profil'>sini</a> untuk kembali  !</h4>
            </div>";
      }
      else
      {
        mysqli_query($conn, "UPDATE tb_siswa SET kelas_sub_id = '$ksi', nis = '$nis', pass = '$passn', nama = '$nama', panggilan = '$panggilan', kelamin = '$kel'
                             WHERE siswa_id      = '$_SESSION[siswa_id]'");
        echo"<div class='alert alert-success'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
                <h4><i class='fa fa-info-circle sign'></i> Password berhasil diperbarui, klik di <a href='$base_url/siswa/pages.php?q=profil'>sini</a> untuk kembali  !</h4>
            </div>";
      }

    }else{
      die("<div class='alert alert-warning'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
              <h4><i class='fa fa-exclamation-triangle'></i><strong> Peringatan!</strong> Password Lama tidak sesuai ! , klik di <a href='$base_url/siswa/pages.php?q=profil'>sini</a> untuk kembali  !</h4>
          </div>");
    }
  }
}
?>