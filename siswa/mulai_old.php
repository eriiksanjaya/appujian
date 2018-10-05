<?php
include '../config/koneksi.php';
include '../config/url.php';
include '../config/fungsi_indotgl.php';
include '../config/datetime.php';
include '../config/class_paging.php';

session_start();
if(empty($_SESSION['siswa_id'])){
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

    <title>APP Ujian</title>

    <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/skins/_all-skins.min.css">

  <!-- style EP -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/ep/style.css">

</head>
<body>
<?php include'header.php'; ?>
<?php include'menu_m.php'; ?>
  <div class="content-wrapper">
    <?php include'content.php'; ?>
  </div>
<?php include'footer.php'; ?>


<script src='<?php echo $base_url; ?>/assets/js/jquery-2.1.3.min.js'></script>

<script src='<?php echo $base_url; ?>/assets/js/jquery.countdown.min.js'></script>

<script type="text/javascript">
$(function() {
  $('#kirim').hide();
  $('#clock').countdown($("#final_date").val())
  .on('update.countdown', function(event) {
      var totalHours = event.offset.totalDays * 24 + event.offset.hours;
      console.log(totalHours)
      $(this).html(event.strftime(totalHours + ' <span class="clock-info">jam</span> %M <span class="clock-info">menit</span> %S <span class="clock-info">detik</span>'));
  })
  .on('finish.countdown', function(event) {
    $("#kirim").click();
  });

});
</script>
<script src="<?php echo $base_url; ?>/assets/lte/dist/js/app.min.js"></script>

<script src='<?php echo $base_url; ?>/assets/js/jquery.slimscroll.min.js'></script>
<script type="text/javascript">
  $('#page_soal').slimScroll({
    height: '461px',
    alwaysVisible: true
  });
</script>


