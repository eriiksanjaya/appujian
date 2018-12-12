    <section class="content-header">
      <h1>
        Dashboard
        <small></small>
      </h1>
    </section>

    <section class="content">

      <div class="row">

        <a class="dashboard" href="pages.php?q=pilih-soal">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-list-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">TUGAS</span>
                <span class="info-box-number"><?php echo app_count_tugas_aktif($_SESSION['siswa_id'], $conn); ?></span>
              </div>
            </div>
          </div>
        </a>

        <a class="dashboard" href="pages.php?q=lihat-nilai">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-clone"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">NILAI</span>
                <span class="info-box-number"><?php echo app_count_nilai($_SESSION['siswa_id'], $conn); ?></span>
              </div>
            </div>
          </div>
        </a>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Jumlah Guru</span>
              <span class="info-box-number"><?php echo app_count_guru($conn); ?></span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Jumlah Siswa</span>
              <span class="info-box-number"><?php echo app_count_siswa($conn); ?></span>
            </div>
          </div>
        </div>

      </div>

    </section>
