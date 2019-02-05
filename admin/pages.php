<?php
include '../config/koneksi.php';
include '../config/url.php';
include '../config/datetime.php';

if(empty($_SESSION['admin_id']) OR $_SESSION['level'] != 'admin'){
  header("location:$base_url");
}
?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <link rel='icon' href=''>

    <title>Administrator</title>

    <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/datatable/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/ep/style.css">

  <script src="<?php echo $base_url; ?>/assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>

</head>


<?php include'header.php'; ?>
<?php include'menu.php'; ?>
  <div class="content-wrapper">
      <?php include'content.php'; ?>
  </div>
<?php include'footer.php'; ?>


<script src="<?php echo $base_url; ?>/assets/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/datatable/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<script src="<?php echo $base_url; ?>/assets/lte/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/lte/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/lte/dist/js/app.min.js"></script>

<script src="<?php echo $base_url; ?>/assets/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
$( document ).ready( function() {
    $( 'textarea#editor' ).ckeditor();
} );
</script>


</body>
</html>