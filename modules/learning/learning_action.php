<?php 
include'../../config/koneksi.php';
include'../../config/datetime.php';
include'../../config/url.php';
include'../../helper/app.php';

	$tbl 		= "learning";
	$colprefix 	= "learning_";

	$input 		= $_POST;

	if ($input['action'] == 'add') {
		$result['status'] = false;
		$result['message'] = "Gagal menambah data";

		$valid = validation_form($input, ['judul', 'konten']);

		if (count($valid)>0) {
			$result['status'] = false;
			$result['message'] = implode(" ", $valid);
		} else {
			$data[$colprefix.'kelasid'] 	= $input['kelasid'];
			$data[$colprefix.'mapelid'] 	= $input['mapelid'];
			$data[$colprefix.'judul'] 		= $input['judul'];
			$data[$colprefix.'konten'] 		= $input['konten'];
			$data[$colprefix.'userid'] 		= app_session('guru_id');
			$data[$colprefix.'createdate'] 	= $tgl;

			$insert = app_insert($tbl, $data, $conn);

			if ($insert['status']) {
				$result['status'] = true;
				$result['message'] = "Berhasil menambah data";
				$result['redirect'] = $base_url . '/guru/pages.php?q=learning';
			}
		}


		echo json_encode($result);

	} elseif ($input['action'] == 'edit') {
		$result['status'] = false;
		$result['message'] = "Gagal mengedit data";

		$valid = validation_form($input, ['judul', 'konten']);

		if (count($valid)>0) {
			$result['status'] = false;
			$result['message'] = implode(" ", $valid);
		} else {
			$data[$colprefix.'kelasid'] 	= $input['kelasid'];
			$data[$colprefix.'mapelid'] 	= $input['mapelid'];
			$data[$colprefix.'judul'] 		= $input['judul'];
			$data[$colprefix.'konten'] 		= $input['konten'];
			$data[$colprefix.'lastupdate'] 	= $tgl;

			$where = $colprefix.'id' ."=" . $input['id'];
			$update = app_update($tbl, $data, $where, $conn);

			if ($update['status']) {
				$result['status'] = true;
				$result['message'] = "Berhasil mengedit data";
				$result['redirect'] = $base_url . '/guru/pages.php?q=learning';
			}
		}

		echo json_encode($result);

	} elseif ($input['action'] == 'delete') {
		$result['status'] = false;
		$result['message'] = "Gagal menghapus data";

		$valid = validation_form($input, ['id']);

		if (count($valid)>0) {
			$result['status'] = false;
			$result['message'] = implode(" ", $valid);
		} else {

			/*$where = $colprefix.'id' ."=" . $input['id'];
			$update = app_delete($tbl, $where, $conn);*/

			$data[$colprefix.'isdelete'] 	= "1";

			$where = $colprefix.'id' ."=" . $input['id'];
			$update = app_update($tbl, $data, $where, $conn);

			if ($update['status']) {
				$result['status'] = true;
				$result['message'] = "Berhasil menghapus data";
				$result['redirect'] = $base_url . '/guru/pages.php?q=learning';
			}
		}

		echo json_encode($result);
	}
?>