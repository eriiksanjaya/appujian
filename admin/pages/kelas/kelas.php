<section class="content-header">
  <h1>
    Kelas
  </h1>
  <!-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tables</a></li>
    <li class="active">Simple</li>
  </ol> -->
</section>

<!-- Main content -->
<section class="content">
  <div class="row">

<?php
 if (empty($_SESSION['admin_id'])){
  echo "string";
}
else{
error_reporting(0);
$aksi="pages/kelas/aksi_kelas.php";
switch($_GET['act']){
  default:
    if ($_SESSION['level']=='admin'){
  echo"<div class='col-md-12'>";
		
	$p      = new Paging;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);
	
      $tampil = mysqli_query($conn, "SELECT * FROM tb_kelas ORDER BY kelas ASC");
?>
      <!-- Main content -->
      <div class="box">
        <div class="box-header with-border">
          <input type=button class='btn btn-danger btn-flat btn-sm' value='Tambah' onclick="window.location.href='?q=kelas&act=tambahkelas'">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th style="width: 20px">Kelas</th>
              <th style="width: 60px">Status</th>
              <th style="width: 20px">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
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
            } ?>

            <tr>
              <td><?php echo $g; ?></td>
              <td><span class=""><?php echo $r['kelas']; ?></span></td>
              <td><span class=""><?php echo $r['blokir']; ?></span></td>
              <td>
              <a href="<?php echo'?q=kelas&act=editkelas&id='.$r['kelas_id']; ?>"><button type='button' class='btn btn-primary btn-xs'>Edit</button></a>
              <a href="<?php echo $aksi . '?q=kelas&act=hapus&id='.$r['kelas_id']; ?>"><button type=button class='btn btn-danger btn-xs'>Hapus</button></a>
              </td>
            </tr>
            <?php $no++; } ?>
            </tbody>
          </table>
        </div>
        
        </div>
      </div>
</div>
<?php 
    }
break;

  case "tambahkelas":
    if ($_SESSION['level']=='admin'){ ?>

<div class="col-md-6">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah</h3>
    </div>
    <div class="box-body">
<?php 
    echo "
<form class='form' method=POST action='$aksi?q=kelas&act=input'>

<div class='form-group'>
  <label>Kelas</label>
    <input type='text' class='form-control' name='kelas' placeholder='Kelas' required>
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
    
  case "editkelas":
    $edit=mysqli_query($conn, "SELECT * FROM tb_kelas WHERE kelas_id='$_GET[id]'");
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
<form class='form' method=POST action=$aksi?q=kelas&act=update>
<input type=hidden name=id value='$r[kelas_id]'>

<div class='form-group'>
  <label>Kelas</label>
    <input type='text' class='form-control' name='kelas' value='$r[kelas]'  required>
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