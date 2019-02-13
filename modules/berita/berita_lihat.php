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
	$where = "berita_id = '{$_GET['id']}'";

	$join = "LEFT JOIN tb_guru g on b.berita_createby = g.guru_id";
	$data = app_getdata($conn, 'berita b', '*', $where, $join);
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
			            <h4 class="card-title title-one"><?php echo $data['berita_judul']; ?></h4>
			          </a>
			          <p class="card-meta"><?php echo $data['nama']; ?> | <?php echo app_date_value($data['berita_createdate'], 'd M Y'); ?></p>
			          <span class="card-text"><?php echo $data['berita_konten']; ?></span>
			        </div>
			      </div>
			    </div>
			  </div>
			</section>
		</div>
	</div>
</div>