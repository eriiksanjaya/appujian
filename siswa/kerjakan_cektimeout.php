<?php
include '../config/koneksi.php';

if (cek_timeout($_SESSION['timeout']) == 0) {
	$res['status'] = 0;
} else {
	timeout($_SESSION['detik']);
	$res['status'] = 1;
}

echo json_encode($res);

?>