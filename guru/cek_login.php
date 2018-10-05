<?php
include "../config/koneksi.php";
include "../config/url.php";


if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("location:$base_url/siswa");
} 
else 
{
    $nip      = $_POST['nip'];
    $pass     = md5($_POST['pass']);
    if (!ctype_alnum($nip) OR !ctype_alnum($pass)){
        header("location:$base_url/guru");
    }
    else
    {
        $login=mysqli_query($conn, "SELECT * FROM tb_guru WHERE nip='$nip' AND pass='$pass'");
        
        $ketemu=mysqli_num_rows($login);
        $r=mysqli_fetch_assoc($login);

        if ($ketemu > 0){
            session_start();
            $_SESSION['KCFINDER']=array();
            $_SESSION['KCFINDER']['disabled'] = false;
            $_SESSION['KCFINDER']['uploadDir'] = "";
            $_SESSION['guru_id']    = $r['guru_id'];
            $_SESSION['nip']        = $r['nip'];
            $_SESSION['nama_guru']  = $r['nama'];

            setcookie('uploadURL', $base_url . '/public/uploads/', '86400');

            header("location:$base_url/guru/pages.php?q=beranda");
        }
        else
        {
            header("location:$base_url/guru");
        }
    }
}
?>
