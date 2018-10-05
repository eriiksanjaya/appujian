<?php
include 'config/koneksi.php';
include 'config/url.php';

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
  <!-- style EP -->
  <link rel="stylesheet" href="<?php echo $base_url ?>/assets/ep/style.css">


<?php include'config/url.php'; ?>
<div class="alert alert-error alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Gagal!</h4>
                Gagal mendaftarkan sekolah, <a href="<?php echo $base_url; ?>"> ulangi lagi ! </a>  
              </div>