<section class="content-header">
      <h1>
        Daftar Tugas
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
        

<?php
if(empty($_SESSION['siswa_id'])){
  header("location:$base_url/siswa");
}else{
switch(isset($_GET['act'])){
  default:
    if ($_SESSION['siswa_id']){

	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
    // trace($_SESSION);

    $tampil = mysqli_query($conn, "SELECT * FROM vw_tugas_aktif
      WHERE aktif = 'aktif' AND kelas_sub_id = '$_SESSION[kelas_sub_id]' ORDER BY tgl ASC");

    if(mysqli_num_rows($tampil)<1){
      echo "
      <div class='callout callout-info'>
        <p>Belum ada soal yang diaktifkan oleh Pengajar</p>
      </div>";
    }else{

    echo "
  <div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'></h3>
            </div>
            <div class='box-body'>

<div class='table-responsive'>
  <table id='example' class='table table-striped table-bordered' cellspacing='0' width='100%'>
      <thead>
		    <tr>
          <th>No</th>
          <th>Pengajar</th>
          <th>Mata Pelajaran</th>
          <th>Materi Soal</th>
          <th>Waktu</th>
          <th>Tanggal</th>
          <th>Jam</th>
          <th>Aksi</th>
        </tr></thead><tbody>";
    $no=$posisi+1;
    
    while ($r=mysqli_fetch_assoc($tampil)){
      $tgl = tgl_indo($r['tgl']);

		
       echo "<tr>
	   		<td>$no</td>
            <td>$r[nama_guru]</td>
            <td>$r[mata_pelajaran]</td>
            <td>$r[materi]</td>
            <td>$r[menit] Menit</td>
            <td>$tgl</td>
            <td>$r[jam]</td>
            <td class=text-center>";
            echo"<a href=mulai.php?q=kerjakan-soal&msi=$r[materi_soal_id]&sai=$r[soal_aktif_id] onClick=\"return confirm('Kerjakan Tugas Sekarang ?')\"><button type='button' class='btn btn-primary btn-xs'>kerjakan soal</button></a>";
            /*if($r['kerjakan_id'] == '' OR $r['kerjakan_status'] == 'selesai' AND  strtotime(date($r['kerjakan_mulai'])) < strtotime(date('Y-m-d')) )
            {
            }
            elseif ($r['kerjakan_status'] == 'mulai')
            {
              echo"<a href=mulai.php?q=kerjakan-soal&msi=$r[materi_soal_id]&sai=$r[soal_aktif_id]><button type='button' class='btn btn-warning btn-xs'>sedang dikerjakan</button></a>";
            }
            elseif ($r['kerjakan_status'] == 'selesai' AND strtotime(date($r['kerjakan_mulai'])) >= strtotime(date("Y-m-d")) )
            {
              echo"<a href='#'><button type='button' class='btn btn-success btn-xs'>telah dikerjakan</button></a>";
            }*/

             echo"</td></tr></tbody>";
      $no++;
    }
    echo "</table></tbody></div></div</div></div>";


}
}
}
}   
?>

</div>
</section>
