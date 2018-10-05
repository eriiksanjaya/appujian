<?php

/*Waktu Indonesia Barat: Asia/Jakarta
Waktu Indonesia Tengah: Asia/Makassar
Waktu Indonesia Timur: Asia/Jayapura*/

date_default_timezone_set('Asia/Jakarta');

$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Ymd");
$tgl_indonesia = date("d/m/Y");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

$tgl_en = date("Ymd");
$tgl = date("Y-m-d H:i:s");
$jam = date("H:i:s");

$d = date("d");
$m = date("m");
$y = date("Y");


$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");
?>
