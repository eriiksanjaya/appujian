<section class="content-header">
  <h1>
    Kelas Detail
  </h1>
</section>

<section class="content">
  <div class="row">

<?php
 if (empty($_SESSION['admin_id'])){
  echo "string";
}
else{
$aksi="pages/kelas_sub/aksi_sub_kelas.php";
switch($_GET['act']){
  default:
    if ($_SESSION['level']=='admin'){
  echo"<div class='col-md-12'>";

      $tampil = mysqli_query($conn, "SELECT
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.kelas_id,
tb_kelas.kelas,
tb_kelas.blokir as b_kelas,
tb_kelas_sub.nama_kelas,
tb_kelas_sub.blokir as b_kelassub
FROM
tb_kelas
INNER JOIN tb_kelas_sub ON tb_kelas.kelas_id = tb_kelas_sub.kelas_id 
WHERE tb_kelas.blokir = 'n'
ORDER BY tb_kelas_sub.nama_kelas ASC");

?>
<!-- Main content -->
      <div class="box">
        <div class="box-header with-border">
          <input type=button class='btn btn-danger btn-flat btn-sm' value='Tambah' onclick="window.location.href='?q=sub_kelas&act=tambahkelas'">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th style="width: 20px">Kelas</th>
              <th style="width: 20px">Kelas Detail</th>
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
              <td><span class=""><?php echo $r['kelas']; ?></span></td>
              <td><span class=""><?php echo $r['nama_kelas']; ?></span></td>
              <td><span class=""><?php echo $r['b_kelassub']; ?></span></td>
              <td>
              <a href="<?php echo'?q=sub_kelas&act=editkelas&kelas_sub_id=' . $r['kelas_sub_id'] . '&nama_kelas=' .$r['nama_kelas'] ?>"><button type='button' class='btn btn-primary btn-xs'>Edit</button></a>
              <a href="<?php echo $aksi .'?q=sub_kelas&act=hapus&id='.$r['kelas_sub_id']?>"><button type=button class='btn btn-danger btn-xs'>Hapus</button></a>
              </td>
            </tr>
            <?php $no++; } ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        
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
<form class='form' method=POST action='$aksi?q=sub_kelas&act=input'>

<div class='form-group'>
  <label>Kelas</label>
	<select class='form-control' name='kelas_id'  required>
  		<option value=''>- Pilih Kelas -</option>";
           		$tampil=mysqli_query($conn, "SELECT * FROM tb_kelas WHERE blokir = 'n' ORDER BY kelas");
           		while($r=mysqli_fetch_assoc($tampil)){
             	echo "<option value=$r[kelas_id]>$r[kelas]</option>";
          		}
   				echo "</select>
</div>		

<div class='form-group'>
  <label>Kelas</label>
    <input type='text' class='form-control' name='nama_kelas' placeholder='sub kelas cth. 1A / XB'  required>
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
  
    if ($_SESSION['level']=='admin'){ ?>

<div class="col-md-6">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit</h3>
    </div>
    <div class="box-body">
<?php 
    echo "
          <form class='form' method=POST action=$aksi?q=sub_kelas&act=update>
		  
		 <div class='form-group'>
  <label>Kelas</label>
	<select class='form-control' name='kelas_id' required>";
				$tampil=mysqli_query($conn, "SELECT
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.kelas_id,
tb_kelas.kelas,
tb_kelas_sub.nama_kelas
FROM
tb_kelas
INNER JOIN tb_kelas_sub ON tb_kelas.kelas_id = tb_kelas_sub.kelas_id
WHERE tb_kelas_sub.kelas_sub_id='$_GET[kelas_sub_id]'");
           		while($r=mysqli_fetch_assoc($tampil)){
             	echo "<option value=$r[kelas_id]>$r[kelas]</option>";
          		}
				
           		$tampil=mysqli_query($conn, "SELECT * FROM tb_kelas ORDER BY kelas");
           		while($r=mysqli_fetch_assoc($tampil)){
             	echo "<option value=$r[kelas_id]>$r[kelas]</option>";
          		}
   				echo "</select>
				</div>";
		
		  $edit=mysqli_query($conn, "SELECT * FROM tb_kelas_sub
		  WHERE tb_kelas_sub.nama_kelas='$_GET[nama_kelas]'");
    while($r=mysqli_fetch_assoc($edit)){
		
		echo"
          <input type=hidden name=id value='$r[kelas_sub_id]'>	

<div class='form-group'>
  <label>Sub Kelas</label>
    <input type='text' class='form-control' name='nama_kelas' value='$r[nama_kelas]' required>
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
}
?>
</section>
