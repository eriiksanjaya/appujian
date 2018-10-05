<?php
include "config/koneksi.php";
include "config/url.php";
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("location:$base_url");
} else {
    $id  = $_POST['id'];
    $pass =md5($_POST['pass']);

    // login id
    $login=mysqli_query($conn, "SELECT * FROM vw_siswa WHERE (id='$_POST[id]' OR nis='$_POST[id]') AND pass='$pass'");
    $ketemu=mysqli_num_rows($login);
    $r=mysqli_fetch_assoc($login);

    if ($ketemu > 0) {
        session_start();
        include "timeout.php";
        $_SESSION['siswa_id']     = $r['siswa_id'];
        $_SESSION['id']           = $r['id'];
        $_SESSION['kelas_sub_id'] = $r['kelas_sub_id'];
        $_SESSION['nama_siswa']   = $r['nama'];
        $_SESSION['panggilan']    = $r['panggilan'];

        $_SESSION[login] = 1;
        timer();
        header("location:siswa/pages.php?q=beranda");
    }
    else
    {
        header("location:$base_url");
    }

}
?>
