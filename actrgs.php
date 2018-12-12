<?php
include "config/url.php";
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header("location:$base_url");
} else {
    include "config/koneksi.php";
    include "config/datetime.php";

    $no = auto_nomor($conn);

    if(empty($_POST['kelas_sub_id']) || empty($_POST['pass']) || empty($_POST['nama']) || empty($_POST['kelamin'])){
        die("Semua textfield harus diisi !");
    }

    $pass = md5($_POST['pass']);
    $save = mysqli_query($conn, "INSERT INTO tb_siswa(kelas_sub_id,id,
       pass,
       nama,kelamin,tgl,jam)
    VALUES('$_POST[kelas_sub_id]','{$no}',
      '$pass',
      '$_POST[nama]','$_POST[kelamin]','$tgl','$jam')") or trace($conn);

    $login  = mysqli_query($conn, "SELECT * FROM vw_user WHERE id='$no' AND pass='$pass'");
    $ketemu = mysqli_num_rows($login);
    $r      = mysqli_fetch_assoc($login);


    if ($ketemu > 0) {
        session_start();

        $detik = 1000; // silakan ubah bagian sini
        timeout($detik);

        $_SESSION['siswa_id']     = @$r['user_id'];
        $_SESSION['id']           = @$r['id'];
        $_SESSION['kelas_sub_id'] = @$r['kelas_sub_id'];
        $_SESSION['nama_siswa']   = @$r['nama'];
        $_SESSION['panggilan']    = @$r['panggilan'];
        $_SESSION['level']        = @$r['level'];
        $_SESSION['login']        = 1;

        header("location:siswa/pages.php?q=beranda");
    } else {
        header("location:$base_url");
    }
}
?>
