<?php 
  $foto = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE siswa_id = '$_SESSION[siswa_id]'");
  $f = mysqli_fetch_assoc($foto);
?>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if($f['foto'] != '') { ?>
          <img src="<?php echo $base_url ?>/imgs/profile/<?php echo $f['foto'] ?>" class="img-circle" alt="User Image">
          <?php } elseif($f['kelamin'] == 'Laki-Laki') { ?>
            <img src="<?php echo $base_url; ?>/assets/lte/dist/img/male.png" class="img-circle" alt="User Image">
          <?php } else { ?>
            <img src="<?php echo $base_url; ?>/assets/lte/dist/img/female.png" class="img-circle" alt="User Image">
          <?php } ?></div>
        <div class="pull-left info">
          <p><?php echo @$_SESSION['panggilan'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
