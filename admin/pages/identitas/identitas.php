    <section class="content-header">
      <h1>
        Identitas Sekolah
        <small>Edit</small>
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
$aksi="pages/identitas/aksi_identitas.php";
switch($_GET['act']){
  default:
    if ($_SESSION['level']=='admin'){
		
	
      $tampil = mysqli_query($conn, "SELECT * FROM tb_identitas ");


      echo "
      <div class='col-md-6'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'></h3>
            </div>
            <div class='box-body'>

      <div class='table-responsive'><table class='table table-bordered table-hover'>";
	 
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
	   echo"
          
          <tr><th>Nama Sekolah</th><td>$r[sekolah]</td></tr>
          <tr><th>Alamat</th><td>$r[alamat]</td></tr>
          <tr><th>Judul Website</th><td>$r[judul]</td></tr>
          <tr><th>Deskripsi</th><td>$r[deskripsi]</td></tr>
          <tr><th>Aksi</th><td><div class='btn-group'>
             <a href=?q=identitas&act=editidentitas&id=$r[identitas_id]><button type='button' class='btn btn-primary btn-xs'>Edit</button></a>
             </div></td></tr>";
    }
    echo "</table></div></div></div></div>";

}
    break;
  
  case "editidentitas":
    $edit=mysqli_query($conn, "SELECT * FROM tb_identitas WHERE identitas_id='$_GET[id]'");
    $r=mysqli_fetch_assoc($edit);

    if ($_SESSION['level']=='admin'){
    echo "
    <div class='col-md-6'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Edit</h3>
            </div>
            <div class='box-body'>

<form class=form method=POST action=$aksi?q=identitas&act=update>
	<input type=hidden name=id value='$r[identitas_id]'>

<div class='form-group'>
  <label>Nama Sekolah</label>
    <input type='text' class='form-control' name='sekolah' placeholder='Nama Sekolah' value='$r[sekolah]' required>
</div>
<div class='form-group'>
  <label>Alamat</label>
    <textarea class='form-control' name='alamat' placeholder='Alamat' required>$r[alamat]</textarea>
</div>

<div class='form-group'>
  <label>Judul Website</label>
    <input type='text' class='form-control' name='judul' placeholder='Judul Website' value='$r[judul]' required>
</div>

<div class='form-group'>
  <label>Deskripsi</label>
    <textarea class='form-control' id='editor' name='deskripsi' placeholder='Deskripsi' required>$r[deskripsi]</textarea>
</div>

<div class='modal-footer'>
<input type=button class='btn btn-sm btn-flat btn-default' value='Batal' onclick=self.history.back()></td></tr>
<input type=submit class='btn btn-sm btn-flat btn-primary' value='Simpan'>
</div>
</form>
</div>
        </div>
        </div>
";     
	  }
  }
}
?>

      </div>
    </section>