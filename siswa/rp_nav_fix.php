<div class='container'>
  <div class='row'>
      
<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <a class="navbar-brand" href='<?php echo $base_url ?>'>Halaman Siswa</a>
          <ul class="nav navbar-nav pull-right">
          <?php
          error_reporting(0);
            if($_SESSION['siswa_id']){
          ?>
          <li class="active"><a href='<?php echo $base_url ?>/siswa'><?php echo $_SESSION['nama_siswa'] ?></a></li>
          <?php
            }
          ?>
          
          <li><a href='' data-toggle="modal" data-target="#myModal"><i class="fa fa-exclamation-circle"></i> About</a></li>

          </ul>
          <?php include'../about.php';?>
        </div>
      </div>
</nav>


  </div>
  </div>