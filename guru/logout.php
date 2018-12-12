<?php
include"../config/url.php";
  session_start();
  session_destroy();
  header("location:$base_url");
?>
