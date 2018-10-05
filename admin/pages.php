<?php
include '../config/koneksi.php';
include '../config/url.php';
include '../config/fungsi_indotgl.php';
include '../config/datetime.php';
include '../config/class_paging.php';

session_start();
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
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/datatable/dataTables.bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/ep/style.css">


</head>

<?php include'header.php'; ?>
<?php include'menu.php'; ?>
  <div class="content-wrapper">
      <?php include'content.php'; ?>
  </div>
<?php include'footer.php'; ?>

<!-- jQuery 2.2.3 -->
<script src="<?php echo $base_url; ?>/assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="<?php echo $base_url; ?>/assets/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/datatable/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $base_url; ?>/assets/lte/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo $base_url; ?>/assets/lte/plugins/select2/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $base_url; ?>/assets/lte/dist/js/app.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo $base_url; ?>/assets/lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo $base_url; ?>/assets/lte/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE App -->
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