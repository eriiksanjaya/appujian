<?php
if (empty($_SESSION['guru_id'])){
  header("location:../../index.php");
}else{

$tampil = mysqli_query($conn, "SELECT
tb_nilai_guru.nilai_id,
tb_nilai_guru.siswa_id,
tb_nilai_guru.materi_soal_id,
tb_nilai_guru.benar,
tb_nilai_guru.salah,
tb_nilai_guru.nilai,
tb_nilai_guru.tgl,
tb_nilai_guru.jam,
tb_siswa.nis,
tb_siswa.nama,
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.nama_kelas,
tb_materi_soal.guru_id,
tb_materi_soal.materi
FROM
tb_nilai_guru
INNER JOIN tb_siswa ON tb_nilai_guru.siswa_id = tb_siswa.siswa_id
INNER JOIN tb_kelas_sub ON tb_siswa.kelas_sub_id = tb_kelas_sub.kelas_sub_id
INNER JOIN tb_materi_soal ON tb_nilai_guru.materi_soal_id = tb_materi_soal.materi_soal_id

WHERE tb_materi_soal.guru_id='$_SESSION[guru_id]'
AND tb_nilai_guru.materi_soal_id = '$_GET[msi]' AND tb_kelas_sub.kelas_sub_id = '$_GET[ksi]'
AND tb_nilai_guru.tgl = '$_GET[tgl]'
ORDER BY tb_nilai_guru.nilai_id DESC");

$he = mysqli_query($conn, "SELECT
tb_siswa.nis,
tb_siswa.nama,
tb_kelas_sub.kelas_sub_id,
tb_kelas_sub.nama_kelas,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_siswa.siswa_id,
tb_pilih_mapel.pilih_mapel_id,
tb_mapel.mapel_id,
tb_mapel.mata_pelajaran,
tb_nilai_guru.materi_soal_id,
tb_nilai_guru.tgl,
tb_nilai_guru.jam,
tb_guru.nip,
tb_guru.nama
FROM
tb_nilai_guru
INNER JOIN tb_siswa ON tb_nilai_guru.siswa_id = tb_siswa.siswa_id
INNER JOIN tb_kelas_sub ON tb_siswa.kelas_sub_id = tb_kelas_sub.kelas_sub_id
INNER JOIN tb_materi_soal ON tb_nilai_guru.materi_soal_id = tb_materi_soal.materi_soal_id
INNER JOIN tb_pilih_mapel ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
INNER JOIN tb_guru ON tb_materi_soal.guru_id = tb_guru.guru_id
WHERE tb_materi_soal.guru_id='$_SESSION[guru_id]'
AND tb_nilai_guru.tgl = '$_GET[tgl]' AND tb_nilai_guru.materi_soal_id = '$_GET[msi]' AND tb_kelas_sub.kelas_sub_id = '$_GET[ksi]'");
$h=mysqli_fetch_assoc($he);
$tgl = app_date_value($h['tgl'], "d M Y");


  echo "<legend><h2>Nilai Siswa</h2></legend>

  <table>
  <tr><td colspan=7>Pengajar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $h[nama]</td></tr>
  <tr><td colspan=7>Kelas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $h[nama_kelas]</td></tr>
  <tr><td colspan=7>Mata Pelajaran : $h[mata_pelajaran]</td></tr>
  <tr><td colspan=7>Materi Soal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $h[materi]</td></tr>
  <tr><td colspan=7>Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $tgl</td></tr>
  </table><br>

    <div class='table-responsive'>
    <table border=1 class='table table-bordered table-hover'>
    <thead>
          <tr>
          <th>No</th>
          <th>Nis</th>
          <th>Nama</th>
          <th>Benar</th>
          <th>Salah</th>
          <th>Nilai</th>
          <th>Jam</th>
          </tr></thead>";
    $no = 1;
    while ($r=mysqli_fetch_assoc($tampil)){
       echo "<tbody>
          <tr>
          <td><center>$no</center></td>
             <td><center>$r[nis]</center></td>
             <td><center>$r[nama]</center></td>
             <td><center>$r[benar]</center></td>
             <td><center>$r[salah]</center></td>
             <td><center>$r[nilai]</center></td>
             <td><center>$r[jam]</center></td>
             </td></tr>
       </tbody>";
      $no++;
    }
    echo "</table></div>";
}
?>