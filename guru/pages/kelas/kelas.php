<section class="content-header">
  <h1>
    Pilih Kelas
    <small>preview</small>
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
$aksi="pages/kelas/aksi_kelas.php";
switch(@$_GET['act']){
  default:
  echo"<div class='col-md-6'>";
  $p      = new Paging;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);

    if ($_SESSION['guru_id']){ ?>
    <!-- Main content -->
      <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <div class="box-body">

  <?php 
echo"
<form action='$aksi?q=pilih-kelas&act=pilih' method='post'>
<div class='form-group input-group input-group-sm'>
    <select class='form-control' name='kelas_sub_id' required>
    <option value=''>Pilih Kelas</option>";
      $tampil=mysqli_query($conn, "SELECT * FROM tb_kelas_sub WHERE blokir ='n' ORDER BY nama_kelas");
      while($r=mysqli_fetch_assoc($tampil)){
      echo "<option value='$r[kelas_sub_id]'>$r[nama_kelas]</option>";
      }
echo "</select>
    <span class='input-group-btn'>
      <button type='submit' class='btn btn-primary btn-flat'>Pilih</button>
    </span>
</div>
</form>
";
      $tampil = mysqli_query($conn, "SELECT
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.kelas_id,
tb_kelas_sub.nama_kelas,
tb_kelas_sub.blokir,
tb_pilih_kelas.pilih_kelas_id,
tb_pilih_kelas.guru_id
FROM
tb_kelas_sub
INNER JOIN tb_pilih_kelas ON tb_pilih_kelas.kelas_sub_id = tb_kelas_sub.kelas_sub_id

WHERE tb_kelas_sub.blokir='n' AND tb_pilih_kelas.guru_id = '$_SESSION[guru_id]'
ORDER BY tb_kelas_sub.nama_kelas ASC LIMIT $posisi,$batas");

    echo"
    <table class='table table-bordered table-hover'>
          <thead>
		  <tr>
          <th>No</th>
          <th>Kelas</th>
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
            <td>$r[nama_kelas]</td>
            <td>
      <a href=\"$aksi?q=pilih-kelas&act=batal&id=$r[pilih_kelas_id]\" onClick=\"return confirm('Hapus Kelas $r[nama_kelas] ?')\"><button type=button class='btn btn-danger btn-xs'>Hapus</button></a>
             </td></tr></tbody>";
      $no++;
    }
    echo "</table>

    <nav>
  <ul class='pagination  pagination-sm'>";
	
		$data = mysqli_query($conn, "SELECT
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.kelas_id,
tb_kelas_sub.nama_kelas,
tb_kelas_sub.blokir,
tb_pilih_kelas.pilih_kelas_id,
tb_pilih_kelas.guru_id
FROM
tb_kelas_sub
INNER JOIN tb_pilih_kelas ON tb_pilih_kelas.kelas_sub_id = tb_kelas_sub.kelas_sub_id

WHERE tb_kelas_sub.blokir='n' AND tb_pilih_kelas.guru_id = '$_SESSION[guru_id]'");
 
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