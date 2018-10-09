<?php
 if (empty($_SESSION['admin_id'])){
  header("location:$base_url/admin");
}
elseif ($_GET['q']=='beranda'){
    include "pages/beranda/beranda.php";
}
elseif ($_GET['q']=='masuk'){
    include "masuk.php";
}
elseif ($_GET['q']=='profil'){
    include "pages/profil/profil.php";
}
elseif ($_GET['q']=='guru'){
    include "pages/guru/guru.php";
}
elseif ($_GET['q']=='siswa'){
    include "pages/siswa/siswa.php";
}
elseif ($_GET['q']=='siswa&act=tampilsiswa'){
}
elseif ($_GET['q']=='kelas'){
    include "pages/kelas/kelas.php";
}
elseif ($_GET['q']=='sub_kelas'){
    include "pages/kelas_sub/sub_kelas.php";
}
elseif ($_GET['q']=='mapel'){
    include "pages/mapel/mapel.php";
}
elseif ($_GET['q']=='soal'){
    include "pages/soal/soal.php";
}
elseif ($_GET['q']=='profil'){
    include "pages/profil/profil.php";
}
elseif ($_GET['q']=='nilai'){
    include "pages/nilai/nilai.php";
}
elseif ($_GET['q']=='waktu'){
    include "pages/waktu/waktu.php";
}
elseif ($_GET['q']=='aboutme'){
    include "pages/aboutme/erik.php";
  }
elseif ($_GET['q']=='formdaftar'){
    include "pages/formdaftar/formdaftar.php";
}
elseif ($_GET['q']=='slide'){
    include "pages/slide/slide.php";
}
elseif ($_GET['q']=='identitas'){
    include "pages/identitas/identitas.php";
}
elseif ($_GET['q']=='endtask'){
    include "../modules/endtask/endtask.php";
}
else{
  echo "<h3><b>Alamat yang Anda ketikan tidak terdaftar</b></h3>";
}
?>
