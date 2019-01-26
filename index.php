<?php
include 'config/koneksi.php';
include 'config/url.php';

// session_start();
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
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo @$row['judul'] ?></title>
  <!-- Bootstrap core CSS -->
  <link href="<?php echo $base_url ?>/assets/mdb/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?php echo $base_url ?>/assets/mdb/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="<?php echo $base_url ?>/assets/mdb/css/style.min.css" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/fonts/fa/v5.5.0/css/regular.min.css" integrity="sha384-z3ccjLyn+akM2DtvRQCXJwvT5bGZsspS4uptQKNXNg778nyzvdMqiGcqHVGiAUyY" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/fonts/fa/v5.5.0/css/fontawesome.min.css" integrity="sha384-u5J7JghGz0qUrmEsWzBQkfvc8nK3fUT7DCaQzNQ+q4oEXhGSx+P2OqjWsfIRB8QT" crossorigin="anonymous">
  <style type="text/css">
    html,
    body,
    header,
    .view {
      height: 100%;
    }

    @media (max-width: 740px) {
      html,
      body,
      header,
      .view {
        height: 1000px;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      html,
      body,
      header,
      .view {
        height: 650px;
      }
    }
    @media (min-width: 800px) and (max-width: 850px) {
              .navbar:not(.top-nav-collapse) {
                  background: #1C2331!important;
              }
          }
  </style>
</head>

<body>

  <!-- Full Page Intro -->
  <div class="view full-page-intro" style="background-image: url('<?php echo $base_url; ?>/imgs/bg.jpg'); background-repeat: no-repeat; background-size: cover;">

    <!-- Mask & flexbox options-->
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

      <!-- Content -->
      <div class="container">

        <!--Grid row-->
        <div class="row wow fadeIn">

          <!--Grid column-->
          <div class="col-md-6 mb-4 white-text text-center text-md-left">

            <h1 class="display-5 font-weight-bold"><?php echo @$row['sekolah'] ?></h1>

            <hr class="hr-light">

            <p class="mb-4 xd-none d-md-block lead">
              <strong><?php echo @$row['deskripsi'] ?></strong>
            </p>

            <!-- <a target="_blank" href="https://mdbootstrap.com/education/bootstrap/" class="btn btn-indigo btn-lg">Start free tutorial
              <i class="fa fa-graduation-cap ml-2"></i>
            </a> -->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6 col-xl-5 mb-4">

            <!--Card-->
            <div class="card">

              <!--Card content-->
              <div class="card-body">
                  <h3 class="dark-grey-text text-center">
                    <strong>Login</strong>
                  </h3>
                  <hr>

                  <div class="md-form">
                    <i class="far fa-user-circle prefix grey-text"></i>
                    <input type="text" id="userid" class="form-control">
                    <label for="userid">User ID</label>
                  </div>
                  <div class="md-form">
                    <i class="far fa-dot-circle prefix grey-text"></i>
                    <input type="password" id="pass" class="form-control">
                    <label for="pass">Password</label>
                  </div>
                  <div class="text-center">
                    <p><span id="notif"></span></p>
                    <button class="btn btn-indigo mt-3" id="ok">OK</button>
                    <hr>
                    <fieldset class="xform-check">
                      <span class="lead">Version <?php echo get_versi(); ?></span>
                    </fieldset>
                  </div>
              </div>

            </div>
            <!--/.Card-->

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </div>
      <!-- Content -->

    </div>
    <!-- Mask & flexbox options-->

  </div>
  <!-- Full Page Intro -->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="<?php echo $base_url ?>/assets/mdb/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?php echo $base_url ?>/assets/mdb/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?php echo $base_url ?>/assets/mdb/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?php echo $base_url ?>/assets/mdb/js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    // new WOW().init();

    $('span').click(function(event) {
      $(this).slideUp('slow');
    });


    var ok = $('#ok');
    var userid = $('#userid');
    var pass = $('#pass');
    var notif = $('#notif');

    ok.click(function(event) {
      removeClass();
      /* Act on the event */
      if (userid.val() == "" || pass.val() == "") {
        notif.slideDown('slow');
        notif.addClass('alert alert-warning');
        notif.html('Kolom User ID dan Password dibutuhkan.');
      } else {
        action_login();
      }
    });

    function removeClass() {
      notif.removeClass();
    }

    function action_login() {
      $.ajax({
        url: "<?php echo $base_url; ?>/modules/auth/auth.php",
        type: 'POST',
        dataType: 'json',
        data: {id: userid.val(), pass: pass.val()},
      })
      .done(function(res) {
        notif.slideDown('slow');
        if (res.status) {
          notif.addClass('alert alert-success');
          notif.html(res.message);
          setInterval(function(){window.location = res.redirect}, 2000);
        } else {
          notif.addClass('alert alert-warning');
          notif.html(res.message);
        }
      })
      .fail(function(res) {
        notif.slideDown('slow');
        notif.addClass('alert alert-danger');
        notif.html(res.message);
      })
      .always(function() {
      });
      
    }

  </script>
</body>

</html>

<?php } ?>