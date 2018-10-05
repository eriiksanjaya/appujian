<?php
    include "config/koneksi.php";
    include "config/url.php";
    if($_SERVER['REQUEST_METHOD'] != 'POST') {

        header("location:$base_url");

    } else {

        $id  = $_POST['id'];
        $pass =md5($_POST['pass']);

        $where = "((id='$_POST[id]' OR nomor='$_POST[id]') OR email='$_POST[id]') AND pass='$pass'";

        // login id
        $sql = "SELECT * FROM vw_user WHERE {$where}";
        $login=mysqli_query($conn, $sql);
        $ketemu=mysqli_num_rows($login);
        $r=mysqli_fetch_assoc($login);

        if ($ketemu > 0) {
            session_start();

            /**
             * TIMEOUT
             * Jika tidak ada aktivitas dalam mengerjakan soal, selama timeout yang telah ditentukan, maka tugas dianggap selesai.
             * @var detik int
             **/

            $detik = 10; // silakan ubah bagian sini
            timeout($detik);

            $_SESSION['siswa_id']     = @$r['user_id'];
            $_SESSION['id']           = @$r['id'];
            $_SESSION['kelas_sub_id'] = @$r['kelas_sub_id'];
            $_SESSION['nama_siswa']   = @$r['nama'];
            $_SESSION['panggilan']    = @$r['panggilan'];

            $_SESSION['admin_id']     = @$r['user_id'];
            $_SESSION['nama_admin']   = @$r['nama'];
            $_SESSION['email_admin']  = @$r['email'];
            $_SESSION['pass_admin']   = @$r['pass'];
            $_SESSION['level']        = @$r['level'];

            $_SESSION['KCFINDER']               = [];
            $_SESSION['KCFINDER']['disabled']   = false;
            $_SESSION['KCFINDER']['uploadDir']  = "";
            $_SESSION['guru_id']      = @$r['user_id'];
            $_SESSION['nip']          = @$r['nomor'];
            $_SESSION['nama_guru']    = @$r['nama'];

            if($r['level'] == "guru") {
                setcookie('uploadURL', $base_url . '/public/uploads/', '86400');
                header("location:guru/pages.php?q=beranda");
            } elseif($r['level'] == "siswa") {
                header("location:siswa/pages.php?q=beranda");
            } elseif($r['level'] == "admin") {
                header("location:admin/pages.php?q=beranda");
            }

            $_SESSION['login'] = 1;
        } else {
            header("location:$base_url");
        }

    }
?>
