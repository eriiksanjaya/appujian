<?php 
include'../../config/koneksi.php';
include'../../config/datetime.php';
include'../../config/url.php';

	if ($_POST['action'] == 'edit') {
		$result['status'] = false;
		$result['message'] = "Gagal mengakhiri tugas";
		
	    $kolom = "kerjakan_status = 'selesai', kerjakan_lastupdate = '$tgl', kerjakan_info = 'history'";
	    $where = "kerjakan_id = $_POST[id]";

	    $update = edit('ujian_kerjakan',$kolom,$where, $conn);

	    $get_data = mysqli_query($conn, "SELECT * FROM ujian_kerjakan WHERE kerjakan_id = '$_POST[id]'");
	    $row=mysqli_fetch_assoc($get_data);

	    $kerjakan = json_decode($row['kerjakan_data']);

	    if (count($kerjakan->jawaban) > 0 AND $update['status']) {
	        $opt = [];
	        foreach ($kerjakan->jawaban as $key => $value) { 
	            $opt['pilihan'][$key] = $key.$value;
	        }

	        // ambil kunci jawaban
	        $kunci_soal = mysqli_query($conn, "SELECT * FROM vw_soal where aktif ='aktif' AND blokir ='n' AND materi_soal_id = '$_POST[msi]' AND siswa_id = '$row[kerjakan_userid]'");
	        // $pilihan = $r['jawaban'];
	        $jml_soal = mysqli_num_rows($kunci_soal);

	        while($r = mysqli_fetch_assoc($kunci_soal)){
	            $data[] = $r;
	        }

	        $erik = [];
	        foreach ($data as $key => $value) {
	            $erik['kunci'][$value['soal_id']] = $value['soal_id'].$value['jawaban'];
	        }

	        // trace($opt);
	        $benar = count(array_intersect($opt['pilihan'], $erik['kunci']));
	        $salah = $jml_soal - $benar;

	        $persen_benar = round(($benar/$jml_soal)*100);
	        $persen_salah = round(($salah/$jml_soal)*100);

	        $tglmulai = $_POST['tglmulai'];
	        $d = app_date_value($tglmulai, "d");
	        $m = app_date_value($tglmulai, "m");
	        $y = app_date_value($tglmulai, "Y");

	        // cek nilai udah ada / belum
	        $cek_nilai = mysqli_query($conn, "SELECT * FROM tb_nilai_siswa WHERE siswa_id = '$row[kerjakan_userid]'
	            AND materi_soal_id = '$_POST[msi]' AND YEAR(tgl) = '$y' AND MONTH(tgl) = '$m' AND DAY(tgl) = '$d'");
	        

	        if (mysqli_num_rows($cek_nilai) == 0) {
	        // save nilai
	            $kolom = "(siswa_id,materi_soal_id,benar,salah,nilai,tgl,jam)";
	            $nilai = "('$row[kerjakan_userid]','$_POST[msi]','$benar','$salah','$persen_benar','$tgl','$jam')";
	            $save = simpan('tb_nilai_siswa',$kolom,$nilai, $conn);
	            $save = simpan('tb_nilai_guru',$kolom,$nilai, $conn);

	            if ($save['status']) {
					$result['status'] = true;
					$result['message'] = "Berhasil mengakhiri tugas";
	            }
	        } else {
	        	if (strtotime(app_date_value($tglmulai, "Y-m-d")) == strtotime(date("Y-m-d"))) {
	        		$_tgl = app_date_value($tglmulai, "Y-m-d");
		            $kolom = "benar = $benar, salah = $salah, nilai = $persen_benar";
		            $_where = "siswa_id = '{$row['kerjakan_userid']}' AND materi_soal_id = '{$_POST['msi']}' AND tgl = '{$_tgl}'";
		            $save = edit('tb_nilai_siswa',$kolom,$_where, $conn);
		            $save = edit('tb_nilai_guru',$kolom,$_where, $conn);
	        	}
	        	$result['status'] = true;
				$result['message'] = "Berhasil mengakhiri tugas";
	        }
        } else {
	        $tglmulai = $_POST['tglmulai'];
	        $d = app_date_value($tglmulai, "d");
	        $m = app_date_value($tglmulai, "m");
	        $y = app_date_value($tglmulai, "Y");

	        $opt = [];
	        foreach ( (array)$kerjakan->jawaban as $key => $value) { 
	            $opt['pilihan'][$key] = $key.$value;
	        }

	        // ambil kunci jawaban
	        $kunci_soal = mysqli_query($conn, "SELECT * FROM vw_soal where aktif ='aktif' AND blokir ='n' AND materi_soal_id = '$_POST[msi]' AND siswa_id = '$row[kerjakan_userid]'");
	        // $pilihan = $r['jawaban'];
	        $jml_soal = mysqli_num_rows($kunci_soal);

	        while($r = mysqli_fetch_assoc($kunci_soal)){
	            $data[] = $r;
	        }

	        $erik = [];
	        foreach ($data as $key => $value) {
	            $erik['kunci'][$value['soal_id']] = $value['soal_id'].$value['jawaban'];
	        }

	        // trace($opt);
	        $benar = count(array_intersect($opt['pilihan'], $erik['kunci']));
	        $salah = $jml_soal - $benar;

	        $persen_benar = round(($benar/$jml_soal)*100);
	        if ($jml_soal == 0) {
	        	$persen_benar = 0;
	        }
	        $persen_salah = round(($salah/$jml_soal)*100);

	        // cek nilai udah ada / belum
	        $cek_nilai = mysqli_query($conn, "SELECT * FROM tb_nilai_siswa WHERE siswa_id = '$row[kerjakan_userid]'
	            AND materi_soal_id = '$_POST[msi]' AND YEAR(tgl) = '$y' AND MONTH(tgl) = '$m' AND DAY(tgl) = '$d'");
	        if (mysqli_num_rows($cek_nilai) == 0) {
	        // save nilai
	            $kolom = "(siswa_id,materi_soal_id,benar,salah,nilai,tgl,jam)";
	            $nilai = "('$row[kerjakan_userid]','$_POST[msi]','$benar','$salah','$persen_benar','$tgl','$jam')";
	            $save = simpan('tb_nilai_siswa',$kolom,$nilai, $conn);
	            $save = simpan('tb_nilai_guru',$kolom,$nilai, $conn);

	            if ($save['status']) {
					$result['status'] = true;
					$result['message'] = "Berhasil mengakhiri tugas";
	            }
	        } else {
	        	$result['status'] = true;
				$result['message'] = "Berhasil mengakhiri tugas";
	        }

        }

		echo json_encode($result);
	}
	elseif ($_POST['action'] == 'delete') {
		$result['status'] = false;
		$result['message'] = "Gagal memulai ulang";

		$delete = mysqli_query($conn, "DELETE FROM ujian_kerjakan where kerjakan_id = '{$_POST['id']}'");
		if ($delete) {
			$result['status'] = true;
			$result['message'] = "Berhasil memulai ulang";
		}

		echo json_encode($result);
	}
?>