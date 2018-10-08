<?php
include "config/url.php";
if($_SERVER['REQUEST_METHOD'] != 'POST'){
  header("location:$base_url");
    }
    else{
include "config/koneksi.php";
include "config/datetime.php";

$no = auto_nomor($conn);
// trace($no);

if(empty($_POST['kelas_sub_id']) || empty($_POST['pass']) || empty($_POST['nama']) || empty($_POST['kelamin'])){
  die("Semua textfield harus diisi !");
}

/*$ceknis = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE id = '$_POST[id]'");
if(mysql_num_rows($ceknis) >=1){
  die("Nis telah terdaftar !");
}*/

  $pass=md5($_POST['pass']);
  mysqli_query($conn, "INSERT INTO tb_siswa(kelas_sub_id,id,
                                 pass,
                                 nama,kelamin,tgl,jam)
	                       VALUES('$_POST[kelas_sub_id]','{$no}',
                                '$pass',
                                '$_POST[nama]','$_POST[kelamin]','$tgl','$jam')");

$login=mysqli_query($conn, "SELECT * FROM vw_siswa WHERE id='$no' AND pass='$pass'");
$ketemu=mysqli_num_rows($login);
$r=mysqli_fetch_assoc($login);

if ($ketemu > 0){
  session_start();
  $_SESSION['siswa_id']     = @$r['user_id'];
  $_SESSION['id']           = @$r['id'];
  $_SESSION['kelas_sub_id'] = @$r['kelas_sub_id'];
  $_SESSION['nama_siswa']   = @$r['nama'];
  $_SESSION['panggilan']    = @$r['panggilan'];

  header("location:$base_url/siswa");
}else{
  header("location:$base_url");
}


}
?>
