<?php
session_start();
 if (empty($_SESSION['admin_id'])){
  echo "string";
}
else{
include "../../../config/koneksi.php";
include "../../../config/datetime.php";

$module=$_GET['q'];
$act=$_GET['act'];
$ksi = @$_GET['ksi'];
$no = auto_nomor($conn);
if ($module=='siswa' AND $act=='input'){
  $cek = mysqli_query($conn, "SELECT * FROM tb_siswa where nis = '$_POST[nis]'");
  if(mysqli_num_rows($cek)>=1){
    die("Nis sudah digunakan !");
  }

	
  $pass=md5($_POST['pass']);
  mysqli_query($conn, "INSERT INTO tb_siswa(kelas_sub_id,nis,id,
                                 pass,
                                 nama,kelamin,tgl,jam) 
	                       VALUES('$_POST[kelas_sub_id]','$_POST[nis]','$no',
                                '$pass',
                                '$_POST[nama]','$_POST[kelamin]','$tgl','$jam')");
					
  header('location:../../pages.php?q='.$module.'&act=tampilsiswa&kelas_sub_id='.$ksi);
}

elseif ($module=='siswa' AND $act=='update'){
  if($_POST['no'] == '') {
    $_add_no = "id = '$no',";
  } else {
    $_add_no = "";
  }

  if (empty($_POST['pass'])) {
    mysqli_query($conn, "UPDATE tb_siswa SET 	nis = '$_POST[nis]',
                    $_add_no
                    nama = '$_POST[nama]',
										kelamin = '$_POST[kelamin]'
                           WHERE  siswa_id     = '$_POST[id]'");
  header('location:../../pages.php?q='.$module.'&act=tampilsiswa&kelas_sub_id='.$ksi);
  }
  else{
    $pass=md5($_POST['pass']);
    mysqli_query($conn, "UPDATE tb_siswa SET nis = '$_POST[nis]',
                    $_add_no
                    nama = '$_POST[nama]',
                    kelamin = '$_POST[kelamin]',
                    pass        = '$pass' 
                           WHERE  siswa_id     = '$_POST[id]'");

                           
  header('location:../../pages.php?q='.$module.'&act=tampilsiswa&kelas_sub_id='.$ksi);
  }
}


if ($module=='siswa' AND $act=='hapus'){
     mysqli_query($conn, "DELETE FROM tb_siswa WHERE siswa_id='$_GET[id]'");
  header('location:../../pages.php?q='.$module.'&act=tampilsiswa&kelas_sub_id='.$ksi);
  }

}

if ($module=='siswa' AND $act=='import'){
        $response = null;
        $_error   = [];
        $data     = null;
        $kolom    = null;

        include "../../../vendor/autoload.php";

        if (isset($_FILES['import']))
        {
            $import   = $_FILES['import'];

            // trace($import,false);
              // validasi

            $ekstensi = ['xlsx','xls','ods'];
            if ( in_array(get_file_extensions($import['name']), $ekstensi) )
            {
                $tmp    = $import['tmp_name'];  

                try {

                    $ext = strtolower((get_file_extensions($import['name'])));

                    if ($ext == 'xlsx') {
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    } elseif ($ext == 'xls') {
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                    } elseif ($ext == 'ods') {
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Ods();
                    }

                    $reader->setReadDataOnly(true);
                    $spreadsheet = $reader->load($tmp);

                    $rowHeader  = 2;
                    $rowData  = $rowHeader+1;        

                    $sheetdata = $spreadsheet->getActiveSheet()->toArray(null,true,true,true);

                    $kolom = [
                        'A' => 'nis',
                        'B' => 'nama',
                        'C' => 'kelamin',
                        'D' => 'pass'
                    ];

                    // $kolom     = $sheetdata[$rowHeader];
                    // trace($kolom,false);

                    // unset unused sheetdata
                    for ( $i=$rowHeader; $i > 0; $i-- ) {
                        unset($sheetdata[$i]);
                    }

                    // trace($sheetdata,false);

                    $i = 0;
                    foreach ($sheetdata as $tempdata) {
                        foreach ($tempdata as $key => $value) {
                            $data[$i][$kolom[$key]] = $value;
                        }

                        $i++;
                    }
                    // trace($data,false);

                    $no = 0;
                    for ($i=0; $i < count($data); $i++) { 
                        $data[$i]['nis'] = $data[$i]['nis'];
                        $data[$i]['nama'] = $data[$i]['nama'];
                        $data[$i]['kelamin'] = $data[$i]['kelamin'];
                        $data[$i]['pass'] = ($data[$i]['pass'] != "") ? md5($data[$i]['pass']) : md5('admin');
                        $data[$i]['kelas_sub_id'] = $_POST['kelas_sub_id'];

                        $cek = mysqli_query($conn, "SELECT * FROM tb_siswa where nis = '{$data[$i]['nis']}'");
                        if(mysqli_num_rows($cek)>=1){
                            die("Nis {$data[$i]['nis']} sudah digunakan !");
                        }

                        $save[$i] = mysqli_query($conn, "INSERT INTO tb_siswa(kelas_sub_id, nis, 
                                        nama,
                                        kelamin,
                                        pass,tgl,jam) 
                               VALUES('{$data[$i]['kelas_sub_id']}','{$data[$i]['nis']}',
                                    '{$data[$i]['nama']}',
                                    '{$data[$i]['kelamin']}','{$data[$i]['pass']}',
                                    '$tgl','$jam')") or die(mysqli_error());
                    }

                    if ($save) {
                        header('location:../../pages.php?q='.$module.'&act=tampilsiswa&kelas_sub_id='.$_POST['kelas_sub_id']);
                    }

                } catch (Exception $e) {

                }
            } else {
                echo "ayo mau import file apa?";
            }
        }
    }
?>
