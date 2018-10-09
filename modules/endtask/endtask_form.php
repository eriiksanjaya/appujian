<div class="box box-primary">
    <div class="box-header">
	    <div class="row">
			<div class="col-md-6 caption"><?php echo ganti_teks(@$_GET['action']); ?> Karyawan</div>
	    </div>
    </div>
    <div class="box-body">
		<?php 
			if($_GET['action'] == 'edit')
			{
				$where = "WHERE karyawan_id = '{$_GET['uid']}'";
				$karyawan_id = mysession('karyawan_id');
				if(mysession('karyawan_level') == '3') :
					$where = "WHERE karyawan_id = '{$karyawan_id}'";
				endif;
				
				$data = mysql_query("SELECT * FROM vw_karyawan {$where}");
				$row = mysql_fetch_assoc($data) or die (mysql_error());
			}
		?>
		<div class="form">
			<form class='form' method=POST action='<?php echo $base_url; ?>modules/karyawan/karyawan_action.php?action=<?php echo @$_GET['action']; ?>'>
				<input type='text' class='form-control' name='id' placeholder='Nomor Induk Karyawan' value="<?php echo @$row['karyawan_id'] ?>" required>
				<div class="row">
					<div class="col-md-6">
						<div class='form-group'>
						  <label>NIK</label>
						    <input type='text' class='form-control' name='nik' placeholder='Nomor Induk Karyawan' value="<?php echo @$row['karyawan_nik'] ?>" required>
						</div>
						<div class='form-group'>
						  <label>Password</label>
						    <input type='password' class='form-control' name='pass' placeholder='Password'>
						</div>
						<div class='form-group'>
						    <label>Nama</label>
						    <input type='text' class='form-control' name='nama' placeholder='Nama' value="<?php echo @$row['karyawan_nama'] ?>" required>
						</div>

						<div class="form-group">
						    <label>Tanggal Lahir</label>
							<input type="text" name="tgllahir" class="form-control" placeholder="Tanggal Lahir" id="datepicker" value="<?php echo (@$row['karyawan_tgllahir']) ? format_tanggal($row['karyawan_tgllahir'],'en-id'):''; ?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class='form-group'>
						  <label>Agama</label>
							<select class='form-control' name='agama' required>
						  		<option value=''>- pilih -</option>
						  		<?php if($_GET['action'] == 'edit') : ?>
						  			<option selected value='<?php echo $row['karyawan_agama'] ?>'><?php echo $row['karyawan_agama'] ?></option>
						  		<?php endif; ?>
						  		<option value='ISLAM'>ISLAM</option>
						  		<option value='KATOLIK'>KATOLIK</option>      
						  		<option value='PROTESTAN'>PROTESTAN</option>      
						  		<option value='HINDU'>HINDU</option>      
						  		<option value='BUDHA'>BUDHA</option>      
						  		<option value='KONGHUCU'>KONGHUCU</option>      
							</select>
						</div>
						<div class='form-group'>
						  <label>Jenis Kelamin</label>
							<select class='form-control' name='jk' required>
						  		<option value=''>-pilih-</option>
						  		<?php if($_GET['action'] == 'edit') : ?>
						  			<option selected value='<?php echo $row['karyawan_jk'] ?>'><?php echo format_jk($row['karyawan_jk']) ?></option>
						  		<?php endif; ?>
						  		<option value='L'>Laki-Laki</option>
						  		<option value='p'>Perempuan</option>      
							</select>
						</div>
						<div class='form-group'>
						  <label>Level</label>
							<select class='form-control' name='level' required>
						  		<option value=''>-pilih-</option>
						  		<?php if($_GET['action'] == 'edit') : ?>
						  			<option selected value='<?php echo $row['karyawan_level'] ?>'><?php echo karyawan_level($row['karyawan_level']) ?></option>
						  		<?php endif; ?>
						  		<option value='1'>Super Admin</option>
						  		<option value='2'>Admin Sales</option>      
						  		<option value='3'>Sales</option>      
							</select>
						</div>
						<div class='form-group'>
						  <label>Ponsel</label>
						    <input type='text' class='form-control' name='ponsel' placeholder='Ponsel' value="<?php echo @$row['karyawan_hp'] ?>" required>
						</div>
					</div>
				</div>
				
				<div class='form-group'>
				  <label>Alamat</label>
				    <textarea class='form-control' name='alamat' placeholder='Alamat'><?php echo @$row['karyawan_alamat'] ?></textarea>
				</div>
              	<div class="box-footer pull-right">
					<a href="<?php echo $base_url."pages.php?q=".$_GET['q']; ?>"><input type='button' class='btn btn-sm btn-flat' value='Batal'></a>
					<input type=submit class='btn btn-sm btn-flat bg-primary' value='Simpan'>
				</div>
			</form>
		</div>
	</div>
</div>