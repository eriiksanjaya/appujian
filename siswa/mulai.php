<?php
    include '../config/koneksi.php';
    include '../config/url.php';
    include '../config/fungsi_indotgl.php';
    include '../config/datetime.php';
    include '../config/class_paging.php';

    session_start();
    timeout($_SESSION['detik']);
    if(empty($_SESSION['siswa_id'])){
        header("location:$base_url");
    }
?>

<!DOCTYPE html>
<html lang='en'>
<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta name='description' content=''>
<meta name='author' content=''>
<link rel='icon' href=''>
<head>
    <title>APP Ujian</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/ep/style.css">
  <link rel="stylesheet" href="<?php echo $base_url ?>/assets/css/sweetalert2.min.css">

    <script src='<?php echo $base_url; ?>/assets/js/jquery-2.1.3.min.js'></script>


</head>
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                    </div>
                </div>
            </nav>
        </header>

        <div class="content-wrapper">
            <section class="content">
                <div class="row">
                    <?php include"kerjakan_left.php"; ?>
                    <?php include"kerjakan_center.php"; ?>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> <?php echo get_versi(); ?>
                </div>
                <strong>&copy; 2013 - <?php echo date("Y") ?> <a target="_blank" href="http://sekolahsaya.net"> sekolahsaya.net</a></strong>
            </div>
        </footer>

    </div>


    <script src='<?php echo $base_url; ?>/assets/js/jquery.countdown.min.js'></script>
    <script type="text/javascript">
        $(function() {
            $('#clock').countdown($("#selesai_jam").val())
            .on('update.countdown', function(event) {
                var totalHours = event.offset.totalDays * 24 + event.offset.hours;
                $(this).html(event.strftime(totalHours + ' <span class="clock-info">jam</span> %M <span class="clock-info">menit</span> %S <span class="clock-info">detik</span>'));
            })
            .on('finish.countdown', function(event) {
                $("#terminated").click();
            });

        });
    </script>

    <script src="<?php echo $base_url; ?>/assets/lte/dist/js/app.min.js"></script>
<script src="<?php echo $base_url ?>/assets/js/sweetalert2.min.js"></script>

    <script src='<?php echo $base_url; ?>/assets/js/jquery.slimscroll.min.js'></script>
    
    <script type="text/javascript">
        $('#page_soal').slimScroll({
            height: '420px',
            alwaysVisible: true
        });



    </script>
</body>
</html>