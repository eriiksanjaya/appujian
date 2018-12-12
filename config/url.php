<?php
	$folder = "";
	$server = $_SERVER['HTTP_HOST'];

	$local = true; // ganti true atau false
	/*
	(ganti true atau false)
	GANTI $local = false, jika sudah dionlinekan.
	*/

	$ssl = false;
	/* 
	(ganti true atau false)
	ganti true jika sudah menggunakan SSL*/

	if ($ssl) {
		$scheme = "https";
	} else {
		$scheme = "http";
	}


    if ($local) {
        $base_url = "http://localhost/appujian";
    } else {
       	$base_url = $scheme . "://" .$server . "/" . $folder;
    }
?>