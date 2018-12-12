<section class="content-header">
	<h1>
		Berita
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
				    	<?php if (app_session()['level'] != 'siswa') : ?>
						<div class="col-md-6 caption">
            <input type='button' class='btn btn-danger btn-flat btn-sm' value='Tambah' onclick="window.location.href='?q=berita&action=add'">
						</div>
						<?php endif; ?>
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
								<th>Judul</th>
								<th>Create By</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$no = 1;

								$where = "berita_isdelete = '0'";

								$join = "LEFT JOIN tb_guru g on b.berita_createby = g.guru_id";
								$getdata = app_getdata($conn, 'berita b', '*', $where, $join);

								foreach ($getdata['data'] as $key => $row) {
							?>
									<tr>
										<td align="center"><?php echo $no++; ?></td>
										<td align="center"><?php echo app_date_value($row['berita_createdate'], "d M Y"); ?></td>
										<td><?php echo $row['berita_judul']; ?></td>
										<td><?php echo $row['nama']; ?></td>
										<td align="center">
											<a href="pages.php?q=berita&action=lihat&id=<?php echo $row['berita_id']; ?>">
												<button class="btn btn-sm btn-primary">buka</button>
											</a>
											<?php if (app_session()['level'] == 'guru' AND app_session()['guru_id'] == $row['berita_createby']) : ?>
												<a href="pages.php?q=berita&action=edit&id=<?php echo $row['berita_id']; ?>">
													<button class="btn btn-sm btn-primary">Edit</button>
												</a>
												<button class="btn btn-sm btn-danger delete" data-id="<?php echo $row['berita_id']; ?>" data-action="delete">Hapus</button>
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
				<?php include'berita_form.php'; ?>
			<?php elseif(@$_GET['action'] == 'lihat') : ?>
				<?php include'berita_lihat.php'; ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(function() {

    	var notif = $('#notif');
		var btnDelete 	= $('.delete');
		var id 			= btnDelete.attr('data-id');
		var action 		= btnDelete.attr('data-action');

		notif.click(function(event) {
			$(this).slideUp('slow');
		});

		function removeClass() {
			notif.removeClass();
	    }

		btnDelete.click(function(event) {
			removeClass();
			$.ajax({
				url: "<?php echo $base_url; ?>/modules/berita/berita_action.php",
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