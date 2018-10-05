<section class="content-header">
  <h1>
    Pilih Mapel
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
 if (empty($_SESSION['guru_id'])){
  header("location:../../index.php");
}
else{
error_reporting(0);
$aksi="pages/mapel/aksi_mapel.php";
switch($_GET['act']){
  default:
  echo"<div class='col-md-6'>";
    if ($_SESSION['guru_id']){ ?>

    <!-- Main content -->
      <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <div class="box-body">

  <?php
	
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

echo"
<form action='$aksi?q=pilih-mapel&act=pilih' method='post'>
<div class='form-group input-group input-group-sm'>
    <select class='form-control' name='mapel_id' required>
    <option value=''>Pilih Mata Pelajaran</option>";
      $tampil=mysqli_query($conn, "SELECT * FROM tb_mapel WHERE blokir ='n' ORDER BY mata_pelajaran");
      while($r=mysqli_fetch_assoc($tampil)){
      echo "<option value='$r[mapel_id]'>$r[mata_pelajaran]</option>";
      }
echo "</select>
    <span class='input-group-btn'>
      <button type='submit' class='btn btn-primary btn-flat'>Pilih</button>
    </span>
</div>
</form>";


      $tampil = mysqli_query($conn, "SELECT
tb_mapel.mapel_id,
tb_mapel.mata_pelajaran,
tb_mapel.blokir,
tb_pilih_mapel.pilih_mapel_id,
tb_pilih_mapel.guru_id,
tb_pilih_mapel.pilih
FROM
tb_mapel
LEFT JOIN tb_pilih_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
WHERE tb_mapel.blokir='n' AND tb_pilih_mapel.guru_id = '$_SESSION[guru_id]'
ORDER BY tb_mapel.mata_pelajaran ASC LIMIT $posisi,$batas");
      echo "
    <table class='table table-bordered table-hover'>
          <thead>
		  <tr>
          <th>No</th>
          <th>Nama Mata Pelajaran</th>
          <th>Aksi</th>
          </tr></thead>"; 
    $no=$posisi+1;
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
       echo "<tbody><tr>
	   		<td>$no</td>
            <td>$r[mata_pelajaran]</td>
            <td>
      <a href=\"$aksi?q=pilih-mapel&act=batal&id=$r[pilih_mapel_id]\" onClick=\"return confirm('Hapus Mata Pelajaran $r[mata_pelajaran] ?')\"><button type=button class='btn btn-danger btn-xs'>Hapus</button></a>
             </td></tr></tbody>";
      $no++;
    }
    echo "</table>

    <nav>
  <ul class='pagination  pagination-sm'>";
	
		$data = mysqli_query($conn, "SELECT
tb_mapel.mapel_id,
tb_mapel.mata_pelajaran,
tb_mapel.blokir,
tb_pilih_mapel.pilih_mapel_id,
tb_pilih_mapel.guru_id,
tb_pilih_mapel.pilih
FROM
tb_mapel
LEFT JOIN tb_pilih_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
WHERE tb_mapel.blokir='n' AND tb_pilih_mapel.guru_id = '$_SESSION[guru_id]'");
 
$jml=mysqli_num_rows($data);
if ($jml<=$batas){
}
else
{
    $jmlhalaman  = $p->jumlahHalaman($jml, $batas);
    $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
	
	echo "$linkHalaman";
}
echo "</ul></nav>";
    break;
  
  }
}
}
?>
</div>
</div>
</div>
</section>