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
          <a class="navbar-brand" href='<?php echo $base_url ?>'><?php echo $ii['sekolah'] ?></a>
          <ul class="nav navbar-nav pull-right">
          <?php
          error_reporting(0);
            if($_SESSION['guru_id']){
          ?>
          <li class="active"><a href='<?php echo $base_url ?>/guru'><?php echo $_SESSION['nama_guru'] ?></a></li>
          <?php
            }
          ?>
          </ul>



        </div>
      </div>
</nav>
      </div>
      </div>
