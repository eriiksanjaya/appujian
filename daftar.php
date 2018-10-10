<?php
include 'config/koneksi.php';
include 'config/datetime.php';
include 'config/url.php';
error_reporting(0);
session_start();
if(isset($_SESSION['siswa_id'])){
  header("location:$base_url/siswa");
}else{
    $data = mysqli_query($conn, "SELECT * FROM tb_set where set_id = '1'");
    $row = mysqli_fetch_assoc($data);
    if($row['status'] == 'off')
    {
      header("location:$base_url");
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>appujian</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel='stylesheet' href='<?php echo $base_url ?>/assets/lte/bootstrap/css/bootstrap.min.css'>
  <link rel="stylesheet" href='<?php echo $base_url ?>/assets/lte/dist/css/AdminLTE.min.css'>
  <link rel="stylesheet" href="<?php echo $base_url ?>/assets/ep/style.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">FORM DAFTAR</p>
    <form action="actrgs.php" method="post">
      <div class="form-group has-feedback">
          <input type="text" class="form-control" name="nama" id="em" placeholder="Nama Lengkap" required>
        </div>
      <div class="form-group has-feedback">
        <input type="password" name="pass" class="form-control" placeholder="Password" required>
      </div>

      <div class='form-group has-feedback'>
        <select class='form-control' name='kelas_sub_id' required>
        <option value=''>Kelas</option>
        <?php
        $tampil=mysqli_query($conn, "SELECT * FROM tb_kelas_sub WHERE blokir='n' AND kelas_sub_id=$_GET[kelas_sub_id]");
              while($r=mysqli_fetch_assoc($tampil)){
        echo"<option value=$r[kelas_sub_id]>$r[nama_kelas]</option>";
        }
        
              $tampil=mysqli_query($conn, "SELECT * FROM tb_kelas_sub WHERE blokir ='n' ORDER BY nama_kelas");
              while($r=mysqli_fetch_assoc($tampil)){
              echo "<option value=$r[kelas_sub_id]>$r[nama_kelas]</option>";
              }
        ?>
        </select>
        </div>

        <div class='form-group has-feedback'>
          <select class='form-control' name='kelamin' required>
            <option value=''>Jenis Kelamin</option>
            <option value='Laki-Laki'>Laki-Laki</option>
            <option value='Perempuan'>Perempuan</option>      
          </select>
        </div>
        

      <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
          <button type="submit" class="btn btn-primary btn-ep btn-block btn-flat">Daftar</button>
        </div>
      </div>
    </form>
         <p class="text-center"> <a href="<?php echo $base_url ?>"> Masuk </a> </p>
  </div>
</div>
<script src='<?php echo $base_url ?>/assets/lte/plugins/jQuery/jquery-2.2.3.min.js'></script>
<script src='<?php echo $base_url ?>/assets/lte/bootstrap/js/bootstrap.min.js'></script>
</body>
</html>
<?php } ?>