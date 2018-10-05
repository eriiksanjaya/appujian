<div class="col-md-2">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">NOMOR SOAL</h3>
			<div class="box-tools pull-right"></div>
		</div>
		<div class="box-body">
			<?php 
				include '../config/koneksi.php';
				include '../config/datetime.php';
				include '../config/url.php';

				session_start();

				$get_data = mysqli_query($conn, "SELECT * FROM ujian_kerjakan WHERE kerjakan_userid = '$_SESSION[siswa_id]'
					AND YEAR(kerjakan_createdate) = '$y' AND MONTH(kerjakan_createdate) = '$m' AND DAY(kerjakan_createdate) = '$d'
					AND kerjakan_status = 'mulai' AND kerjakan_info = 'mengerjakan'
					AND kerjakan_soalaktifid = '$_GET[sai]' AND kerjakan_materisoalid = '$_GET[msi]'");

				$row=mysqli_fetch_assoc($get_data);
				$kerjakan = json_decode($row['kerjakan_data']);

				@$soal = $kerjakan->soal;
				// trace();

				$soal_id = [];
				foreach ((object)$soal as $key => $value) {
					$soal_id[] = $value->soal_id;
				}

				@$jawaban = $kerjakan->jawaban;

				$soal_id_jawaban = [];
				foreach ((array)$jawaban as $key => $value) {
					$soal_id_jawaban[] = $key;
				}

				// terjawab
				$terjawab = array_intersect($soal_id, $soal_id_jawaban);
				$_terjawab = [];
				foreach ($terjawab as $key => $value) {
					$_terjawab[$key] = $value;
				}

				// trace($_terjawab,false);
				// trace($soal_id,false);

			 ?>
			 <input type="hidden" id="nomor_max" value="<?php echo count($soal); ?>">
			<?php foreach ($soal_id as $key => $value) { ?>
				<button class="btn <?php echo ($_terjawab[$key]) ? 'btn-success' : 'btn-danger' ?>" onclick="nomor_soal(<?php echo $key; ?>, <?php echo count($soal); ?>)" style="margin: 3.3px; width: 45px; height: 45px;"><?php echo $key+1; ?></button>
			<?php } ?>
		</div>
	</div>
</div>