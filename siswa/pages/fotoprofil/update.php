<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/datetime.php";
include "../../../config/fungsi_thumb.php";

if(empty($_SESSION['siswa_id'])){
  header('location:../../../');
}

// trace($_FILES);

$q=$_GET['q'];

	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	$tipe_file      = $_FILES['fupload']['type'];
	$ukuran         = $_FILES['fupload']['size'];
	$nama_file      = $_FILES['fupload']['name'];
	$acak           = rand(0000000000,9999999999);
	$nama_file_unik = 'apfp_'.$y.$m.$d.$acak.$nama_file; 

	@$image_size_info  = getimagesize($lokasi_file); //get image size

	if($image_size_info){
		$image_width    = $image_size_info[0]; //image width
		$image_height     = $image_size_info[1]; //image height
		$image_type     = $image_size_info['mime']; //image type image/jpg doang :p
	}else{
		die("File tidak valid!");
	}

	$cek_tipe = $tipe_file;
	echo"file yang Anda upload adalah ".$tipe_file." <br>";
	if($cek_tipe != "image/jpeg" AND $cek_tipe != "image/png"){
		die("Ekstensi tidak valid!");
	}
	
	UploadProfile($nama_file_unik);

	mysqli_query($conn, "UPDATE tb_siswa SET foto = '$nama_file_unik' WHERE siswa_id = '$_SESSION[siswa_id]'");
	header('location:../../pages.php?q='.$q);

?>
