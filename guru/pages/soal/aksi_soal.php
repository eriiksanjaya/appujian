<?php
session_start();
 if (empty($_SESSION['guru_id'])){
  header("location:../../index.php");
}else{
error_reporting(0);
include "../../../config/koneksi.php";
include "../../../config/datetime.php";
include "../../../vendor/autoload.php";

$module=$_GET['q'];
$act=$_GET['act'];

$idm = $_GET['msi'];

$msi = $_POST['msi'];
$id = $_POST['id'];
$soal = $_POST['soal'];
$a = $_POST['a'];
$b = $_POST['b'];
$c = $_POST['c'];
$d = $_POST['d'];
$e = $_POST['e'];
$j = $_POST['j'];


if ($module=='buat-soal' AND $act=='input'){

  mysqli_query($conn, "INSERT INTO tb_soal(materi_soal_id,soal,a,b,c,d,e,jawaban,tgl,jam) 
	                       VALUES('$id','$soal','$a','$b','$c','$d','$e','$j','$tgl','$jam')");
  header('location:../../pages.php?q='.$module.'&act=lihatsoal&idx='.$id);
}

elseif ($module=='buat-soal' AND $act=='update'){
 
    mysqli_query($conn, "UPDATE tb_soal SET soal   = '$soal',
                                    a   = '$a',
                                    b   = '$b',
                                    c   = '$c',
                                    d   = '$d',
                                    e   = '$e',
                                    jawaban   = '$j'
                           WHERE  soal_id     = '$_POST[id]'");
 
  header('location:../../pages.php?q='.$module.'&act=lihatsoal&idx='.$msi);
}

if ($module=='buat-soal' AND $act=='blokir'){
     mysqli_query($conn, "UPDATE tb_soal SET blokir   = 'y'
                           WHERE  soal_id     = '$_GET[id]'");
  header('location:../../pages.php?q='.$module.'&act=lihatsoal&idx='.$idm);
  }

if ($module=='buat-soal' AND $act=='batal'){
     mysqli_query($conn, "UPDATE tb_soal SET blokir   = 'n'
                           WHERE  soal_id     = '$_GET[id]'");
  header('location:../../pages.php?q='.$module.'&act=lihatsoal&idx='.$idm);
  }

if ($module=='buat-soal' AND $act=='hapus'){
     mysqli_query($conn, "DELETE FROM tb_soal WHERE  soal_id     = '$_GET[id]'");
  header('location:../../pages.php?q='.$module.'&act=lihatsoal&idx='.$idm);
  }

  if ($module=='buat-soal' AND $act=='import'){
        $response = null;
        $_error   = [];
        $data     = null;
        $kolom    = null;

        // die('aaaa');


        if (isset($_FILES['import']))
        {
            $import   = $_FILES['import'];

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
                        'A' => 'soal',
                        'B' => 'a',
                        'C' => 'b',
                        'D' => 'c',
                        'E' => 'd',
                        'F' => 'e',
                        'G' => 'jawaban'
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

                    $no = 0;
                    for ($i=0; $i < count($data); $i++) { 
                        $data[$i]['materi_soal_id'] = $msi;
                        $data[$i]['soal'] = preg_replace('/\s+/', ' ', $data[$i]['soal']);
                        $data[$i]['a'] = preg_replace('/\s+/', ' ', $data[$i]['a']);
                        $data[$i]['b'] = preg_replace('/\s+/', ' ', $data[$i]['b']);
                        $data[$i]['c'] = preg_replace('/\s+/', ' ', $data[$i]['c']);
                        $data[$i]['d'] = preg_replace('/\s+/', ' ', $data[$i]['d']);
                        $data[$i]['e'] = preg_replace('/\s+/', ' ', $data[$i]['e']);
                        $data[$i]['jawaban'] = preg_replace('/\s+/', ' ', $data[$i]['jawaban']);

                        $_data[$i]['soal'] = str_replace(array("'", "<p>","</p>","\n","\r",'"',"alt= "), "", $data[$i]['soal']);
                        $_data[$i]['a'] = str_replace(array("'","<p>","</p>","\n","\r",'"',"alt= "), "", $data[$i]['a']);
                        $_data[$i]['b'] = str_replace(array("'","<p>","</p>","\n","\r",'"',"alt= "), "", $data[$i]['b']);
                        $_data[$i]['c'] = str_replace(array("'","<p>","</p>","\n","\r",'"',"alt= "), "", $data[$i]['c']);
                        $_data[$i]['d'] = str_replace(array("'","<p>","</p>","\n","\r",'"',"alt= "), "", $data[$i]['d']);
                        $_data[$i]['e'] = str_replace(array("'","<p>","</p>","\n","\r",'"',"alt= "), "", $data[$i]['e']);
                        $_data[$i]['jawaban'] = str_replace(array("'","<p>","</p>","\n","\r",'"',"alt= "), "", $data[$i]['jawaban']);

                        $save[$i] = mysqli_query($conn, "INSERT INTO tb_soal(materi_soal_id, soal, 
                                        a, b, c, d, e, jawaban,
                                        tgl,jam) 
                               VALUES('{$data[$i]['materi_soal_id']}','{$_data[$i]['soal']}',
                                    '{$_data[$i]['a']}','{$_data[$i]['b']}','{$_data[$i]['c']}','{$_data[$i]['d']}','{$_data[$i]['e']}','{$_data[$i]['jawaban']}',
                                    '$tgl','$jam')");
                    }

                    if ($save) {
                        header('location:../../pages.php?q='.$module.'&act=lihatsoal&idx='.$msi);
                    }

                } catch (Exception $e) {
                }
            } else {
                echo "ayo mau import file apa?";
            }
        }
    }


}
?>
