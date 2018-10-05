<?php
$info = mysqli_query($conn, "SELECT
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
tb_materi_soal.pilih_mapel_id,
tb_materi_soal.materi,
tb_materi_soal.blokir,
tb_pilih_mapel.mapel_id,
tb_mapel.mata_pelajaran,
tb_guru.nip,
tb_guru.nama AS nama_guru,
tb_siswa.siswa_id,
tb_siswa.nis,
tb_siswa.nama,
tb_soal.soal_id,
count(tb_soal.soal_id) as jml_soal,
tb_kelas_sub.nama_kelas
FROM
tb_soal_aktif
INNER JOIN tb_materi_soal ON tb_soal_aktif.materi_soal_id = tb_materi_soal.materi_soal_id
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
INNER JOIN tb_guru ON tb_materi_soal.guru_id = tb_guru.guru_id
INNER JOIN tb_siswa ON tb_siswa.kelas_sub_id = tb_soal_aktif.kelas_sub_id
INNER JOIN tb_soal ON tb_soal.materi_soal_id = tb_soal_aktif.materi_soal_id
INNER JOIN tb_kelas_sub ON tb_kelas_sub.kelas_sub_id = tb_soal_aktif.kelas_sub_id

WHERE tb_soal_aktif.aktif ='aktif' AND tb_soal.blokir = 'n' AND tb_soal_aktif.materi_soal_id = $_GET[msi] AND tb_siswa.siswa_id = '$_SESSION[siswa_id]'");
$r = mysqli_fetch_assoc($info);
$jml_soal = $r['jml_soal'];
$tgl_i = tgl_indo($r['tgl']);
?>

<div class="col-md-3">
   <div class="box box-solid">
    <div class="box-body no-padding">
      <ul class="nav nav-pills nav-stacked">
        <li><h3 class="text-center text-light-blue"><div id="clock"></div></h3></li>
      </ul>
    </div>
  </div>

  <div class="box box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">INFORMASI</h3>

      <div class="box-tools">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <ul class="nav nav-pills nav-stacked">
        <li class="nav-info-ep"><a href="#"><i class="fa fa-user"></i> Pengajar
          <span class="label btn-twitter pull-right"><?php echo $r['nama_guru'] ?></span></a></li>
        
        <li class="nav-info-ep"><a href="#"><i class="fa fa-list-alt"></i> Kelas
          <span class="label btn-twitter pull-right"><?php echo $r['nama_kelas'] ?></span></a></li>
        
        <li class="nav-info-ep"><a href="#"><i class="fa fa-building-o"></i> Mata Pelajaran
          <span class="label btn-twitter pull-right"><?php echo $r['mata_pelajaran'] ?></span></a></li>
        
        <li class="nav-info-ep"><a href="#"><i class="fa fa-clone"></i> Materi
          <span class="label label-primary pull-right"><?php echo $r['materi'] ?></span></a></li>
        
        <li class="nav-info-ep"><a href="#"><i class="fa fa-calendar"></i> Tanggal
          <span class="label label-primary pull-right"><?php echo $tgl_i ?></span></a></li>
        
        <li class="nav-info-ep"><a href="#"><i class="fa fa-clock-o"></i> Menit
          <span class="label label-primary pull-right"><?php echo $r['menit'] ?></span></a></li>

        <li class="nav-info-ep"><a href="#"><i class="fa fa-clock-o"></i> Mulai
          <span class="label label-success pull-right"><?php echo $r['jam'] ?></span></a></li>
        
        <li class="nav-info-ep"><a href="#"><i class="fa fa-clock-o"></i> Selesai
          <span class="label label-danger pull-right"><?php echo $r['selesai'] ?></span></a></li>
        
        <li><a href="#"><i class="fa fa-file-text-o"></i> Jumlah Soal <span class="label label-warning pull-right"><?php echo $jml_soal ?></span></a>
        </li>
      </ul>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /. box -->
 
</div>