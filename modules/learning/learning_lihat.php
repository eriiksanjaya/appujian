<style>
	section {
		padding: 20px;
	}
	.card-title {
		font-size: 29px;
	}
	.card-meta {
		font-size: 16px;
	}
	.card-text {
		font-size: 20px;
	}
</style>

<?php 
	$where = "learning_id = '{$_GET['id']}'";
	$data = app_getdata($conn, 'vw_learning', '*', $where);
	if ($data['status']) {
		$data = $data['data'][0];
	} else {
		trace($data['message']);
	}

?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<section class="my-5">
			  <div class="row">
			    <div class="col-md-12 col-lg-12">
			      <div class="card card-personal">
			        <div class="card-body">
			          <a>
			            <h4 class="card-title title-one"><?php echo $data['learning_judul']; ?></h4>
			          </a>
			          <p class="card-meta"><?php echo $data['guru_nama']; ?> | <?php echo app_date_value($data['learning_createdate'], 'd M Y'); ?></p>
			          <p class="card-meta">Kelas : <strong><?php echo $data['kelas_nama']; ?></strong>, Mapel : <strong><?php echo $data['mapel_nama']; ?></strong></p>
			          <span class="card-text"><?php echo $data['learning_konten']; ?></span>
			        </div>
			      </div>
			    </div>
			  </div>
			</section>
		</div>
	</div>
</div>