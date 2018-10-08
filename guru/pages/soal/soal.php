<section class="content-header">
  <h1>
    Tugas
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
$aksi="pages/soal/aksi_soal.php";
switch($_GET['act']){
  default:
  echo"<div class='col-md-6'>";

    if ($_SESSION['guru_id']){
		
	$p      = new Paging;
    $batas  = 20;
    $posisi = $p->cariPosisi($batas);

    $jml_soal = mysqli_query($conn, "SELECT
tb_materi_soal.materi_soal_id,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_soal.soal_id
FROM
tb_materi_soal
RIGHT JOIN tb_soal ON tb_soal.materi_soal_id = tb_materi_soal.materi_soal_id");

    $tampil = mysqli_query($conn, "SELECT
tb_materi_soal.materi_soal_id,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_materi_soal.pilih_mapel_id,
tb_pilih_mapel.pilih,
tb_mapel.mata_pelajaran
FROM
tb_materi_soal
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
WHERE tb_materi_soal.guru_id= '$_SESSION[guru_id]' ORDER BY tb_mapel.mata_pelajaran, tb_materi_soal.materi ASC LIMIT $posisi,$batas");

?>
<!-- Main content -->
      <div class="box">
        <div class="box-header with-border">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered">
            <tr>
              <th style="width: 10px">#</th>
              <th style="width: 20px">Mata Pelajaran</th>
              <th style="width: 20px">Materi</th>
              <th style="width: 20px">Action</th>
            </tr>
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
              <td><span class=""><?php echo $r['mata_pelajaran']; ?></span></td>
              <td><span class=""><?php echo $r['materi']; ?></span></td>
              <td>

              <a><input type=button class='btn btn-primary btn-xs' value='Buat Soal' onclick="window.location.href='?q=buat-soal&act=tambahsoal&idx=<?php echo $r['materi_soal_id']; ?>'"></a>
              <a><input type=button class='btn btn-success btn-xs' value='Lihat Soal' onclick="window.location.href='?q=buat-soal&act=lihatsoal&idx=<?php echo $r['materi_soal_id']; ?>'"></a>
             
              </td>
            </tr>
            <?php $no++; } ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <ul class="pagination pagination-sm no-margin pull-right">
          <?php 
          $data = mysqli_query($conn, "SELECT
tb_materi_soal.materi_soal_id,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_materi_soal.pilih_mapel_id,
tb_pilih_mapel.pilih,
tb_mapel.mata_pelajaran
FROM
tb_materi_soal
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
WHERE tb_materi_soal.guru_id= '$_SESSION[guru_id]' "); 
          $jml=mysqli_num_rows($data);
          if ($jml<=$batas){
          }
          else
          {
              $jmlhalaman  = $p->jumlahHalaman($jml, $batas);
              $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
            
          echo "$linkHalaman";
          } ?>
          </ul>
          </div>
        </div>
        </div>
<?php 
    }
break;

  case "tambahsoal":
    if ($_SESSION['guru_id']){ ?>

<div class="col-md-8">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah</h3>
    </div>
    <div class="box-body">
<?php 
    $tambah = mysqli_query($conn, "SELECT
tb_materi_soal.materi_soal_id,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_materi_soal.pilih_mapel_id,
tb_pilih_mapel.pilih,
tb_mapel.mata_pelajaran
FROM
tb_materi_soal
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
WHERE tb_materi_soal.guru_id= '$_SESSION[guru_id]' AND tb_materi_soal.materi_soal_id = '$_GET[idx]'");
    $t = mysqli_fetch_assoc($tambah);
    echo "
<form class='form' method='POST' action='$aksi?q=buat-soal&act=input'>


<dl class='dl-horizontal'>
  <dt>Mata Pelajaran :</dt><dd> $t[mata_pelajaran]</dd>
  <dt>Materi :</dt><dd> $t[materi]</dd>
</dl>

<div class='form-group'>
    <input type='hidden' class='form-control' name='id' value='$t[materi_soal_id]'>
</div>

<div class='form-group'>
  <label>Soal</label>
    <textarea class='form-control' name='soal' id='editor' rows='8' placeholder='Pertanyaan'></textarea>
</div>

<div class='form-group pilihan'>
  <label>Pilihan A</label>
    <textarea class='form-control' name='a' id='a' placeholder='a'></textarea>
</div>
<div class='form-group pilihan'>
  <label>Pilihan B</label>
    <textarea class='form-control' name='b' id='b' placeholder='b'></textarea>
</div>

<div class='form-group pilihan'>
  <label>Pilihan C</label>
    <textarea class='form-control' name='c' id='c' placeholder='c'></textarea>
</div>

<div class='form-group pilihan'>
  <label>Pilihan D</label>
    <textarea class='form-control' name='d' id='d' placeholder='d'></textarea>
</div>

<div class='form-group pilihan'>
  <label>Pilihan E</label>
    <textarea class='form-control' name='e' id='e' placeholder='e'></textarea>
</div>

<div class='form-group'>
  <label>Jawaban</label>
    <select class='form-control' name='j'>
    <option value=''>Pilih Jawaban</option>
    <option value='a'>A</option>
    <option value='b'>B</option>
    <option value='c'>C</option>
    <option value='d'>D</option>
    <option value='e'>E</option>
</select>
</div>

<div class='modal-footer'>
  <input type='button' class='btn btn-sm btn-flat btn-default' value='Batal'' onclick=self.history.back()>
  <input type=submit class='btn btn-sm btn-flat btn-primary' value='Simpan'>
</div>
</form>
"; ?>
</div>
</div>
</div>
<?php }
     break;



  case "lihatsoal":
  echo"<div class='col-md-12'>";

    if ($_SESSION['guru_id']){
    $p      = new PagingLihatSoal;
    $batas  = 25;
    $posisi = $p->cariPosisi($batas);

     $tampil = mysqli_query($conn, "SELECT
tb_materi_soal.materi_soal_id,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_soal.soal_id,
tb_soal.soal,
tb_soal.a,
tb_soal.b,
tb_soal.c,
tb_soal.d,
tb_soal.e,
tb_soal.jawaban,
tb_soal.blokir,
tb_soal.tgl,
tb_soal.jam
FROM
tb_materi_soal
INNER JOIN tb_soal ON tb_soal.materi_soal_id = tb_materi_soal.materi_soal_id
WHERE
tb_materi_soal.materi_soal_id = '$_GET[idx]' ORDER BY tb_soal.soal_id DESC");

$mtri = mysqli_query($conn, "SELECT
tb_materi_soal.materi_soal_id,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_materi_soal.pilih_mapel_id,
tb_pilih_mapel.pilih,
tb_mapel.mata_pelajaran
FROM
tb_materi_soal
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
WHERE tb_materi_soal.guru_id= '$_SESSION[guru_id]' AND tb_materi_soal.materi_soal_id = '$_GET[idx]'");
$m=mysqli_fetch_assoc($mtri);
?>
<!-- Main content -->
      <div class="box">
        <div class="box-header with-border">
          <input type=button class='btn btn-danger btn-flat btn-sm' value='Tambah' onclick="window.location.href='?q=buat-soal&act=tambahsoal&idx=<?php echo $m['materi_soal_id']; ?>'">

          <div class="pull-right">
              <form class=form method=POST action='<?php echo $aksi; ?>?q=buat-soal&act=import' enctype="multipart/form-data">
                <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <input type="file" name="import" class="myfileimportexcel" id="import">
                    <input type="hidden" name="msi" value="<?php echo $_GET['idx']; ?>">
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
<?php 

echo"


<dl class='dl-horizontal ifo-order'>
  <dt>Mata Pelajaran :</dt><dd> $m[mata_pelajaran]</dd>
  <dt>Materi :</dt><dd> $m[materi]</dd>
</dl>


    <div class='table-responsive'>
  <table id='example' class='table table-striped table-bordered' cellspacing='0' width='100%'>
            <thead>
      <tr>
          <th>No</th>
          <th>Soal</th>
          <th>Jawaban</th>
          <th>Blokir</th>
          <th>Aksi</th>
          </tr>
      </thead>"; 
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
             <td>$r[soal]</td>
             <td>$r[jawaban]</td>
             <td>$r[blokir]</td>
             <td><div class='btn-group'>
             <a href=?q=buat-soal&act=editsoal&id=$r[soal_id]><button type='button' class='btn btn-primary btn-xs'>Edit</button></a>"; 
             ?>

             <?php if($r['blokir'] == 'n') { ?>
              <a href="<?php echo $aksi .'?q=buat-soal&act=blokir&id='.$r['soal_id'].'&msi=' .$m['materi_soal_id'] ?>"><button type=button class='btn btn-warning btn-xs'>Blokir</button></a>
              <?php }else{ ?>
              <a href="<?php echo $aksi . '?q=buat-soal&act=batal&id='.$r['soal_id'].'&msi=' .$m['materi_soal_id'] ?>"><button type=button class='btn btn-success btn-xs'>Batal Blokir</button></a>
            <?php }

        echo"
             <a href=\"$aksi?q=buat-soal&act=hapus&id=$r[soal_id]&msi=$m[materi_soal_id]\" onClick=\"return confirm('Yakin ingin menghapus soal ?')\"><button type=button class='btn btn-danger btn-xs'>Hapus</button></a>
             

       </td></tr></tbody>";
      $no++;
    }
    echo "</table></div>";
}
    break;


    
  case "editsoal":
    if ($_SESSION['guru_id']){

    $edit=mysqli_query($conn, "SELECT
tb_materi_soal.materi_soal_id,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_soal.soal_id,
tb_soal.soal,
tb_soal.a,
tb_soal.b,
tb_soal.c,
tb_soal.d,
tb_soal.e,
tb_soal.jawaban,
tb_soal.blokir,
tb_soal.tgl,
tb_soal.jam
FROM
tb_materi_soal
INNER JOIN tb_soal ON tb_soal.materi_soal_id = tb_materi_soal.materi_soal_id
WHERE tb_materi_soal.guru_id = '$_SESSION[guru_id]' AND tb_soal.soal_id='$_GET[id]'");
    $r=mysqli_fetch_assoc($edit);

    $idmateri = $r['materi_soal_id'];

$mtri = mysqli_query($conn, "SELECT
tb_materi_soal.materi_soal_id,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_materi_soal.pilih_mapel_id,
tb_pilih_mapel.pilih,
tb_mapel.mata_pelajaran
FROM
tb_materi_soal
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
WHERE tb_materi_soal.guru_id= '$_SESSION[guru_id]' AND tb_materi_soal.materi_soal_id = '$idmateri'");
$m=mysqli_fetch_assoc($mtri);?>

<div class="col-md-8">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit</h3>
    </div>
    <div class="box-body">
<?php

    echo "
<form class='form' method=POST action=$aksi?q=buat-soal&act=update>

<dl class='dl-horizontal'>
  <dt>Mata Pelajaran :</dt><dd> $m[mata_pelajaran]</dd>
  <dt>Materi :</dt><dd> $m[materi]</dd>
</dl>


<div class='form-group'>
    <input type='hidden' class='form-control' name='msi' value='$m[materi_soal_id]'>
    <input type='hidden' class='form-control' name='id' value='$r[soal_id]'>
</div>


<div class='form-group'>
  <label>Soal</label>
    <textarea class='form-control' name='soal' id='editor' placeholder='Pertanyaan'>$r[soal]</textarea>
</div>

<div class='form-group pilihan'>
  <label>Pilihan A</label>
    <textarea class='form-control' name='a' id='a' placeholder='a'>$r[a]</textarea>
</div>

<div class='form-group pilihan'>
  <label>Pilihan B</label>
    <textarea class='form-control' name='b' id='b' placeholder='b'>$r[b]</textarea>
</div>


<div class='form-group pilihan'>
  <label>Pilihan C</label>
    <textarea class='form-control' name='c' id='c' placeholder='c'>$r[c]</textarea>
</div>

<div class='form-group pilihan'>
  <label>Pilihan D</label>
    <textarea class='form-control' name='d' id='d' placeholder='d'>$r[d]</textarea>
</div>


<div class='form-group pilihan'>
  <label>Pilihan E</label>
    <textarea class='form-control' name='e' id='e' placeholder='e'>$r[e]</textarea>
</div>


<div class='form-group'>
  <label>Jawaban</label>
    <select class='form-control text-capitalize' name='j'>
    <option value='$r[jawaban]'>$r[jawaban]</option>
    <option value='a'>A</option>
    <option value='b'>B</option>
    <option value='c'>C</option>
    <option value='d'>D</option>
    <option value='e'>E</option>
</select>
</div>

<div class='modal-footer'>
  <input type='button' class='btn btn-sm btn-flat btn-default' value='Batal'' onclick=self.history.back()>
  <input type=submit class='btn btn-sm btn-flat btn-primary' value='Edit'>
</div>
</form>
"; ?>
</div>
</div>
</div>
<?php }
}
}
?>
</section>
