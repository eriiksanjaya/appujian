<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <!-- <div class="pull-left image">
          <img src="<?php echo $base_url ?>/assets/lte/dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nama_admin'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div> -->
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <!-- <li class="header">MAIN NAVIGATION</li> -->

        <?php  
          
          $data = mysqli_query($conn, "SELECT * FROM ujian_menu WHERE menu_status = '1' AND menu_isadmin = 1 ORDER BY menu_sort ASC");
          while($row=mysqli_fetch_assoc($data))
          {
            

            if($row['menu_url'] == '')
            { 
              $__data = mysqli_query($conn, "SELECT * FROM ujian_menu_detail WHERE menudetail_status = '1' AND menudetail_isadmin = '1' AND menudetail_menuid = '$row[menu_id]' ORDER BY menudetail_sort ASC");
              $__row=mysqli_fetch_assoc($__data);
          ?>

              <li class='treeview'>
                <a href="#">
                  <i class="<?php echo $row['menu_icon']; ?>"></i> <span><?php echo $row['menu_nama']; ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                <?php  
                  $_data = mysqli_query($conn, "SELECT * FROM ujian_menu_detail WHERE menudetail_status = '1' AND menudetail_isadmin = '1' AND menudetail_menuid = '$row[menu_id]' ORDER BY menudetail_sort ASC");
                  while($_row=mysqli_fetch_assoc($_data))
                  {

                ?>
                  <li class='detail'><a class="ajaxify" href="<?php echo $_row['menudetail_url']; ?>"><i class="<?php echo $_row['menudetail_icon']; ?>"></i> <?php echo $_row['menudetail_nama']; ?></a></li>
                  <?php 
                  }
                   ?>
                </ul>
              </li>

          <?php 
            }
            else
            { 
          ?>
              <li class='<?php if($_GET['q'] == str_replace('?q=', '', $row['menu_url'])){ echo 'active'; } else { echo ''; } ?>'>
                <a class="ajaxify" href="<?php echo $row['menu_url']; ?>">
                  <i class="<?php echo $row['menu_icon']; ?>"></i> <span><?php echo $row['menu_nama']; ?></span>
                  <span class="pull-right-container">
                    <!-- <small class="label pull-right bg-green">new</small> -->
                  </span>
                </a>
              </li>
          <?php
            }
          }


        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <script type="text/javascript">
    $(document).ready(function(){
      var treeview = $('.treeview');
      var detail = $('.detail');

      $(detail).click(function(){
          $(treeview).addClass("active");
      });

    });
  </script>