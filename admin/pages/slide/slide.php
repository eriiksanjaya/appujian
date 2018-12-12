
  <div class='row-fluid'>
      <div class='col-sm-12 col-md-8'>
        <div class='block-flat'>


<?php
 if (empty($_SESSION['admin_id'])){
 	echo "string";
}
else{
error_reporting(0);
$aksi="pages/slide/aksi_slide.php";
switch($_GET['act']){
  default:
    if ($_SESSION['level']=='admin'){
		
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	
      $tampil = mysql_query("SELECT * FROM tb_slide LIMIT $posisi,$batas");
      echo "
      <legend><h2>Slide</h2></legend>
       <input type='button' class='btn btn-info' value='Tambah Slide' onclick=\"window.location.href='?q=slide&act=tambahslide';\"><br><br>";
    }
    
    echo "<div class='table-responsive'><table class='table table-bordered table-hover'>
          <thead><tr>
          <th>No</th>
          <th>Slide</th>
          <th>Status</th>
          <th>Aksi</th>
          </tr></thead> 
	
	
       <tbody>";
	 
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
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
	   echo"<tr><td>$g</td>
             <td><img src='../data1/tooltips/$r[slide]'></td>
             <td>$r[status]</td>
             <td><div class='btn-group'>
             <a href=?q=slide&act=editslide&id=$r[slide_id]><button type='button' class='btn btn-inverse btn-xs'>Edit</button></a>
             <a href=\"$aksi?q=slide&act=on&id=$r[slide_id]\"><button type=button class='btn btn-inverse btn-xs'>On</button></a>
             <a href=\"$aksi?q=slide&act=off&id=$r[slide_id]\"><button type=button class='btn btn-inverse btn-xs'>Off</button></a>
             <a href=\"$aksi?q=slide&act=hapus&img=$r[slide]&id=$r[slide_id]\" onClick=\"return confirm('Hapus Slide ?')\"><button type=button class='btn btn-inverse btn-xs'>Hapus</button></a>
             </div></td></tr></tbody>";
      $no++;
    }
    echo "</table></div>


    <nav>
  <ul class='pagination  pagination-sm'>";
	
	$data = mysql_query("SELECT * FROM tb_slide");
 
$jml=mysql_num_rows($data);
if ($jml<=$batas){
}
else
{
    $jmlhalaman  = $p->jumlahHalaman($jml, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	
echo "$linkHalaman";
}
echo "</ul></nav>";
    break;
  
  case "tambahslide":
    if ($_SESSION['level']=='admin'){
    echo "
<legend><h2>Tambah slide</h2></legend>
<form class=form-horizontal method=POST enctype='multipart/form-data' action='$aksi?q=slide&act=input'>

<div class='form-group'>
  <label>Slide</label>
    <input type=file class='file' name=fupload required>
</div>

<div class='modal-footer'>
  <input type='button' class='btn btn-info' value='Batal' onclick=self.history.back()>
  <input type=submit class='btn btn-info' value='Simpan'>
</div>
</form>";
    }
    else{
      echo "Anda tidak berhak mengakses halaman ini.";
    }
     break;
    
  case "editslide":
    $edit=mysql_query("SELECT * FROM tb_slide WHERE slide_id='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    if ($_SESSION['level']=='admin'){
    echo "
<form class=form-horizontal method=POST enctype='multipart/form-data' action=$aksi?q=slide&act=update>
  <legend><h2>Edit Slide</h2></legend>
    <input type=hidden name=id value='$r[slide_id]'>
    <input type=hidden name=img value='$r[slide]'>

<div class='form-group'>
  <img src='../data1/tooltips/$r[slide]'>
</div>

<div class='form-group'>
  <label>Slide</label>
    <input type='file' class='file' name='fupload' required>
</div>

<div class='modal-footer'>
<input type=button class='btn btn-info' value=Batal onclick=self.history.back()></td></tr>
<input type=submit class='btn btn-info' value='Simpan'>
</div>
</form>
";     
	}

}
}
?>
</div></div></div>