<?php
 if (empty($_SESSION['siswa_id'])){
  echo "string";
}
else{

$aksi="pages/profil/aksi_profil.php";

$siswa = mysqli_query($conn, "SELECT * FROM vw_siswa
WHERE siswa_id = '$_SESSION[siswa_id]'");
$img = mysqli_fetch_assoc($siswa);

$teman = mysqli_query($conn, "SELECT * FROM vw_siswa WHERE kelas_sub_id = '$img[kelas_sub_id]' AND siswa_id != '$_SESSION[siswa_id]'");
$jml_teman = mysqli_num_rows($teman);
?>

  <section class="content-header">
      <h1>
        Profil
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

      <div class="col-md-4">

      <div class="row">
      <div class="col-md-12">

          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('<?php echo $base_url; ?>/imgs/cover/cover1.jpg') center;">
            <!-- <div class="widget-user-header bg-yellow"> -->
              <div class="widget-user-image">
              <?php if($f['foto'] != '') { ?>
                <img data-toggle='modal' data-target='#modal' src="<?php echo $base_url ?>/imgs/profile/<?php echo $f['foto'] ?>" class="img-circle" alt="User Image">
                <?php } elseif($f['kelamin'] == 'Laki-Laki') { ?>
                  <img data-toggle='modal' data-target='#modal' src="<?php echo $base_url ?>/assets/lte/dist/img/male.png" class="img-circle" alt="User Image">
                <?php } else { ?>
                  <img data-toggle='modal' data-target='#modal' src="<?php echo $base_url ?>/assets/lte/dist/img/female.png" class="img-circle" alt="User Image">
                <?php } ?>
              </div>

              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php echo $img['nama'] ?></h3>
              <h5 class="widget-user-desc"><?php echo $img['nama_kelas'] ?></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Semua Tugas <span class="pull-right badge bg-aqua"><?php echo app_count_tugas_aktif($_SESSION['siswa_id'], $conn); ?></span></a></li>
                <li><a href="#">Tugas Selesai <span class="pull-right badge bg-green"><?php echo app_count_tugas_selesai($_SESSION['siswa_id'], $conn); ?></span></a></li>
                <li><a href="#">Belum Selesai <span class="pull-right badge bg-red"><?php echo app_count_tugas_aktif($_SESSION['siswa_id'], $conn)-app_count_tugas_selesai($_SESSION['siswa_id'], $conn); ?></span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>

        


        <div class="col-md-12">
              <!-- USERS LIST -->
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Teman Satu Kelas</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-warning"><?php echo $jml_teman; ?> Teman</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i> -->
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding" id="item">
                  <ul class="users-list clearfix">
                  <?php while($rt=mysqli_fetch_assoc($teman)) { ?>
                    <li>
                    <?php if(!empty($rt['foto'])) { ?>
                      <img class="img-circle" src="<?php echo $base_url; ?>/imgs/profile/<?php echo $rt['foto'] ?>" alt="User Avatar">
                    <?php }elseif($rt['kelamin'] == 'Laki-Laki'){ ?>
                      <img class="img-circle" src="<?php echo $base_url; ?>/assets/lte/dist/img/male.png" alt="User Avatar">
                    <?php } else { ?>
                      <img class="img-circle" src="<?php echo $base_url; ?>/assets/lte/dist/img/female.png" alt="User Avatar">
                    <?php } ?>
                      <a class="users-list-name" href="#"><?php echo $rt['nama']; ?></a>
                      <!-- <span class="users-list-date">8 Tahun</span> -->
                    </li>
                  <?php } ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <!-- <a href="javascript:void(0)" class="uppercase">Teman</a> -->
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>


        </div>
        </div>




        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <div class="box-body">

<form class=form-horizontal method=POST action='<?php echo $aksi ?>'>

<div class='form-group'>
<label class="col-sm-3 control-label">ID</label>
  <div class="col-sm-9">
    <input type='text' class='form-control' name='' value="<?php echo $img['id']; ?>" disabled>
  </div>
</div>

<div class='form-group'>
<label class="col-sm-3 control-label">NIS</label>
  <div class="col-sm-9">
    <input type='text' class='form-control' name='nis' placeholder="NIS" value="<?php echo $img['nis']; ?>" required>
  </div>
</div>

<div class='form-group'>
<label class="col-sm-3 control-label">Nama Lengkap</label>
  <div class="col-sm-9">
    <input type='text' class='form-control' name='nama' value="<?php echo $img['nama']; ?>" required>
  </div>
</div>

<div class='form-group'>
<label class="col-sm-3 control-label">Nama Panggilan</label>
  <div class="col-sm-9">
    <input type='text' class='form-control' name='panggilan' value="<?php echo $img['panggilan']; ?>" required>
  </div>
</div>

<div class='form-group'>
<label class="col-sm-3 control-label">Kelas</label>
  <div class="col-sm-9">
    <select class='form-control' name='kelas' id='kelas' <?php $status = app_setting('editkelas', $conn); if($status['status']=='off') echo "disabled"; else echo "required"; ?>>
      <option value='<?php echo $img['kelas_id']; ?>'><?php echo $img['kelas']; ?></option>
    <?php $kelas=mysqli_query($conn, "SELECT * FROM tb_kelas WHERE blokir='n'"); while($k = mysqli_fetch_assoc($kelas)){?>
      <option value='<?php echo $k['kelas_id']; ?>'><?php echo $k['kelas']; ?></option>
    <?php } ?>
  </select>
  </div>
</div>

<div class='form-group'>
<label class="col-sm-3 control-label">Sub Kelas</label>
  <div class="col-sm-9">
    <select class='form-control' name='subkelas' id='subkelas' <?php $status = app_setting('editkelas', $conn); if($status['status']=='off') echo "disabled"; else echo "required"; ?>>
      <option value='<?php echo $img['kelas_sub_id']; ?>'><?php echo $img['nama_kelas']; ?></option>
  </select>
  </div>
</div>

<div class='form-group'>
<label class="col-sm-3 control-label">Kelamin</label>
  <div class="col-sm-9">
  <select class='form-control' name='kelamin' required>
      <option value='<?php echo $img['kelamin']; ?>'><?php echo $img['kelamin']; ?></option>
      <option value='Laki-Laki'>Laki-Laki</option>
      <option value='Perempuan'>Perempuan</option>      
  </select>
  </div>
</div>

<hr>
<div class='form-group'>
<label class="col-sm-3 control-label">Password Lama</label>
  <div class="col-sm-9">
    <input type='password' class='form-control' name='passo' placeholder='Masukkan Password Lama'>
  </div>
</div>

<div class='form-group'>
<label class="col-sm-3 control-label">Password Baru</label>
  <div class="col-sm-9">
    <input type='password' class='form-control' name='passn' placeholder='Masukkan Password Baru'>
  </div>
</div>

<div class='modal-footer'>
  <input type='button' class='btn btn-sm btn-flat btn-default' value='Batal' onclick=self.history.back()>
  <input type=submit class='btn btn-sm btn-flat btn-primary' value='Simpan'>
</div>
</form>
</div>
          <!-- /.box -->
        </div>
      </div>



      </div>
      </section>





<?php } ?>