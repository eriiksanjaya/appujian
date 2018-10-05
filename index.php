<?php
include 'config/koneksi.php';
include 'config/url.php';

session_start();
if(@$_SESSION['level'] == "siswa"){
  header("location:$base_url/siswa");
}elseif(@$_SESSION['level'] == "guru"){
  header("location:$base_url/guru");
}elseif(@$_SESSION['level'] == "admin"){
  header("location:$base_url/admin");
}else{
    $data = mysqli_query($conn, "SELECT * FROM vw_idset where set_id = '1'") or die(mysql_error());
    $row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $row['judul'] ?></title>
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
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  
    <p class="login-box-msg">
      <?php echo $row['sekolah'] ?>
    </p>

    <form action="action_login.php" method="post">
      <div class="form-group has-feedback">
      <label class="label-ep">ID</label>
        <input type="text" name="id" class="form-control" placeholder="ID Siswa / Nis / Nip / Email" required>
      </div>
      <div class="form-group has-feedback">
      <label class="label-ep">Password</label>
        <input type="password" name="pass" class="form-control" placeholder="Password" required>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-8 col-xs-offset-2 text-center">
          <button type="submit" class="btn btn-primary btn-ep btn-block btn-flat">Masuk</button>

        </div>
        <!-- /.col -->
      </div>
    </form>
    <?php if($row['status'] == 'off') { } else { echo"<p class='text-center'><a href='$base_url/daftar'>Daftar Baru</a></p>"; } ?>

    <span style="color:#999" class="pull-right"><em>Version <?php echo get_versi(); ?></em></span>
         
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 2.2.3 -->
<script src='<?php echo $base_url ?>/assets/lte/plugins/jQuery/jquery-2.2.3.min.js'></script>
<script src='<?php echo $base_url ?>/assets/ep/erik.js'></script>
<!-- Bootstrap 3.3.6 -->
<script src='<?php echo $base_url ?>/assets/lte/bootstrap/js/bootstrap.min.js'></script>
</body>
</html>
<?php } ?>