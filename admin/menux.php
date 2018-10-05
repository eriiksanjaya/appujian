<div id='cl-wrapper'>
    <div class='cl-sidebar'>
      <div class='cl-toggle'><i class='fa fa-bars'></i></div>
      <div class='cl-navblock'>
        <div class='menu-space'>
          <div class='content'>
            <div class='side-users'>
            </div>


            <div id='cssmenu'>
            <ul class='cl-vnavigation'>

<?php
error_reporting(0);
if ($_SESSION['level']=='admin'){

                $main = mysql_query("SELECT * FROM tb_menu WHERE admin= 'Y' ORDER BY urutan ASC");

                while($r = mysql_fetch_array($main)) {
                    echo'<li><a href="'.$r['link'].'"><i class="fa fa-tint color-warning"></i><span>'.$r['nama_menu'].'</span></a></li>';
				}

}
else
{
  header("location:$base_url/admin");
}
?>
<li><a href='logout.php'><i class="fa fa-sign-out color-warning"></i><span>Keluar</span></a></li>


            </ul>
            </div>


          </div>
        </div>

      </div>
    </div>
