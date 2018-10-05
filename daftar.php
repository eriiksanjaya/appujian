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
  <title>app ujian - ep</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel='stylesheet' href='<?php echo $base_url ?>/assets/lte/bootstrap/css/bootstrap.min.css'>
  <!-- Font Awesome -->
  <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
  <!-- Ionicons -->
  <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'>
  <!-- Theme style -->
  <link rel="stylesheet" href='<?php echo $base_url ?>/assets/lte/dist/css/AdminLTE.min.css'>
  <!-- iCheck -->
  <link rel="stylesheet" href='<?php echo $base_url ?>/assets/lte/plugins/iCheck/square/blue.css'>

  <!-- style EP -->
  <link rel="stylesheet" href="<?php echo $base_url ?>/assets/ep/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="../../index2.html"><b>Admin</b>LTE</a> -->
  </div>
  <!-- /.login-logo -->
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
        <!-- /.col -->
        <div class="col-xs-8 col-xs-offset-2">
          <button type="submit" class="btn btn-primary btn-ep btn-block btn-flat">Daftar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
         <p class="text-center"> <a href="<?php echo $base_url ?>"> Masuk </a> </p>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src='<?php echo $base_url ?>/assets/lte/plugins/jQuery/jquery-2.2.3.min.js'></script>
<!-- Bootstrap 3.3.6 -->
<script src='<?php echo $base_url ?>/assets/lte/bootstrap/js/bootstrap.min.js'></script>
<!-- iCheck -->
<script src='<?php echo $base_url ?>/assets/lte/plugins/iCheck/icheck.min.js'></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
<?php } ?>