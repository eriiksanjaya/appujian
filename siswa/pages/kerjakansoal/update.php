<?php 
include "../../../config/koneksi.php";
include "../../../config/datetime.php";
include '../../../config/url.php';

session_start();

$get_data 		= mysqli_query($conn, "SELECT * FROM ujian_kerjakan WHERE kerjakan_userid = '$_SESSION[siswa_id]'
	AND YEAR(kerjakan_createdate) = '$y' AND MONTH(kerjakan_createdate) = '$m' AND DAY(kerjakan_createdate) = '$d'
	AND kerjakan_status = 'mulai' AND kerjakan_soalaktifid = '$_POST[sai]' AND kerjakan_materisoalid = '$_POST[msi]'");
$row			= mysqli_fetch_assoc($get_data);

$field_value 	= json_decode($row['kerjakan_data'], 1);

$field_value['jawaban'][$_POST['soal_id']] = $_POST['soal_pilihan_id'];

$array = json_encode($field_value, JSON_UNESCAPED_UNICODE);

$kolom = "kerjakan_data = '$array', kerjakan_lastupdate = '$tgl'";
$where = "kerjakan_id = '$row[kerjakan_id]'";

$update = edit('ujian_kerjakan',$kolom,$where, $conn);

trace($update);
?>