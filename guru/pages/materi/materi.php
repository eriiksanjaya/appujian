<section class="content-header">
  <h1>
    Materi
  </h1>
</section>

<section class="content">
  <div class="row">


<?php
 if (empty($_SESSION['guru_id'])){
  header("location:../../index.php");
}
else{
$aksi="pages/materi/aksi_materi.php";
switch(@$_GET['act']){
  default:
  echo"<div class='col-md-8'>";

    if ($_SESSION['guru_id']){
      $tampil = mysqli_query($conn, "SELECT
tb_materi_soal.materi_soal_id,
tb_materi_soal.pilih_mapel_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_pilih_mapel.guru_id,
tb_mapel.mapel_id,
tb_mapel.mata_pelajaran
FROM
tb_materi_soal
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
WHERE tb_pilih_mapel.guru_id= '$_SESSION[guru_id]' ORDER BY tb_mapel.mata_pelajaran ASC");


?>
      <div class="box">
        <div class="box-header with-border">
          <input type=button class='btn btn-danger btn-flat btn-sm' value='Tambah' onclick="window.location.href='?q=materi-soal&act=tambahmateri'">
        </div>
        <div class="box-body">
          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th style="width: 20px">Mata Pelajaran</th>
              <th style="width: 20px">Materi</th>
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
              <td><span class=""><?php echo $r['mata_pelajaran']; ?></span></td>
              <td><span class=""><?php echo $r['materi']; ?></span></td>
              <td><span class=""><?php echo $r['blokir']; ?></span></td>
              <td>
              <a href="<?php echo'?q=materi-soal&act=editmateri&id=' . $r['materi_soal_id']; ?>"><button type='button' class='btn btn-primary btn-xs'>Edit</button></a>
              <a href="<?php echo $aksi .'?q=materi-soal&act=hapus&id='.$r['materi_soal_id']?>"><button type=button class='btn btn-danger btn-xs'>Hapus</button></a>
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

  case "tambahmateri":
    if ($_SESSION['guru_id']){ ?>

<div class="col-md-6">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah</h3>
    </div>
    <div class="box-body">
<?php 
    echo "
<form class='form' method=POST action='$aksi?q=materi-soal&act=input'>


<div class='form-group'>
  <label>Pilih Mapel</label>
    <select class='form-control' name='pilih_mapel_id' required>
    <option value=''>Pilih Mata Pelajaran</option>";
      $tampil=mysqli_query($conn, "SELECT
tb_pilih_mapel.guru_id,
tb_mapel.mata_pelajaran,
tb_pilih_mapel.pilih_mapel_id,
tb_pilih_mapel.mapel_id,
tb_pilih_mapel.pilih
FROM
tb_pilih_mapel
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
WHERE tb_pilih_mapel.guru_id = '$_SESSION[guru_id]' AND tb_pilih_mapel.pilih ='y' ORDER BY mata_pelajaran");
      while($r=mysqli_fetch_assoc($tampil)){
      echo "<option value='$r[pilih_mapel_id]'>$r[mata_pelajaran]</option>";
      }
echo "</select>
</div>

<div class='form-group'>
  <label>materi</label>
    <input type='text' class='form-control' name='materi' placeholder='materi'  required>
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
    
  case "editmateri":
    $edit=mysqli_query($conn, "SELECT
tb_mapel.mata_pelajaran,
tb_pilih_mapel.mapel_id,
tb_materi_soal.materi_soal_id,
tb_materi_soal.guru_id,
tb_materi_soal.pilih_mapel_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_pilih_mapel.pilih
FROM
tb_pilih_mapel
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
INNER JOIN tb_materi_soal ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
WHERE tb_materi_soal.materi_soal_id='$_GET[id]'");
    $r=mysqli_fetch_assoc($edit);

    if ($_SESSION['guru_id']){ ?>

<div class="col-md-6">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit</h3>
    </div>
    <div class="box-body">
<?php
    echo "
<form class='form' method=POST action=$aksi?q=materi-soal&act=update>
<input type=hidden name=id value='$r[materi_soal_id]'>

<div class='form-group'>
  <label>Pilih Mapel</label>
    <select class='form-control' name='pilih_mapel_id' required>
    <option value='$r[pilih_mapel_id]'>$r[mata_pelajaran]</option>";
      $tampil=mysqli_query($conn, "SELECT
tb_pilih_mapel.guru_id,
tb_mapel.mata_pelajaran,
tb_pilih_mapel.pilih_mapel_id,
tb_pilih_mapel.mapel_id,
tb_pilih_mapel.pilih
FROM
tb_pilih_mapel
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
WHERE tb_pilih_mapel.guru_id = '$_SESSION[guru_id]' AND tb_pilih_mapel.pilih ='y' ORDER BY mata_pelajaran");
      while($r2=mysqli_fetch_assoc($tampil)){
      echo "<option value='$r2[pilih_mapel_id]'>$r2[mata_pelajaran]</option>";
      }
echo "</select>
</div>

<div class='form-group'>
  <label>materi</label>
    <input type='text' class='form-control' name='materi' value='$r[materi]' required>
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
