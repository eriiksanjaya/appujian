<?php
// class paging untuk halaman administrator
class Paging{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&halaman=1><< First</a></li>  
                    <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&halaman=$prev>< Prev</a></li>";
}
else{ 
	$link_halaman .= "<li><a><< First</a> <a>< Prev</a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&halaman=$i>$i</a></li>";
  }
	  $angka .= " <li class='active'><a>$halaman_aktif</a></li>  ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&halaman=$i>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&halaman=$jmlhalaman>$jmlhalaman</a> " : " </li>");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&halaman=$next>Next ></a></li> 
                     <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&halaman=$jmlhalaman>Last >></a></li> ";
}
else{
	$link_halaman .= " <li><a>Next ></a>  <a>Last >></a></li>";
}
return $link_halaman;
}
}




class PagingTampilNilaiMateri{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilmateri&kelas_sub_id=$_GET[kelas_sub_id]&halaman=1><< First</a></li>  
                    <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilmateri&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$prev>< Prev</a></li>";
}
else{ 
	$link_halaman .= "<li><a><< First</a> <a>< Prev</a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilmateri&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$i>$i</a></li>";
  }
	  $angka .= " <li class='active'><a>$halaman_aktif</a></li>  ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilmateri&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$i>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilmateri&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$jmlhalaman>$jmlhalaman</a> " : " </li>");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilmateri&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$next>Next ></a></li> 
                     <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilmateri&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$jmlhalaman>Last >></a></li> ";
}
else{
	$link_halaman .= " <li><a>Next ></a>  <a>Last >></a></li>";
}
return $link_halaman;
}
}




class PagingTampilNilaiTgl{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&tgl=$_GET[tgl]&halaman=1><< First</a></li>  
                    <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&tgl=$_GET[tgl]&halaman=$prev>< Prev</a></li>";
}
else{ 
	$link_halaman .= "<li><a><< First</a> <a>< Prev</a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&tgl=$_GET[tgl]&halaman=$i>$i</a></li>";
  }
	  $angka .= " <li class='active'><a>$halaman_aktif</a></li>  ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&tgl=$_GET[tgl]&halaman=$i>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&tgl=$_GET[tgl]&halaman=$jmlhalaman>$jmlhalaman</a> " : " </li>");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&tgl=$_GET[tgl]&halaman=$next>Next ></a></li> 
                     <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&tgl=$_GET[tgl]&halaman=$jmlhalaman>Last >></a></li> ";
}
else{
	$link_halaman .= " <li><a>Next ></a>  <a>Last >></a></li>";
}
return $link_halaman;
}
}



class PagingLihatSoal{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=lihatsoal&idx=$_GET[idx]&halaman=1><< First</a></li>  
                    <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=lihatsoal&idx=$_GET[idx]&halaman=$prev>< Prev</a></li>";
}
else{ 
	$link_halaman .= "<li><a><< First</a> <a>< Prev</a></li>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=lihatsoal&idx=$_GET[idx]&halaman=$i>$i</a></li>";
  }
	  $angka .= " <li class='active'><a>$halaman_aktif</a></li>  ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=lihatsoal&idx=$_GET[idx]&halaman=$i>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=lihatsoal&idx=$_GET[idx]&halaman=$jmlhalaman>$jmlhalaman</a> " : " </li>");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=lihatsoal&idx=$_GET[idx]&halaman=$next>Next ></a></li> 
                     <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=lihatsoal&idx=$_GET[idx]&halaman=$jmlhalaman>Last >></a></li> ";
}
else{
	$link_halaman .= " <li><a>Next ></a>  <a>Last >></a></li>";
}
return $link_halaman;
}
}







class PagingSiswa{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilsiswa&kelas_sub_id=$_GET[kelas_sub_id]&halaman=1>&laquo; First</a></li>
                    <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilsiswa&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$prev>&lsaquo; Prev</a></li>";
}
else{ 
	$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilsiswa&kelas_sub_id=$_GET[kelas_sub_id]&halaman=1>&laquo; First</a></li>
					<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilsiswa&kelas_sub_id=$_GET[kelas_sub_id]&halaman=1>&lsaquo; Prev </a></li>";
}

// Link halaman 1,2,3, 
$angka = ($halaman_aktif > 3 ? "  " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilsiswa&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$i>$i</a></li>";
  }
  
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilsiswa&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$i>$i</a></li>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilsiswa&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$jmlhalaman>$jmlhalaman</a> " : " </li>");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilsiswa&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$next>Next &rsaquo;</a></li>
                     <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilsiswa&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$jmlhalaman>Last &raquo;</a></li>";
}
else{
	$link_halaman .= " <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilsiswa&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$jmlhalaman>Next &rsaquo;</a></li>
                     <li><a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilsiswa&kelas_sub_id=$_GET[kelas_sub_id]&halaman=$jmlhalaman>Last &raquo;</a></li>";
}
return $link_halaman;
}
}







class PagingTampilNilai{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&halaman=1>&laquo; First</a>
                    <a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&halaman=$prev>&lsaquo; Prev</a>";
}
else{ 
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&halaman=1>&laquo; First</a>
					<a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&halaman=1>&lsaquo; Prev </a>";
}

// Link halaman 1,2,3, 
$angka = ($halaman_aktif > 3 ? "  " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&halaman=$i>$i</a>";
  }
  
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&halaman=$i>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&halaman=$jmlhalaman>$jmlhalaman</a> " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&halaman=$next>Next &rsaquo;</a>
                     <a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&halaman=$jmlhalaman>Last &raquo;</a> ";
}
else{
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&halaman=$jmlhalaman>Next &rsaquo;</a>
                     <a href=$_SERVER[PHP_SELF]?q=$_GET[q]&act=tampilnilai&msi=$_GET[msi]&ksi=$_GET[ksi]&halaman=$jmlhalaman>Last &raquo;</a> ";
}
return $link_halaman;
}
}
?>
