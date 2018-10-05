<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Aplikasi Ujian</a></li>
            <li><a href="#tab_4" data-toggle="tab">Pembayaran</a></li>
            <li><a href="#tab_3" data-toggle="tab"><strong>Daftarkan Sekolah Saya</strong></a></li>
            <li><a href="#tab_6" data-toggle="tab">Info Lebih Lanjut</a></li>
            <li><a href="#tab_5" data-toggle="tab">Panduan</a></li>
            <li><a href="#tab_2" data-toggle="tab">Ingin Mencoba ?</a></li>
            <!-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> -->
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <b>
              Aplikasi ujian online </b> ini dapat digunakan dan disesuaikan untuk kebutuhan lembaga atau institusi dalam melakukan ujian atau seleksi. Dengan aplikasi ujian online ini, seleksi dapat berjalan dengan lebih cepat, efektif, efisien dan dengan hasil yang akurat. 
              <br>
              <br>
              Aplikasi ujian online berbasis web ini tidak hanya digunakan untuk ujian sekolah, tetapi bisa juga untuk memberikan tugas kepada siswa diluar jam sekolah (Pekerjaan Rumah). Pengerjaan soal bisa menggunakan PC, Laptop, Tablet dan Smartphone.
              <br>
              <br>
              Beberapa kelebihan aplikasi ujian online yang kami kembangkan : 
              <br>
              1. waktu pengerjaan soal terus berjalan mundur, ketikan halaman direfresh bahkan logout/keluar sekalipun, selama masih punya sisa waktu pengerjaan soal, siswa masih bisa login dan melanjutkan pengerjaan.<br>
              2. jawaban siswa langsung tersimpan ke database, sehingga tidak perlu takut jawaban akan hilang.<br>
              3. soal ujian ditampilkan secara random kepada masing-masing siswa yang mengikuti ujian dalam waktu yang bersamaan.<br>
              4. ketika waktu ujian habis, siswa tidak dapat lagi menjawab pertanyaan yang ada, maka nilai akan langsung keluar.
              <br>
              <br>
              KEUNGGULAN :
              <br>
              1. Lebih memudahkan siswa dalam mengerjakan soal.<br>
              2. Dapat menghemat penggunaan kertas.<br>
              3. Pelaksanaannya lebih cepat dari pada mengerjakan lembar jawaban secara manual.<br>
              4. Guru tanpa repot-repot mengoreksi jawaban siswa.<br>
              5. Hasil ujian dapat langsung diketahui oleh Guru dan Siswa setelah ujian selesai.<br>
              6. nilai siswa satu kelas bisa langsung dicetak dalam bentuk file excel oleh guru.<br>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
              <?php include'demo.php'; ?>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
              <?php include'form.php' ?>
            </div>
            <div class="tab-pane" id="tab_4">
              <?php include'pembayaran.php' ?>
            </div>
            <div class="tab-pane" id="tab_6">
              <?php include'info.php' ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>