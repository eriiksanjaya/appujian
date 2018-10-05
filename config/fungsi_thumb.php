<?php
function UploadImage($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../data1/images/";
  $vdir_upload_tooltips = "../../../data1/tooltips/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $tipe_file   = $_FILES['fupload']['type'];

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli  
  if ($tipe_file=="image/jpeg" ){
      $im_src = imagecreatefromjpeg($vfile_upload);
      }elseif ($tipe_file=="image/png" ){
      $im_src = imagecreatefrompng($vfile_upload);
      }elseif ($tipe_file=="image/gif" ){
      $im_src = imagecreatefromgif($vfile_upload);
      }elseif ($tipe_file=="image/wbmp" ){
      $im_src = imagecreatefromwbmp($vfile_upload);
    }
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Set ukuran gambar hasil perubahan
  $dst_width = 85;
  $dst_height = 48;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if ($_FILES["fupload"]["type"]=="image/jpeg" ){
      imagejpeg($im,$vdir_upload_tooltips . $fupload_name);
      }
    elseif ($_FILES["fupload"]["type"]=="image/png" ){
      imagepng($im,$vdir_upload_tooltips . $fupload_name);
      }
    elseif ($_FILES["fupload"]["type"]=="image/gif" ){
      imagegif($im,$vdir_upload_tooltips . $fupload_name);
      }
    elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
      imagewbmp($im,$vdir_upload_tooltips . $fupload_name);
      }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

function UploadProfile($fupload_name){
  //direktori gambar
  $vdir_upload = "../../../imgs/profile/";
  $vfile_upload = $vdir_upload . $fupload_name;
  $tipe_file   = $_FILES['fupload']['type'];
  
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli  
  if ($tipe_file=="image/jpeg" ){
      $im_src = imagecreatefromjpeg($vfile_upload);
      }elseif ($tipe_file=="image/png" ){
      $im_src = imagecreatefrompng($vfile_upload);
      }elseif ($tipe_file=="image/gif" ){
      $im_src = imagecreatefromgif($vfile_upload);
      }elseif ($tipe_file=="image/wbmp" ){
      $im_src = imagecreatefromwbmp($vfile_upload);
    }
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Set ukuran gambar hasil perubahan
  $dst_width = 128;
  $dst_height = 128;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  if ($_FILES["fupload"]["type"]=="image/jpeg" ){
      imagejpeg($im,$vdir_upload . $fupload_name);
      }
    elseif ($_FILES["fupload"]["type"]=="image/png" ){
      imagepng($im,$vdir_upload . $fupload_name);
      }
    elseif ($_FILES["fupload"]["type"]=="image/gif" ){
      imagegif($im,$vdir_upload . $fupload_name);
      }
    elseif($_FILES["fupload"]["type"]=="image/wbmp" ){
      imagewbmp($im,$vdir_upload . $fupload_name);
      }
  
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}
?>