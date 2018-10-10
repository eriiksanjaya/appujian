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
    $data = mysqli_query($conn, "SELECT * FROM vw_idset where set_id = '1'");
    $row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $row['judul'] ?></title>
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
        <div class="col-xs-8 col-xs-offset-2 text-center">
          <button type="submit" class="btn btn-primary btn-ep btn-block btn-flat">Masuk</button>
        </div>
      </div>
    </form>
    <?php if($row['status'] == 'off') { } else { echo"<p class='text-center'><a href='$base_url/daftar'>Daftar Baru</a></p>"; } ?>

    <span style="color:#999" class="pull-right"><em>Version <?php echo get_versi(); ?></em></span>
         
  </div>
</div>
<script src='<?php echo $base_url ?>/assets/lte/plugins/jQuery/jquery-2.2.3.min.js'></script>
<script src='<?php echo $base_url ?>/assets/lte/bootstrap/js/bootstrap.min.js'></script>
</body>
</html>
<?php } ?>