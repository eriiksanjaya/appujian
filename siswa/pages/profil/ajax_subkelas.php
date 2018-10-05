<?php
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo"ayooo, mau ngapain??? :p";
    }
    else{

include '../../../config/koneksi.php';
$a = $_POST['a'];
$sql = mysqli_query($conn, "SELECT * FROM tb_kelas_sub WHERE kelas_id = '$a'") or die (mysql_error());
echo "<option value=''>Pilih Sub Kelas</option>";
while($r = mysqli_fetch_assoc($sql)){
    echo "<option value='$r[kelas_sub_id]'>$r[nama_kelas]</option> \n";
}
}
?>