<?php

/*Waktu Indonesia Barat: Asia/Jakarta
Waktu Indonesia Tengah: Asia/Makassar
Waktu Indonesia Timur: Asia/Jayapura*/

date_default_timezone_set('Asia/Jakarta');

$hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");

$tgl = date("Y-m-d H:i:s");
$jam = date("H:i:s");

$d = date("d");
$m = date("m");
$y = date("Y");

$minggu = array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");
?>
