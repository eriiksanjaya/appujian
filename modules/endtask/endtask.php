<section class="content-header">
	<h1>
		Endtask
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">

			<?php if(@$_GET['action'] == '') : ?>
			<div class="box box-primary">
			    <div class="box-header">
				    <div class="row">
						<div class="col-md-6 caption">End Task</div>
				    </div>
			    </div>
			    <div class="box-body">
			    <p class="notif"></p>
			    <div class="table-responsive">
					<table id="example" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th width="40px">No</th>
								<th width="140px">Mulai</th>
								<th width="140px">Selesai</th>
								<th>Nis</th>
								<th>Nama</th>
								<th>Kelas</th>
								<th>Tugas</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$no = 1;
								$where = "";
								$join = "";
								/*$karyawan_id = mysession('karyawan_id');
								if(mysession('karyawan_level') == '3') :
									$where = "WHERE karyawan_id = '{$karyawan_id}'";
								endif;*/

								$join = "
									LEFT JOIN tb_siswa s ON uk.kerjakan_userid = s.siswa_id
									LEFT JOIN tb_kelas_sub ks ON s.kelas_sub_id = ks.kelas_sub_id
									LEFT JOIN tb_materi_soal ms ON uk.kerjakan_materisoalid = ms.materi_soal_id
								";

								$where = "";


								$sql = "SELECT uk.*, s.nis, s.nama, ks.nama_kelas, ms.materi FROM ujian_kerjakan uk {$where} {$join}";
								$getdata = mysqli_query($conn, $sql) or trace($conn->error,false);
								// foreach ($data as $key => $row) {
								// while($row=mysqli_fetch_assoc($getdata)) {
								// trace($sql);
            					while ($row=mysqli_fetch_assoc($getdata)){
							?>
									<tr class="<?php echo $row['kerjakan_id']; ?>">
										<td align="center"><?php echo $no++; ?></td>
										<td><?php echo app_date_value($row['kerjakan_createdate'], "d M Y h:i:s"); ?></td>
										<td><?php echo app_date_value($row['kerjakan_lastupdate'], "d M Y h:i:s"); ?></td>
										<td><?php echo $row['nis']; ?></td>
										<td><?php echo $row['nama']; ?></td>
										<td><?php echo $row['nama_kelas']; ?></td>
										<td><?php echo $row['materi']; ?></td>
										<td><p class="<?php echo $row['kerjakan_id']; ?>"><?php echo $row['kerjakan_status']; ?></p></td>
										<td align="center">
											
											<?php if ($row['kerjakan_status'] != "selesai") { ?>
												<button class="btn btn-sm btn-flat btn-danger" id="action_endtask" data-action="edit"
												data-value="<?php echo $row['kerjakan_id']; ?>"
												data-tglmulai="<?php echo $row['kerjakan_createdate']; ?>"
												data-msi="<?php echo $row['kerjakan_materisoalid']; ?>"
												data-sai="<?php echo $row['kerjakan_soalaktifid']; ?>"
												>Endtask</button>
											<?php } ?>

											<?php if (app_date_value($row['kerjakan_mulai'], "Y-m-d") != date("Y-m-d")) { ?>

												<button class="btn btn-sm btn-flat btn-warning" id="action_endtask" data-action="delete"
												data-value="<?php echo $row['kerjakan_id']; ?>"
												data-tglmulai="<?php echo $row['kerjakan_createdate']; ?>"
												data-msi="<?php echo $row['kerjakan_materisoalid']; ?>"
												data-sai="<?php echo $row['kerjakan_soalaktifid']; ?>"
												>Mulai Ulang</button>
											<?php } ?>

										</td>
									</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
			<?php elseif(@$_GET['action'] == 'add' OR @$_GET['action'] == 'edit') : ?>
				<?php include'endtask_form.php'; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		var endtask = $("button");
		endtask.click(function(event) {
			var id = $(this).attr('data-value');
			var action = $(this).attr('data-action');
			var tglmulai = $(this).attr('data-tglmulai');
			var msi = $(this).attr('data-msi');
			var sai = $(this).attr('data-sai');
			var status = $('p.'+id);

			var object = $(this);
			
			$.ajax({
				url: '../modules/endtask/endtask_action.php',
				type: 'POST',
				dataType: 'json',
				data: {action: action, id: id, msi:msi, sai:sai, tglmulai:tglmulai},
			})
			.done(function(res) {
				// $('.notif').text(res.message);
				if (res.status) {
					status.html('<p style="color:green">Selesai</p>');
					object.hide();
					if (action == "delete") {
						$('tr.'+id).remove();
					}
				}
			})
			.fail(function(res) {
				console.log(res);
			})
			.always(function() {
			});
		});
			

			
		
	});
</script>