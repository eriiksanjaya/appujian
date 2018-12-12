<?php
    include '../config/koneksi.php';
    include '../config/url.php';
    include '../config/datetime.php';

    // session_start();
    if(empty($_SESSION['siswa_id']) OR $_SESSION['level'] != 'siswa'){
    header("location:$base_url");
    }

    $data = mysqli_query($conn, "SELECT * FROM vw_idset where set_id = '1'");
    $row = mysqli_fetch_assoc($data);

    $siswa = mysqli_query($conn, "SELECT * FROM vw_siswa
    WHERE siswa_id = '$_SESSION[siswa_id]'");
    $img = mysqli_fetch_assoc($siswa);
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <meta name='description' content=''>
        <meta name='author' content=''>
        <link rel='icon' href=''>

        <title><?php echo $row['judul'] ?></title>

        <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/datatable/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/plugins/select2/select2.min.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/ep/style.css">
    </head>

    <?php include'header.php'; ?>
    <?php include'menu.php'; ?>
    <div class="content-wrapper">
        <?php include'content.php'; ?>
        <div class="modal" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Ganti Foto Profil</h4>
                    </div>
                    <div class="modal-body">
                        <form action="pages/fotoprofil/update.php?q=<?php echo $_GET['q'] ?>" method="POST" enctype="multipart/form-data" id="MyUploadFormProfil">
                        <img width='' src="<?php echo $base_url; ?>/imgs/profile/<?php echo $img['foto']; ?>">
                        <input type='hidden' name='img' value='<?php echo $img['foto']; ?>'>
                        <input name="fupload" id="imageInput_profil" type="file" />
                    </div>
                    <div class="modal-footer">
                        <button data-loading-text='Menyimpan...' id='submit-btn_profil' class='btn btn-primary'>Ganti</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include'footer.php'; ?>

    <script src="<?php echo $base_url; ?>/assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>

    <script type="text/javascript">
    // upload foto profil -->
    $(document).ready(function() {
        var options = { 
            target: '#output_profil',   // target element(s) to be updated with server response 
            beforeSubmit: beforeSubmit_profil,  // pre-submit callback 
            success: afterSuccess_profil,  // post-submit callback 
            resetForm: true       // reset the form after successful submit 
        }; 

        $('#MyUploadFormProfil').submit(function() {
            $(this).ajaxSubmit(options);        
            return false; 
        }); 
    }); 

    function afterSuccess_profil()
    {
        $('#submit-btn_profil').show(); //hide submit button
        $('#loading-img_profil').hide(); //hide submit button
    }

    //function to check file size before uploading.
    function beforeSubmit_profil(){
        //check whether browser fully supports all File API
        if (window.File && window.FileReader && window.FileList && window.Blob)
        {
            if( !$('#imageInput_profil').val()) //check empty input filed
            {
                $("#output_profil").html(" Ambil foto profil dulu !");
                return false
            }

            var fsize = $('#imageInput_profil')[0].files[0].size; //get file size
            var ftype = $('#imageInput_profil')[0].files[0].type; // get file type

            //allow only valid image file types 
            switch(ftype)
            {
                case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
                break;
                default:
                $("#output_profil").html("<b>"+ftype+"</b> Tipe file tidak didukung !");
                return false
            }

            //Allowed file size is less than 1 MB (1048576)
            if(fsize>1048576) 
            {
                $("#output_profil").html(" <b>"+ bytesToSize(fsize) +"</b>, Ukuran foto kebesaran ! <br />Silahkan ubah ukuran pixel atau crop menggunakan foto editor.");
                return false
            }

            $('#submit-btn_profil').hide(); //hide submit button
            $('#loading-img_profil').show(); //hide submit button
            $("#output_profil").html("");  
        }
        else
        {
            //Output error to older browsers that do not support HTML5 File API
            $("#output_profil").html("Please upgrade your browser, because your current browser lacks some new features we need!");
            return false;
        }
    }

    //function to format bites bit.ly/19yoIPO
    function bytesToSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }

    </script>

    <script src="<?php echo $base_url; ?>/assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/js/jquery.slimscroll.min.js"></script>

    <script type="text/javascript">
    $(function(){
        $('#item').slimScroll({
        height: '250px'
        });
    });
    </script>

    <script type="text/javascript">
    $(function(){
        $('#page_soal').slimScroll({
            height: '500px'
        });
    });
    </script>


    <script type="text/javascript">
    $(document).ready(function(){
        $("#kelas").change(function(){
            var a = $("#kelas").val();
            $.ajax({
                type: "POST",
                url: "pages/profil/ajax_subkelas.php",
                data: "a=" + a,
                success: function(data){
                    $("#subkelas").html(data);
                }
            });
        });
    });
    </script>

    <script src="<?php echo $base_url; ?>/assets/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/datatable/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>

    <script src="<?php echo $base_url; ?>/assets/lte/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/lte/plugins/select2/select2.full.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/lte/dist/js/app.min.js"></script>
    </body>
</html>