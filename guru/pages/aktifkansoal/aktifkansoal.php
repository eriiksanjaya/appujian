<section class="content-header">
  <h1>
    Aktifkan Tugas
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
error_reporting(0);
include'../../config/fungsi_indotgl.php';

$aksi="pages/aktifkansoal/aksi_aktifkansoal.php";
switch($_GET['act']){
  default:
  echo"<div class='col-md-12'>";

    if ($_SESSION['guru_id']){
	
	$p      = new Paging;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);
    ?>
    <!-- Main content -->
      <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <div class="box-body">

  <?php 

echo"
<form action='$aksi?q=aktifkan-soal&act=input' method='post'>
<div class='form-group'>
  <label>Mata Pelajaran</label>
    <select class='form-control' name='pilih_mapel_id' id='mp' required>
    <option value=''>Pilih Mata Pelajaran</option>";
      $tampil=mysqli_query($conn, "SELECT
tb_pilih_mapel.pilih_mapel_id,
tb_pilih_mapel.guru_id,
tb_pilih_mapel.mapel_id,
tb_pilih_mapel.pilih,
tb_mapel.mata_pelajaran,
tb_mapel.blokir
FROM
tb_pilih_mapel
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
WHERE tb_pilih_mapel.guru_id = '$_SESSION[guru_id]' AND tb_pilih_mapel.pilih ='y' ORDER BY tb_mapel.mata_pelajaran");
      while($r=mysqli_fetch_assoc($tampil)){
      echo "<option value='$r[pilih_mapel_id]'>$r[mata_pelajaran]</option>";
      }
echo "</select>
</div>

<div class='form-group'>
  <label>Materi Soal</label>
    <select class='form-control' name='materi_soal_id' id='msid' required>
      <option value=''></option>
      <option value=''>Pilih Mata Pelajaran Dulu !</option>
    </select>
</div>

<div class='form-group'>
  <label>Kelas</label>
    <select class='form-control' name='kelas_sub_id' required>
    <option value=''>Pilih Kelas</option>";
      $tampil=mysqli_query($conn, "SELECT
tb_pilih_kelas.pilih_kelas_id,
tb_pilih_kelas.guru_id,
tb_pilih_kelas.kelas_sub_id,
tb_kelas_sub.kelas_id,
tb_kelas_sub.nama_kelas,
tb_kelas_sub.blokir
FROM
tb_pilih_kelas
INNER JOIN tb_kelas_sub ON tb_pilih_kelas.kelas_sub_id = tb_kelas_sub.kelas_sub_id
WHERE tb_pilih_kelas.guru_id ='$_SESSION[guru_id]' ORDER BY nama_kelas");
      while($rr=mysqli_fetch_assoc($tampil)){
      echo "<option value='$rr[kelas_sub_id]'>$rr[nama_kelas]</option>";
      }
echo "</select>
</div>

<div class='form-group'>
  <label>Waktu (Menit)</label>
    <input type='text' class='form-control' name='menit' placeholder='inputkan hanya angka cth. 120' required>
</div>



<div class=''>
<button type=submit class='btn btn-sm btn-flat btn-primary'> Aktifkan </button>
</div>

</form>
";


      $tampil = mysqli_query($conn, "SELECT
tb_soal_aktif.soal_aktif_id,
tb_soal_aktif.materi_soal_id,
tb_soal_aktif.kelas_sub_id,
tb_soal_aktif.menit,
tb_soal_aktif.detik,
tb_soal_aktif.aktif,
tb_soal_aktif.tgl,
tb_soal_aktif.jam,
tb_soal_aktif.selesai,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_kelas_sub.nama_kelas,
tb_pilih_mapel.pilih_mapel_id,
tb_pilih_mapel.mapel_id,
tb_mapel.mata_pelajaran
FROM
tb_soal_aktif
INNER JOIN tb_materi_soal ON tb_soal_aktif.materi_soal_id = tb_materi_soal.materi_soal_id
INNER JOIN tb_kelas_sub ON tb_kelas_sub.kelas_sub_id = tb_soal_aktif.kelas_sub_id
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id

WHERE tb_materi_soal.blokir='n' AND tb_materi_soal.guru_id = '$_SESSION[guru_id]'
ORDER BY tb_mapel.mata_pelajaran,tb_kelas_sub.nama_kelas,tb_materi_soal.materi ASC");
    
    echo "
  <div class='row'>
<div class='col-sm-12 col-md-12'>
<legend><h2>Soal yang diaktifkan</h2></legend>
  <table id='example' class='table table-striped table-bordered' cellspacing='0' width='100%'>
          <thead>
		  <tr>
          <th>No</th>
          <th>Mata Pelajaran</th>
          <th>Kelas</th>
          <th>Materi Soal</th>
          <th>Waktu</th>
          <th>Tgl</th>
          <th>Jam</th>
          <th>Status</th>
          <th>Aksi</th>
          </tr></thead>"; 
    $no=$posisi+1;
    while ($r=mysqli_fetch_assoc($tampil)){
      $tgl = tgl_indo($r['tgl']);
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
            <td>$r[nama_kelas]</td>
            <td>$r[materi]</td>
            <td>$r[menit] Menit</td>
            <td>$tgl</td>
            <td>$r[jam]</td>
            <td>$r[aktif]</td>
            <td>
            <a href=?q=aktifkan-soal&act=edit&id=$r[soal_aktif_id]><button type='button' class='btn btn-inverse btn-xs'>Edit</button></a>";
            ?>
              <a href="<?php echo $aksi . '?q=aktifkan-soal&act=hapus&sad='.$r['soal_aktif_id']. '&m='.$r['menit'] ?>"><button type=button class='btn btn-danger btn-xs'>Hapus</button></a>

            <?php if($r['aktif'] == 'aktif') { ?>
              <a href="<?php echo $aksi . '?q=aktifkan-soal&act=nonaktif&sad='.$r['soal_aktif_id']. '&m='.$r['menit'] ?>"><button type=button class='btn btn-success btn-xs'>Blokir</button></a>
              <?php }else{ ?>
              <a href="<?php echo $aksi . '?q=aktifkan-soal&act=aktif&sad='.$r['soal_aktif_id']. '&m='.$r['menit'] ?>"><button type=button class='btn btn-warning btn-xs'>Batal Blokir</button></a>
            <?php }
echo"
             </td></tr></tbody>";
      $no++;
    }
    echo "</table></div></div>";

}
    break;

case "edit":
    if ($_SESSION['guru_id']){
  echo"<div class='col-md-6'>";


    $edit=mysqli_query($conn, "SELECT
tb_soal_aktif.soal_aktif_id,
tb_soal_aktif.materi_soal_id,
tb_soal_aktif.kelas_sub_id,
tb_soal_aktif.menit,
tb_soal_aktif.detik,
tb_soal_aktif.aktif,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_kelas_sub.nama_kelas,
tb_pilih_mapel.pilih_mapel_id,
tb_pilih_mapel.mapel_id,
tb_mapel.mata_pelajaran
FROM
tb_soal_aktif
INNER JOIN tb_materi_soal ON tb_soal_aktif.materi_soal_id = tb_materi_soal.materi_soal_id
INNER JOIN tb_kelas_sub ON tb_kelas_sub.kelas_sub_id = tb_soal_aktif.kelas_sub_id
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id

WHERE tb_materi_soal.blokir='n' AND tb_soal_aktif.soal_aktif_id='$_GET[id]' AND tb_materi_soal.guru_id = '$_SESSION[guru_id]'");
    $r=mysqli_fetch_assoc($edit);

   ?>
    <!-- Main content -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

  <?php 

    echo "
<form class='form' method=POST action=$aksi?q=aktifkan-soal&act=update&sad=$r[soal_aktif_id]>


<dl class='dl-horizontal'>
  <dt>Mata Pelajaran :</dt><dd> $r[mata_pelajaran]</dd>
  <dt>Materi :</dt><dd> $r[materi]</dd>
</dl>


<div class='form-group'>
  <label>Kelas</label>
    <select class='form-control' name='kelas_sub_id' required>
    <option value='$r[kelas_sub_id]'>$r[nama_kelas]</option>";
      $tampil=mysqli_query($conn, "SELECT
tb_pilih_kelas.pilih_kelas_id,
tb_pilih_kelas.guru_id,
tb_pilih_kelas.kelas_sub_id,
tb_kelas_sub.kelas_id,
tb_kelas_sub.nama_kelas,
tb_kelas_sub.blokir
FROM
tb_pilih_kelas
INNER JOIN tb_kelas_sub ON tb_pilih_kelas.kelas_sub_id = tb_kelas_sub.kelas_sub_id
WHERE tb_pilih_kelas.guru_id ='$_SESSION[guru_id]' ORDER BY nama_kelas");
      while($rr=mysqli_fetch_assoc($tampil)){
      echo "<option value='$rr[kelas_sub_id]'>$rr[nama_kelas]</option>";
      }
echo "</select>
</div>

<div class='form-group'>
  <label>Waktu (Menit)</label>
    <input type='text' class='form-control' name='menit' placeholder='Hanya angka, cth. 120' value='$r[menit]' required>
</div>

<div class='modal-footer'>
  <input type='button' class='btn btn-sm btn-flat btn-default' value='Batal' onclick=self.history.back()>
  <input type=submit class='btn btn-sm btn-flat btn-primary' value='Edit'>
</div>
</form>";     
    break;
  
}
}
}
?>
</div>
</div>
</div>
</section>