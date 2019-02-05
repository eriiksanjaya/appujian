<?php
	$folder = "";
	$server = $_SERVER['HTTP_HOST'];

	$local = true; /*true or false*/
	/*
	GANTI $local = false, jika sudah dionlinekan.
	*/

	$ssl = false; /*true or false*/
	/* 
	ganti true jika menggunakan SSL
	*/

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