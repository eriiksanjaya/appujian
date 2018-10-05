    <section class="content-header">
      <h1>
        Dashboard
      </h1>
    </section>

    <section class="content">

      <div class="row">

        <a class="dashboard" href="pages.php?q=mapel">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-list-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Mata Pelajaran</span>
                <span class="info-box-number"><?php echo app_count_mapel($conn); ?></span>
              </div>
            </div>
          </div>
        </a>

        <a class="dashboard" href="pages.php?q=kelas">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-clone"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">KELAS</span>
                <span class="info-box-number"><?php echo app_count_kelas($conn); ?></span>
              </div>
            </div>
          </div>
        </a>

          <div class="clearfix visible-sm-block"></div>

        <a class="dashboard" href="pages.php?q=guru">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Jumlah Guru</span>
                <span class="info-box-number"><?php echo app_count_guru($conn); ?></span>
              </div>
            </div>
          </div>
        </a>

        <a class="dashboard" href="pages.php?q=siswa">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Jumlah Siswa</span>
                <span class="info-box-number"><?php echo app_count_siswa($conn); ?></span>
              </div>
            </div>
          </div>
        </a>

      </div>

    </section>
