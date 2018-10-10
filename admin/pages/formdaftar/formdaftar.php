    <section class="content-header">
      <h1>
        Pengaturan
      </h1>
     
    </section>

    <section class="content">
      <div class="row">
<?php
 if (empty($_SESSION['admin_id'])){
  echo "string";
}
else{
$aksi="pages/formdaftar/aksi_formdaftar.php";
switch($_GET['act']){
  default:
    if ($_SESSION['level']=='admin'){

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

  $no = 1;
    while ($r=mysqli_fetch_assoc($tampil)){ 
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
