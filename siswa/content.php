<?php
if(empty($_SESSION['siswa_id'])){
  header("location:$base_url/siswa");
}elseif ($_GET['q']=='beranda'){
    include "pages/beranda/beranda.php";
}
elseif ($_GET['q']=='profil'){
    include "pages/profil/profil.php";
}
elseif ($_GET['q']=='pilih-soal'){
    include "pages/pilihsoal/pilihsoal.php";
}
elseif ($_GET['q']=='kerjakan-soal'){
    include "pages/kerjakansoal/kerjakansoal.php";
}
elseif ($_GET['q']=='hasil'){
    include "pages/kerjakansoal/aksi_kerjakansoal.php";
}
elseif ($_GET['q']=='lihat-nilai'){
    include "pages/nilai/nilai.php";
}
elseif ($_GET['q']=='learning'){
    include "../modules/learning/learning.php";
}
else{
  echo "<h3><b>Alamat yang Anda ketikan tidak terdaftar</b></h3>";
}
?>
