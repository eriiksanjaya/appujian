<?php 
include'../../config/koneksi.php';
include'../../config/datetime.php';
include'../../config/url.php';
include'../../helper/app.php';

    header("Content-Type: application/json; charset=UTF-8");
	
	$input = $_GET;

	if ($input['tipe'] == 'pilih-kelas') {

		$user_id = app_session('guru_id');
		$where = "pk.guru_id = '{$user_id}'";

		if (isset($input['q'])) {
			$where .= " AND k.kelas like '%{$input['q']}%'";
		}

		$join = "
			LEFT JOIN tb_kelas_sub ks on pk.kelas_sub_id = ks.kelas_sub_id
			LEFT JOIN tb_kelas k on ks.kelas_id = k.kelas_id
		";

		$group = "ks.kelas_id";

		$getdata = app_getdata($conn, 'tb_pilih_kelas pk', 'ks.kelas_id, k.kelas', $where, $join, $group);

		foreach ($getdata['data'] as $key => $value) {
			$data[$key]['id'] = $value['kelas_id'];
			$data[$key]['text'] = $value['kelas'];
		}

		echo json_encode($data);

	} elseif ($input['tipe'] == 'pilih-mapel') {

		$user_id = app_session('guru_id');
		$where = "pm.guru_id = '{$user_id}'";

		if (isset($input['q'])) {
			$where .= " AND m.mata_pelajaran like '%{$input['q']}%'";
		}

		$join = "
			LEFT JOIN tb_mapel m on pm.mapel_id = m.mapel_id
		";

		$getdata = app_getdata($conn, 'tb_pilih_mapel pm', 'pm.mapel_id, m.mata_pelajaran', $where, $join);

		foreach ($getdata['data'] as $key => $value) {
			$data[$key]['id'] = $value['mapel_id'];
			$data[$key]['text'] = $value['mata_pelajaran'];
		}

		echo json_encode($data);

	}

?>