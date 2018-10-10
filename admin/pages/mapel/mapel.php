<section class="content-header">
  <h1>
    Mata Pelajaran
  </h1>
</section>

<section class="content">
  <div class="row">
<?php
 if (empty($_SESSION['admin_id'])){
  echo "string";
}
else{
$aksi="pages/mapel/aksi_mapel.php";
switch($_GET['act']){
  default:
    if ($_SESSION['level']=='admin'){
  echo"<div class='col-md-12'>";

      $tampil = mysqli_query($conn, "SELECT * FROM tb_mapel ORDER BY mata_pelajaran ASC");
      ?>
      <!-- Main content -->
      <div class="box">
        <div class="box-header with-border">
          <input type=button class='btn btn-danger btn-flat btn-sm' value='Tambah' onclick="window.location.href='?q=mapel&act=tambahmapel'">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th style="width: 20px">Mata Pelajaran</th>
              <th style="width: 60px">Status</th>
              <th style="width: 20px">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            while ($r=mysqli_fetch_assoc($tampil)){ ?>

            <tr>
              <td><?php echo $no; ?></td>
              <td><span class=""><?php echo $r['mata_pelajaran']; ?></span></td>
              <td><span class=""><?php echo $r['blokir']; ?></span></td>
              <td>
              <a href="<?php echo'?q=mapel&act=editmapel&id='.$r['mapel_id']; ?>"><button type='button' class='btn btn-primary btn-xs'>Edit</button></a>
              <a href="<?php echo $aksi . '?q=mapel&act=hapus&id='.$r['mapel_id']; ?>"><button type=button class='btn btn-danger btn-xs'>Hapus</button></a>
              </td>
            </tr>
            <?php $no++; } ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        </div>
      </div>
</div>
<?php 
    }
break;
  
  case "tambahmapel":
    if ($_SESSION['level']=='admin'){?>

<div class="col-md-6">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah</h3>
    </div>
    <div class="box-body">
<?php 
    echo "
          <form class='form' method=POST action='$aksi?q=mapel&act=input'>
		  
<div class='form-group'>
  <label>Mata Pelajaran</label>
    <input type='text' class='form-control' name='nama_mapel' placeholder='Mata Pelajaran' required>
</div>

<div class='modal-footer'>
  <input type='button' class='btn btn-sm btn-flat btn-default' value='Batal' onclick=self.history.back()>
  <input type=submit class='btn btn-sm btn-flat btn-primary' value='Simpan'>
</div>
</form>"; ?>
</div>
</div>
</div>
<?php }
     break;
    
  case "editmapel":
    $edit=mysqli_query($conn, "SELECT * FROM tb_mapel WHERE mapel_id='$_GET[id]'");
    $r=mysqli_fetch_assoc($edit);

    if ($_SESSION['level']=='admin'){ ?>

<div class="col-md-6">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit</h3>
    </div>
    <div class="box-body">
<?php 
    echo "
          <form class='form' method=POST action=$aksi?q=mapel&act=update>
          <input type=hidden name=id value='$r[mapel_id]'>
<div class='form-group'>
  <label>Mata Pelajaran</label>
    <input type='text' class='form-control' name='nama_mapel' value='$r[mata_pelajaran]' required>
</div>

<div class='modal-footer'>
  <input type='button' class='btn btn-sm btn-flat btn-default' value='Batal' onclick=self.history.back()>
  <input type=submit class='btn btn-sm btn-flat btn-primary' value='Edit'>
</div>
</form>"; ?>
</div>
</div>
</div>
<?php }

}
}
?>
</section>