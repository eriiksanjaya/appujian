<?php
 if (empty($_SESSION['guru_id'])){
  header("location:../index.php");
}
else{

$aksi="pages/profil/aksi_profil.php";

$data = mysqli_query($conn, "SELECT * FROM tb_guru WHERE guru_id = '$_SESSION[guru_id]'");
$r = mysqli_fetch_assoc($data);

// trace($r);
?>
    <section class="content-header">
      <h1>
        Profil
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
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <div class="box-body">

            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method=POST action='<?php echo $aksi ?>'>
                <div class="form-group">
                  <label for="exampleInputEmail1">NIP</label>
                  <input type="text" name="nip" class="form-control" placeholder="Enter Nip" value="<?php echo $r['nip']; ?>" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Lengkap</label>
                  <input type="text" name="nama" class="form-control" placeholder="Enter Nama" value="<?php echo $r['nama']; ?>" required>
                </div>

                <div class='form-group'>
                  <label>Kelamin</label>
                  <select class='form-control' name='kelamin' required>
                      <option value='<?php echo $r['kelamin']; ?>'><?php echo $r['kelamin']; ?></option>
                      <option value='Laki-Laki'>Laki-Laki</option>
                      <option value='Perempuan'>Perempuan</option>      
                  </select>
                </div>

                <div class='form-group'>
                  <label>Password Lama</label>
                    <input type='password' class='form-control' name='passo' placeholder='Masukkan Password Lama'>
                </div>

                <div class='form-group'>
                  <label>Password Baru</label>
                    <input type='password' class='form-control' name='passn' placeholder='Masukkan Password Baru'>
                </div>
                  <p class="help-block">* Password jika tidak diubah kosongkan saja.</p>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
              <input type='button' class='btn btn-sm btn-flat btn-default' value='Batal' onclick=self.history.back()>
              <input type=submit class='btn btn-sm btn-flat btn-primary' value='Simpan'>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>

<?php } ?>