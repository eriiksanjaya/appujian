<section class="content-header">
  <h1>
    Pilih Mapel
  </h1>
</section>

<section class="content">
  <div class="row">
<?php
 if (empty($_SESSION['guru_id'])){
  header("location:../../index.php");
}
else{
$aksi="pages/mapel/aksi_mapel.php";
switch(@$_GET['act']){
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

$no =1;
      $tampila = mysqli_query($conn, "SELECT
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
ORDER BY tb_mapel.mata_pelajaran ASC");
      echo "
    <table class='table table-bordered table-hover'>
          <thead>
		  <tr>
          <th>No</th>
          <th>Nama Mata Pelajaran</th>
          <th>Aksi</th>
          </tr></thead>"; 
    while ($ra=mysqli_fetch_assoc($tampila)){
       echo "<tbody><tr>
	   		<td>$no</td>
            <td>$ra[mata_pelajaran]</td>
            <td>
      <a href=\"$aksi?q=pilih-mapel&act=batal&id=$ra[pilih_mapel_id]\" onClick=\"return confirm('Hapus Mata Pelajaran $ra[mata_pelajaran] ?')\"><button type=button class='btn btn-danger btn-xs'>Hapus</button></a>
             </td></tr></tbody>";
    $no++;
      
    }
    echo "</table>";
    break;
  
  }
}
}
?>
</div>
</div>
</div>
</section>