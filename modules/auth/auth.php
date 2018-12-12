<?php
    include "../../config/koneksi.php";
    include "../../config/url.php";

    $error  = [];
    $data['status']     = false;
    $data['message']    = "Terjadi kesalahan sistem";

    $id     = $_POST['id'];
    $pass   = $_POST['pass'];

    if ($id == "" OR $pass == "") {
        $error[] = "User ID dan Password Dibutuhkan.";
    }

    if (count($error) > 0) {
        $data['status']     = false;
        $data['message']    = implode(",", $error);
    } else {
        $pass =md5($pass);

        $where = "((id='$_POST[id]' OR nomor='$_POST[id]') OR email='$_POST[id]') AND pass='$pass'";

        // login id
        $sql = "SELECT * FROM vw_user WHERE {$where}";
        $login=mysqli_query($conn, $sql);
        $ketemu=mysqli_num_rows($login);
        $r=mysqli_fetch_assoc($login);

        if ($ketemu > 0) {

            $detik = $timeout;
            timeout($detik);

            $_SESSION['siswa_id']     = @$r['user_id'];
            $_SESSION['id']           = @$r['id'];
            $_SESSION['kelas_id']     = @$r['kelas_id'];
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

            $url = $base_url;

            if($r['level'] == "guru") {
                setcookie('uploadURL', $base_url . '/public/uploads/', '86400');
                $redirect = $url . "/guru/pages.php?q=beranda";
            } elseif($r['level'] == "siswa") {
                $redirect = $url . "/siswa/pages.php?q=beranda";
            } elseif($r['level'] == "admin") {
                $redirect = $url . "/admin/pages.php?q=beranda";
            }

            $_SESSION['login'] = 1;

            $data['status']     = true;
            $data['message']    = "Selamat datang " . @$r['nama'];
            $data['redirect']   = $redirect;
        } else {
            $data['status']     = false;
            $data['message']    = "UserID dan Password tidak sesuai";
        }
    }

    echo json_encode($data);

?>
