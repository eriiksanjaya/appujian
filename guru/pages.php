<?php
include '../config/koneksi.php';
include '../config/url.php';
include '../config/fungsi_indotgl.php';
include '../config/datetime.php';
include '../config/class_paging.php';

session_start();
if(empty($_SESSION['guru_id']) OR $_SESSION['level'] != 'guru'){
  header("location:$base_url");
}
$data = mysqli_query($conn, "SELECT * FROM vw_idset where set_id = '1'");
$row = mysqli_fetch_assoc($data);
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
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/lte/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>/assets/ep/style.css">

</head>

<?php include'header.php'; ?>
<?php include'menu.php'; ?>
  <div class="content-wrapper">
    <?php include'content.php'; ?>
  </div>
<?php include'footer.php'; ?>


<script src="<?php echo $base_url; ?>/assets/lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/datatable/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script src="<?php echo $base_url; ?>/assets/lte/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/lte/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo $base_url; ?>/assets/lte/dist/js/app.min.js"></script>

<script type="text/javascript">
 $(document).ready(function(){
  $("#mp").change(function(){
    var a = $("#mp").val();
    $.ajax({
        type: "POST",
        url: "pages/aktifkansoal/ajax_materi.php",
        data: "a=" + a,
        success: function(data){
            $("#msid").html(data);
        }
    });
  });
});
</script>


<script src="<?php echo $base_url; ?>/assets/js/ckeditor/ckeditor.js"></script>
<script src="<?php echo $base_url; ?>/assets/js/ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
/*$( document ).ready( function() {
    $( 'textarea#editor' ).ckeditor();
    CKEDITOR.inline( 'a');
    CKEDITOR.inline( 'b');
    CKEDITOR.inline( 'c');
    CKEDITOR.inline( 'd');
    CKEDITOR.inline( 'e');
} );*/

var url = '<?php echo $base_url; ?>';
var data = {
    'filebrowserBrowseUrl': url+'/ckfinder/ckfinder.html',
    'filebrowserUploadUrl': url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
}

function ckfinder(tipe, id) {
    if(tipe == 'replace') {
        CKEDITOR.replace(id, data);
    } else {
        CKEDITOR.inline(id, data);
    }
}

CKEDITOR.disableAutoInline = true;
ckfinder('replace','editor');
$('.pilihan').each(function(index, el) {
    var id = $(this).find('textarea').attr('id');
    ckfinder('inline',id);
});

</script>

<script src="<?php echo $base_url; ?>/assets/lte/dist/js/app.min.js"></script>