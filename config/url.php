<?php
	$folder = "appujian";
    $server = $_SERVER['HTTP_HOST'];
    $scheme = $_SERVER['REQUEST_SCHEME'];

    $auto = true; // ganti true atau false

    /**
     * undocumented class variable
     *
     * @var auto boolean
     * jika ingin menggunakan url manual ganti true jadi false dan
     * ganti urlnya dengan domain Anda jika sudah online
     **/

    if ($auto) {
		$base_url = $scheme ."://" .$server . "/" . $folder;
    } else {
		$base_url = "http://localhost/appujian";
    }

?>