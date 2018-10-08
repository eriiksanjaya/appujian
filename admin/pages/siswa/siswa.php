<section class="content-header">
  <h1>
    Siswa
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
$aksi="pages/siswa/aksi_siswa.php";

switch($_GET['act']){
  
  default:

  echo"<div class='col-md-12'>";
  $menu=mysqli_query($conn, "SELECT
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.kelas_id,
tb_kelas_sub.nama_kelas,
tb_kelas_sub.blokir,
tb_siswa.siswa_id,
count(tb_siswa.nis) as jml_siswa,
tb_siswa.pass,
tb_siswa.foto,
tb_siswa.nama,
tb_siswa.kelamin
FROM
tb_kelas_sub
LEFT JOIN tb_siswa ON tb_siswa.kelas_sub_id = tb_kelas_sub.kelas_sub_id

WHERE 
tb_kelas_sub.blokir='n'
GROUP BY
tb_kelas_sub.nama_kelas
ORDER BY
tb_kelas_sub.nama_kelas ASC");
echo "<div class='box'>
        <div class='box-body'>";

while($r=mysqli_fetch_assoc($menu)){
	echo"
        <a class='btn btn-app' href=?q=siswa&act=tampilsiswa&kelas_sub_id=$r[kelas_sub_id]>
          <span class='badge bg-orange' style='font-size:16px'><strong>$r[jml_siswa]</strong></span>
          <span class=text-primary style='font-size:18px'>$r[nama_kelas]</span>
        </a>

      ";

}
echo "</div>";
break;

case "tampilsiswa";

  if ($_SESSION['level']=='admin'){ ?>

  <div class='col-md-12'>
  <div class="box">
    <div class="box-header with-border">
      <input type=button class='btn btn-danger btn-flat btn-sm' value='Tambah Siswa' onclick="window.location.href='?q=siswa&act=tambahsiswa&kelas_sub_id=<?php echo $_GET['kelas_sub_id']; ?>'">
      <div class="pull-right">
        <form class=form method=POST action='<?php echo $aksi; ?>?q=siswa&act=import' enctype="multipart/form-data">
          <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <input type="file" name="import" class="myfileimportexcel" id="import">
              <input type="hidden" name="kelas_sub_id" value="<?php echo $_GET['kelas_sub_id']; ?>">
            </div>
            <div class="pull-right">
              <input type="submit" class="btn btn-success" value="Upload">
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
    <div class="box-body">
	
	
	<?php $file="&act=tampilsiswa&kelas_sub_id='$_GET[kelas_sub_id]'";
	
	$p      = new PagingSiswa;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);
	
      $tampil = mysqli_query($conn, "SELECT
tb_siswa.id,
tb_siswa.nis,
tb_siswa.`pass`,
tb_siswa.nama,
tb_siswa.kelamin,
tb_siswa.siswa_id,
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.nama_kelas
FROM
tb_siswa
INNER JOIN tb_kelas_sub ON tb_siswa.kelas_sub_id = tb_kelas_sub.kelas_sub_id
WHERE tb_kelas_sub.kelas_sub_id='$_GET[kelas_sub_id]'
ORDER BY tb_siswa.nis"); ?>
          
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th style="width: 20px">ID</th>
                <th style="width: 20px">NIS</th>
                <th style="width: 60px">Nama</th>
                <th style="width: 20px">Kelas</th>
                <th style="width: 30px">Kelamin</th>
                <th style="width: 20px">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $no = $posisi+1;
            while ($r=mysqli_fetch_assoc($tampil)){
            $lebar=strlen($no); ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><span class=""><?php echo $r['id']; ?></span></td>
              <td><span class=""><?php echo $r['nis']; ?></span></td>
              <td><span class=""><?php echo $r['nama']; ?></span></td>
              <td><span class=""><?php echo $r['nama_kelas']; ?></span></td>
              <td><span class="<?php if($r['kelamin'] == 'Laki-Laki'){ echo "label label-primary"; }else{ echo "label label-warning"; } ?>"><?php echo $r['kelamin']; ?></span></td>
              <td>
                <a href="<?php echo'?q=siswa&act=editsiswa&id=' . $r['siswa_id']; ?>"><button type='button' class='btn btn-primary btn-xs'>Edit</button></a>
                <a href="<?php echo $aksi . '?q=siswa&act=hapus&id=' . $r['siswa_id'] . '&ksi=' . $r['kelas_sub_id']; ?>" onClick="return confirm('Hapus siswa yang bernama <?php echo $r['nama']; ?>')"><button type='button' class='btn btn-danger btn-xs'>Hapus</button></a>
      
              </td>
            </tr>
            <?php $no++; } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
<?php }

    break;
  
  case "tambahsiswa":
    if ($_SESSION['level']=='admin'){ ?>
<div class="col-md-6">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah</h3>
    </div>
    <div class="box-body">
<?php 
echo"
<form class='form' method=POST action='$aksi?q=siswa&act=input&ksi=$_GET[kelas_sub_id]'>
<div class='form-group'>
  <label>Kelas</label>
				<select class='form-control' name='kelas_sub_id' required>";
				$tampil=mysqli_query($conn, "SELECT * FROM tb_kelas_sub WHERE blokir='n' AND kelas_sub_id=$_GET[kelas_sub_id]");
           		while($r=mysqli_fetch_assoc($tampil)){
				echo"<option value=$r[kelas_sub_id]>$r[nama_kelas]</option>";
				}
				
           		$tampil=mysqli_query($conn, "SELECT * FROM tb_kelas_sub WHERE blokir ='n' ORDER BY nama_kelas");
           		while($r=mysqli_fetch_assoc($tampil)){
             	echo "<option value=$r[kelas_sub_id]>$r[nama_kelas]</option>";
          		}
   				echo "</select>
				</div>


<div class='form-group'>
  <label>Nis</label>
    <input type='text' class='form-control' name='nis' placeholder='N i s' required>
</div>

<div class='form-group'>
  <label>Nama</label>
    <input type='text' class='form-control' name='nama' placeholder='Nama Lengkap' required>
</div>

<div class='form-group'>
  <label>Password</label>
    <input type='text' class='form-control' name='pass' placeholder='Password' required>
</div>

<div class='form-group'>
  <label>Kelamin</label>
	<select class='form-control' name='kelamin' required>
  		<option value=''>Kelamin</option>
  		<option value='Laki-Laki'>Laki-Laki</option>
  		<option value='Perempuan'>Perempuan</option>      
	</select>
</div>

<div class='modal-footer'>
  <input type='button' class='btn btn-flat btn-sm btn-default' value='Batal' onclick=self.history.back()>
  <input type=submit class='btn btn-flat btn-sm btn-primary' value='Tambah'>
</div>
</form>"; ?>
</div>
</div>
</div>
<?php }
     break;
    
  case "editsiswa": ?>

  <div class="col-md-6">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit</h3>
    </div>
    <div class="box-body">

    <?php 

    $edit=mysqli_query($conn, "SELECT
tb_siswa.`pass`,
tb_siswa.siswa_id,
tb_siswa.nis,
tb_siswa.nama,
tb_siswa.kelamin,
tb_kelas_sub.kelas_sub_id
FROM
tb_siswa
INNER JOIN tb_kelas_sub ON tb_siswa.kelas_sub_id = tb_kelas_sub.kelas_sub_id
WHERE siswa_id='$_GET[id]'");
    while($r=mysqli_fetch_assoc($edit)){

    if ($_SESSION['level']=='admin'){
    echo "
          <form class='form' method=POST action=$aksi?q=siswa&act=update&ksi=$r[kelas_sub_id]>
          <input type=hidden name=id value='$r[siswa_id]'>
          <input type=hidden name=no value='$r[id]'>
		
<div class='form-group'>
  <label>Nis</label>
    <input type='text' class='form-control' name='nis' value='$r[nis]' required>
</div>

<div class='form-group'>
  <label>Nama</label>
    <input type='text' class='form-control' name='nama' value='$r[nama]' required>
</div>

<div class='form-group'>
  <label>Kelamin</label>
	<select class='form-control' name='kelamin' required>
  		<option value='$r[kelamin]'>$r[kelamin]</option>
  		<option value='Laki-Laki'>Laki-Laki</option>
  		<option value='Perempuan'>Perempuan</option>      
	</select>
</div>

<div class='form-group'>
  <label>Password</label>
    <input type='text' class='form-control' name='pass' placeholder='Password'>
    <p>Password jika tidak diubah dikosongkan saja.</p>
</div>



<div class='modal-footer'>
  <input type='button' class='btn btn-flat btn-sm btn-default' value='Batal' onclick=self.history.back()>
  <input type=submit class='btn btn-flat btn-sm btn-primary' value='Edit'>
</div>
</form>";  
	}
    }
    ?>
</div>
</div>
</div>

<?php
}
}
?>
</div>
</section>
