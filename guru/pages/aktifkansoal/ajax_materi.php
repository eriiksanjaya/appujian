<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo"ayooo, mau ngapain??? :p";
    }
    else{

include '../../../config/koneksi.php';
$a = $_POST['a'];
$sql = mysqli_query($conn, "SELECT
tb_pilih_mapel.pilih_mapel_id,
tb_pilih_mapel.guru_id,
tb_pilih_mapel.mapel_id,
tb_pilih_mapel.pilih,
tb_mapel.mata_pelajaran,
tb_mapel.blokir,
tb_materi_soal.materi_soal_id,
tb_materi_soal.guru_id,
tb_materi_soal.materi,
tb_materi_soal.blokir
FROM
tb_pilih_mapel
INNER JOIN tb_mapel ON tb_pilih_mapel.mapel_id = tb_mapel.mapel_id
INNER JOIN tb_materi_soal ON tb_materi_soal.pilih_mapel_id = tb_pilih_mapel.pilih_mapel_id
where tb_pilih_mapel.pilih_mapel_id = '$a'") or die (mysql_error());
echo "<option value=''>Pilih Materi Soal</option>";
while($r = mysqli_fetch_assoc($sql)){
    echo "<option value='$r[materi_soal_id]'>$r[materi]</option> \n";
}
}
?>