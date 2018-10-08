<section class="content-header">
  <h1>
    Guru
  </h1>
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
$aksi="pages/guru/aksi_guru.php";
switch($_GET['act']){
  default:
  
    if ($_SESSION['level']=='admin'){
  echo"<div class='col-md-12'>";
	$p      = new Paging;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);
	
      $tampil = mysqli_query($conn, "SELECT * FROM tb_guru ORDER BY nip ASC");
?>
<!-- Main content -->
      <div class="box">
          <div class="box-header with-border">
            <input type='button' class='btn btn-danger btn-flat btn-sm' value='Tambah' onclick="window.location.href='?q=guru&act=tambahguru'">
            <div class="pull-right">
              <form class=form method=POST action='<?php echo $aksi; ?>?q=guru&act=import' enctype="multipart/form-data">
                <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <input type="file" name="import" class="myfileimportexcel" id="import">
                  </div>
                  <div class="pull-right">
                    <input type="submit" class="btn btn-success" value="Upload">
                  </div>
                </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th style="width: 20px">NIP</th>
                <th style="width: 60px">Nama</th>
                <th style="width: 30px">Kelamin</th>
                <th style="width: 20px">Status</th>
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
                <td><span class=""><?php echo $r['nip']; ?></span></td>
                <td><span class=""><?php echo $r['nama']; ?></span></td>
                <td><span class="<?php if($r['kelamin'] == 'Laki-Laki'){ echo "label label-primary"; }else{ echo "label label-warning"; } ?>"><?php echo $r['kelamin']; ?></span></td>
                <td><span class="<?php if($r['blokir'] == 'n'){ echo "label label-success"; }else{ echo "label label-danger"; } ?>"><?php echo $r['blokir']; ?></span></td>
                <td>
                <a href="<?php echo'?q=guru&act=editguru&id='.$r['guru_id']; ?>"><button type='button' class='btn btn-primary btn-xs'>Edit</button></a>
                <a href="<?php echo $aksi . '?q=guru&act=hapus&id='.$r['guru_id']; ?>"><button type=button class='btn btn-danger btn-xs'>Hapus</button></a>
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
  
  case "tambahguru":
    if ($_SESSION['level']=='admin'){ ?>

<div class="col-md-6">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah</h3>
    </div>
    <div class="box-body">
<?php 
    echo "
<form class=form method=POST action='$aksi?q=guru&act=input'>

<div class='form-group'>
  <label>Nip</label>
    <input type='text' class='form-control' name='nip' placeholder='N i p' required>
</div>

<div class='form-group'>
  <label>Nama</label>
    <input type='text' class='form-control' name='nama_guru' placeholder='Nama Lengkap' required>
</div>

<div class='form-group'>
  <label>Password</label>
    <input type='text' class='form-control' name='password' placeholder='Password' required>
</div>

<div class='form-group'>
  <label>Kelamin</label>
  <select class='form-control' name='kelamin' required>
      <option value=''>Pilih Jenis Kelamin</option>
      <option value='Laki-Laki'>Laki-Laki</option>
      <option value='Perempuan'>Perempuan</option>      
  </select>
</div>

<div class='modal-footer'>
  <input type='button' class='btn btn-flat btn-default' value='Batal' onclick=self.history.back()>
  <input type=submit class='btn btn-flat btn-primary' value='Simpan'>
</div>
</form>"; ?>
</div>
</div>
</div>
<?php }
     break;
    
  case "editguru": ?>

  <div class="col-md-6">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit</h3>
    </div>
    <div class="box-body">

    <?php 
    $edit=mysqli_query($conn, "SELECT * FROM tb_guru WHERE guru_id='$_GET[id]'");
    $r=mysqli_fetch_assoc($edit);

    if ($_SESSION['level']=='admin'){
    echo "
<form class=form method=POST action=$aksi?q=guru&act=update>
  <input type=hidden name=id value='$r[guru_id]'>

<div class='form-group'>
  <label>Nama Guru</label>
    <input type='text' value='$r[nama]' class='form-control' disabled>
</div>

<div class='form-group'>
  <label>Password</label>
    <input type='password' class='form-control' name='password' placeholder='Password' required>
</div>

<div class='modal-footer'>
<input type=button class='btn btn-flat btn-default' value=Batal onclick=self.history.back()>
<input type=submit class='btn btn-flat btn-primary' value='Ubah Password'>
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