<?php
session_start();
 if (empty($_SESSION['admin_id'])){
  echo "string";
}
else{

    include "../../../config/koneksi.php";
    include "../../../config/datetime.php";
    include "../../../vendor/autoload.php";

    $module=$_GET['q'];
    $act=$_GET['act'];

    if ($module=='guru' AND $act=='input'){

      $cek = mysqli_query($conn, "SELECT * FROM tb_guru where nip = '$_POST[nip]'");
      if(mysqli_num_rows($cek)>=1){
        die("Nip sudah digunakan !");
      }
    	
      $pass=md5($_POST['password']);
      mysqli_query($conn, "INSERT INTO tb_guru(	nip, 
                                     	pass,
                                     	nama,
                                     	kelamin,tgl,jam) 
    	                       VALUES('$_POST[nip]',
                                    '$pass',
                                    '$_POST[nama_guru]',
                                    '$_POST[kelamin]','$tgl','$jam')");
      header('location:../../pages.php?q='.$module);
     
    }

    elseif ($module=='guru' AND $act=='update'){
         $pass=md5($_POST['password']);
        mysqli_query($conn, "UPDATE tb_guru SET pass = '$pass'  
                               WHERE guru_id      = '$_POST[id]'");
      header('location:../../pages.php?q='.$module);
    }



elseif ($module=='guru' AND $act=='hapus'){
 
    mysqli_query($conn, "DELETE FROM tb_guru
                           WHERE  guru_id     = '$_GET[id]'");
 
  header('location:../../pages.php?q='.$module);
}


    if ($module=='guru' AND $act=='blokir'){
         mysqli_query($conn, "UPDATE tb_guru SET blokir = 'y'  
                               WHERE guru_id      = '$_GET[id]'");
      header('location:../../pages.php?q='.$module);

      }


    if ($module=='guru' AND $act=='batal'){
         mysqli_query($conn, "UPDATE tb_guru SET blokir = 'n'  
                               WHERE guru_id      = '$_GET[id]'");
      header('location:../../pages.php?q='.$module);

      }


    if ($module=='guru' AND $act=='import'){
        $response = null;
        $_error   = [];
        $data     = null;
        $kolom    = null;

        // die('aaaa');


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
                        'A' => 'nip',
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
                        $data[$i]['nip'] = $data[$i]['nip'];
                        $data[$i]['nama'] = $data[$i]['nama'];
                        $data[$i]['kelamin'] = $data[$i]['kelamin'];
                        $data[$i]['pass'] = ($data[$i]['pass'] != "") ? md5($data[$i]['pass']) : md5('admin');

                        $cek = mysqli_query($conn, "SELECT * FROM tb_guru where nip = '{$data[$i]['nip']}'");
                        if(mysqli_num_rows($cek)>=1){
                            die("Nip {$data[$i]['nip']} sudah digunakan !");
                        }

                        $save[$i] = mysqli_query($conn, "INSERT INTO tb_guru(   nip, 
                                        nama,
                                        kelamin,
                                        pass,tgl,jam) 
                               VALUES('{$data[$i]['nip']}',
                                    '{$data[$i]['nama']}',
                                    '{$data[$i]['kelamin']}','{$data[$i]['pass']}',
                                    '$tgl','$jam')");
                    }

                    if ($save) {
                        header('location:../../pages.php?q='.$module);
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
