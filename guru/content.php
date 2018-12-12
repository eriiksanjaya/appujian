<?php
 if (empty($_SESSION['guru_id'])){
  header("location:$base_url/guru");
}
elseif ($_GET['q']=='beranda'){
    include "pages/beranda/beranda.php";
}
elseif ($_GET['q']=='profil'){
    include "pages/profil/profil.php";
}
elseif ($_GET['q']=='materi-soal'){
    include "pages/materi/materi.php";
}
elseif ($_GET['q']=='buat-soal'){
    include "pages/soal/soal.php";
}
elseif ($_GET['q']=='pilih-kelas'){
    include "pages/kelas/kelas.php";
}
elseif ($_GET['q']=='pilih-mapel'){
    include "pages/mapel/mapel.php";
}
elseif ($_GET['q']=='aktifkan-soal'){
    include "pages/aktifkansoal/aktifkansoal.php";
}
elseif ($_GET['q']=='nilai-siswa'){
    include "pages/nilai/nilai.php";
}
elseif ($_GET['q']=='learning'){
    include "../modules/learning/learning.php";
}
else{
  echo "<h3><b>Alamat yang Anda ketikan tidak terdaftar</b></h3>";
}
?>
