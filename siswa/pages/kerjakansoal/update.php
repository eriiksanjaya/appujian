<?php 
	// header("Access-Control-Allow-Origin: *");
	header('content-type: application/json; charset=utf-8');

	include "../../../config/koneksi.php";
	include "../../../config/datetime.php";
	include '../../../config/url.php';

	session_start();

	$result['status'] = true;
	$result['message'] = "Gagal simpan jawaban";

	$get_data 		= mysqli_query($conn, "SELECT * FROM ujian_kerjakan WHERE kerjakan_userid = '$_SESSION[siswa_id]'
		AND YEAR(kerjakan_createdate) = '$y' AND MONTH(kerjakan_createdate) = '$m' AND DAY(kerjakan_createdate) = '$d'
		AND kerjakan_status = 'mulai' AND kerjakan_soalaktifid = '$_POST[sai]' AND kerjakan_materisoalid = '$_POST[msi]'");
	$row			= mysqli_fetch_assoc($get_data);

	$field_value 	= json_decode($row['kerjakan_data'], 1);

	$field_value['jawaban'][$_POST['soal_id']] = $_POST['soal_pilihan_id'];

	$array = json_encode($field_value, JSON_UNESCAPED_UNICODE);

	$kolom = "kerjakan_data = '$array', kerjakan_lastupdate = '$tgl'";
	$where = "kerjakan_id = '$row[kerjakan_id]'";

	$update = edit('ujian_kerjakan', $kolom, $where, $conn);

	if($update['status']) {
		$result['status'] = true;
		$result['message'] = "Berhasil simpan jawaban";
	}
	
	echo json_encode($result);
?>