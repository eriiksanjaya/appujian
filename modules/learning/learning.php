<section class="content-header">
	<h1>
		Learning
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
            <p id="notif" style="font-size: 18px!important;"></p>

			<?php if(@$_GET['action'] == '') : ?>
			<div class="box box-primary">
			    <div class="box-header">
				    <div class="row">
				    	<?php if (app_session()['level'] != 'siswa') { ?>
							<div class="col-md-6 caption">
	            				<input type='button' class='btn btn-danger btn-flat btn-sm' value='Tambah' onclick="window.location.href='?q=learning&action=add'">
							</div>
				    	<?php } ?>
				    </div>
			    </div>
			    <div class="box-body">
			    <p class="notif"></p>
			    <div class="table-responsive">
					<table id="example" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th width="40px">No</th>
								<th width="140px" align="center">Tanggal</th>
								<th width="140px">Guru</th>
								<th>Kelas</th>
								<th>Mapel</th>
								<th>Judul</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$no = 1;

								$where = "learning_isdelete = '0'";

								if (app_session()['level'] == 'siswa') {
									$kelas_id = app_session('kelas_id');
									$where .= " AND learning_kelasid = '{$kelas_id}'";
								} elseif (app_session()['level'] == 'guru') {
									$user_id = app_session('guru_id');
									$where .= " AND learning_userid = '{$user_id}'";
								} else {

								}

								$getdata = app_getdata($conn, 'vw_learning', '*', $where);

								foreach (@$getdata['data'] as $key => $row) {
							?>
									<tr class="<?php echo $row['kerjakan_id']; ?>">
										<td align="center"><?php echo $no++; ?></td>
										<td align="center"><?php echo app_date_value($row['learning_createdate'], "d M Y"); ?></td>
										<td><?php echo $row['guru_nama']; ?></td>
										<td><?php echo $row['kelas_nama']; ?></td>
										<td><?php echo $row['mapel_nama']; ?></td>
										<td><?php echo $row['learning_judul']; ?></td>
										<td align="center">
											<?php if (app_session()['level'] == 'siswa') : ?>
												<a href="pages.php?q=learning&action=lihat&id=<?php echo $row['learning_id']; ?>">
													<button class="btn btn-sm btn-primary">buka</button>
												</a>
											<?php else: ?>
												<a href="pages.php?q=learning&action=edit&id=<?php echo $row['learning_id']; ?>">
													<button class="btn btn-sm btn-primary">Edit</button>
												</a>
												<button class="btn btn-sm btn-danger delete" data-id="<?php echo $row['learning_id']; ?>" data-action="delete">Hapus</button>
											<?php endif; ?>
										</td>
									</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
			<?php elseif(@$_GET['action'] == 'add' OR @$_GET['action'] == 'edit') : ?>
				<?php include'learning_form.php'; ?>
			<?php elseif(@$_GET['action'] == 'lihat') : ?>
				<?php include'learning_lihat.php'; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(function() {

    	var notif = $('#notif');
		var btnDelete 	= $('.delete');

		notif.click(function(event) {
			$(this).slideUp('slow');
		});

		function removeClass() {
			notif.removeClass();
	    }

		$('.btn').click(function(event) {
			var id 			= $(this).attr('data-id');
			var action 		= $(this).attr('data-action');

			removeClass();
			
			$.ajax({
				url: "<?php echo $base_url; ?>/modules/learning/learning_action.php",
				type: 'POST',
				dataType: 'json',
				data: {action: action, id: id},
			})
			.done(function(res) {
				notif.slideDown('slow');
				if (res.status) {
					notif.addClass('alert alert-success');
					notif.html(res.message);
					setInterval(function(){window.location = res.redirect}, 2000);
				} else {
					notif.addClass('alert alert-warning');
					notif.html(res.message);
				}
			})
			.fail(function() {
				notif.slideDown('slow');
				notif.addClass('alert alert-danger');
				notif.html(res.message);
			})
			.always(function() {
			});
			
		});
	});


</script>