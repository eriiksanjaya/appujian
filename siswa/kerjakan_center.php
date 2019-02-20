<?php
	$soal_aktif = mysqli_query($conn, "SELECT * FROM tb_soal_aktif WHERE materi_soal_id = '$_GET[msi]' AND soal_aktif_id = '$_GET[sai]'");
    $c = mysqli_fetch_assoc($soal_aktif);

    if($soal_aktif->num_rows > 0) {

    	$doing = mysqli_query($conn, "SELECT * FROM ujian_kerjakan WHERE kerjakan_userid = '$_SESSION[siswa_id]' 
                AND kerjakan_status = 'mulai'
                AND kerjakan_soalaktifid != '$_GET[sai]' AND kerjakan_materisoalid != '$_GET[msi]'");

		if(mysqli_num_rows($doing) > 0) {
			echo"
                <div class='col-md-7'>
				<div class='alert alert-warning alert-dismissible'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
					<h4><i class='icon fa fa-warning'></i> Peringatan</h4>
					<h4>Anda masih mengerjakan tugas lain, klik di <span class='badge btn-twitter'> <a href='$base_url/siswa/pages.php?q=pilih-soal'>sini</a> </span> untuk kembali !</h4?
				</div></div>";
			die();
		} else {
			// cek di ujian_kerjakan ada data / tidak
            $_sql = "SELECT * FROM ujian_kerjakan WHERE kerjakan_userid = '$_SESSION[siswa_id]' 
            AND YEAR(kerjakan_createdate) = '$y' AND MONTH(kerjakan_createdate) = '$m' AND DAY(kerjakan_createdate) = '$d'
            AND kerjakan_soalaktifid = '$_GET[sai]' AND kerjakan_materisoalid = '$_GET[msi]'";
            $get_kerjakan = mysqli_query($conn, $_sql);
            $cek_kerjakan = mysqli_num_rows($get_kerjakan);



            $_getkerjakan = mysqli_fetch_assoc($get_kerjakan);

                $mulai = $c['tgl'] .' '.$c['jam'];
                $selesai = date('Y-m-d H:i:s', strtotime("+ $c[menit] minutes", strtotime($mulai)));

            if ($cek_kerjakan == 0) {

                $jam_selesai = strtotime($selesai);
                $now = strtotime(date('Y-m-d H:i:s'));

                if($jam_selesai<$now)
                {
                    echo"
                    <div class='col-md-7'>
                    <div class='alert alert-warning alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <h4><i class='icon fa fa-warning'></i> Peringatan</h4>
                    <h4>Tanggal dan jam selesai TUGAS telah lewat, klik di <span class='badge btn-twitter'> <a href='$base_url/siswa/pages.php?q=pilih-soal'>sini</a> </span> untuk kembali !</h4?
                    </div></div>";
                    die();
                }
                elseif (strtotime($mulai) > strtotime(date("Y-m-d H:i:s")))
                {
                    echo"
                    <div class='col-md-7'>
                    <div class='alert alert-warning alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <h4><i class='icon fa fa-warning'></i> Peringatan</h4>
                    <h4>Belum Saatnya Anda mengerjakan !, klik di <span class='badge btn-twitter'> <a href='$base_url/siswa/pages.php?q=pilih-soal'>sini</a> </span> untuk kembali !</h4?
                    </div></div>";
                    die();
                }

                /*proses simpan*/
                $field_value['id']      = rand(9, 999999);
                $field_value            = ['mulai' => $mulai, 'selesai' => $selesai];

                $get_soal = mysqli_query($conn, "SELECT * FROM vw_soal WHERE aktif ='aktif' AND blokir ='n' AND soal_aktif_id = '$_GET[sai]' AND materi_soal_id = '$_GET[msi]' AND siswa_id = '$_SESSION[siswa_id]' ORDER BY RAND()");


               	foreach ($get_soal as $key => $value) {
                    $_value = preg_replace('/\s+/', ' ', $value);
               		$field_value['soal'][$key] = str_replace(
                        ["'","<p>","</p>","\n","\r",'"',"alt= ", "{", "}", "{\u}", "alt=", "\\", ""],
                        ["", "", "", "", "", "", "", "&#123;", "&#125;", "&#123;&#92;u&#125;", "", "&#92;", ""], $_value);
               	}

                $array = json_encode($field_value, JSON_UNESCAPED_UNICODE);

                $kolom = "(kerjakan_userid,kerjakan_data,kerjakan_status,kerjakan_createdate,kerjakan_soalaktifid,kerjakan_materisoalid,kerjakan_mulai,kerjakan_selesai)";
                $nilai = "('$_SESSION[siswa_id]','$array','mulai','$tgl','$_GET[sai]','$_GET[msi]','$mulai','$selesai')";

                $save = simpan('ujian_kerjakan',$kolom,$nilai, $conn);
           	} else {
                if ($_getkerjakan['kerjakan_status'] == 'selesai') {
                    echo"
                    <div class='col-md-7'>
                    <div class='alert alert-warning alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <h4><i class='icon fa fa-warning'></i> Peringatan</h4>
                    <h4>Anda sudah mengerjakan tugas ini!, klik di <span class='badge btn-twitter'> <a href='$base_url/siswa/pages.php?q=pilih-soal'>sini</a> </span> untuk kembali !</h4?
                    </div></div>";
                    die();
                }
            }
		}
    }
?>

<div class="col-md-7">
	<div class="row" id="cont-soal">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">SOAL NOMOR <strong><span class="nomor"></span></strong></h3>
					<div class="box-tools pull-right"></div>
				</div>
				<div class="box-body" id="page_soal"></div>
			</div>
		</div>
	</div>

	<div class="row" id="page_nilai"></div>

	<input type='hidden' id='selesai_jam' value='<?php echo $selesai; ?>'>
	<div class="row" id="cont-selesai">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-body">
					<button class="btn btn-warning prev">Prev</button>
					<button class="btn btn-warning next">Next</button>

					<button class="btn btn-primary pull-right" id="btn_selesai">SELESAI</button>
					<button class="btn btn-primary pull-right" id="terminated" onclick="selesaikan_tugas()" style="display: none;"></button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="page_nomor"></div>

<script type="text/javascript">
	nomor_soal(0);

	$('button.prev').attr('onclick', 'nomor_soal(0)');
	$('button.next').attr('onclick', 'nomor_soal(1)');

	$('#btn_selesai').click(function(event) {
        swal({
            title: "Yakin sudah selesai?",
            // text: "Your will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Ya",
            cancelButtonText: 'Tidak',
            closeOnConfirm: false,
            showLoaderOnConfirm: true
            },
            function(){
                swal({
		            title: "Berhasil menyelesaikan tugas",
		            type: "success",
            		showLoaderOnConfirm: true,
		  			timer: 3000
		        });
                _terminated();
            }
        );
    });

    function _terminated() {
        setTimeout(function(){ selesaikan_tugas(); }, 3000);
    }

    function selesaikan_tugas() {
        var sai = "<?php echo $_GET['sai']; ?>";
        var msi = "<?php echo $_GET['msi']; ?>";
        var data = {
            'sai' : sai,
            'msi' : msi
        }
        $.ajax({
            url: 'kerjakan_selesai.php',
            type: 'GET',
            dataType: 'html',
            data: data,
        })
        .done(function(res) {
            $('#cont-soal').slideUp('slow');
            $('#cont-selesai').slideUp('slow');
            $('#page_nilai').html(res);
            $('#page_nilai').slideDown('slow');
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }

    function cek_timeout() {
        $.ajax({
            url: 'kerjakan_cektimeout.php',
            type: 'POST',
            dataType: 'json',
        })
        .done(function(res) {
            console.log(res.status);
            if(res.status == 0) {
                //selesaikan_tugas();
            }
        });
    }

    function nomor_soal(nomor) {
		var nomor_max = $('#nomor_max').val();
	    var sai = "<?php echo $_GET['sai']; ?>";
	    var msi = "<?php echo $_GET['msi']; ?>";
	    var data = {
            'nomor' : nomor,
            'sai' : sai,
            'msi' : msi
        }

        cek_timeout();

        $.ajax({
            url: 'kerjakan_getsoal.php',
            type: 'GET',
            dataType: 'html',
            data: data,
        })
        .done(function(res) {

        	var prev = nomor-1;
        	var next = nomor+1;

        	if(prev <= 0) {
        		prev = 0;
        	}

        	if(next >= nomor_max) {
        		next = nomor_max-1;
        	}

			$('button.prev').attr('onclick', 'nomor_soal('+prev+','+nomor_max+')');
			$('button.next').attr('onclick', 'nomor_soal('+next+','+nomor_max+')');

            $('.nomor').html(nomor+1);
            $('#page_soal').html(res);
            $('#selesai_jam').val($('#final_date').val());
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
        });

        $.ajax({
        	url: 'kerjakan_right.php',
            type: 'GET',
            dataType: 'html',
            data: data,
        })
        .done(function(res) {
            $('#page_nomor').html(res);
        })
        .fail(function() {
        	console.log("error");
        })
        .always(function() {
        });
        
    }

</script>