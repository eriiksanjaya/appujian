    <section class="content-header">
      <h1>
        Pengaturan
        <small></small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->

<?php
 if (empty($_SESSION['admin_id'])){
  echo "string";
}
else{
error_reporting(0);
$aksi="pages/formdaftar/aksi_formdaftar.php";
switch($_GET['act']){
  default:
    if ($_SESSION['level']=='admin'){

  $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

      $tampil = mysqli_query($conn, "SELECT * FROM tb_set");


    echo "
    <div class='col-md-6'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'></h3>
            </div>
            <div class='box-body'>

        <div class='table-responsive'><table class='table table-bordered table-hover'>
          <thead><tr>
          <th>Pengaturan</th>
          <th>Status</th>
          <th>Aksi</th>
          </tr></thead>


       <tbody>";

  $no = $posisi+1;
    while ($r=mysqli_fetch_assoc($tampil)){
  $lebar=strlen($no);
    switch($lebar){
      case 1:
      {
        $g="0".$no;
        break;
      }
      case 2:
      {
        $g=$no;
        break;
      }
    }
     echo"<tr>
              <td>$r[set]</td>
             <td>$r[status]</td>
             <td><div class='btn-group'>
             <a href=\"$aksi?q=formdaftar&act=on&id=$r[set_id]\"><button type=button class='btn btn-success btn-xs'>On</button></a>
             <a href=\"$aksi?q=formdaftar&act=off&id=$r[set_id]\"><button type=button class='btn btn-danger btn-xs'>Off</button></a>
             </div></td></tr></tbody>";
      $no++;
    }
    echo "</table></div></div></div></div>";

    break;


}
}
}
?>
</div></div></div>
