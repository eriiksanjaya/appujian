    function pilihan(str){
    var id = str;
    var b = $("#pilihan"+str).val();
   
    $.ajax({
      type: "POST",
      url: "pages/jawab/aksi_jawab.php?id="+id,
      data: "b="+b,
    }).done(function( data ) {
      info.html(data);
      info.fadeOut(10000);
    });
    }



    $('#pilihan'(str)).click(function(){
    var output = $("#output_produk");
    var a = $("#imageInput").val();
    var b = $("#ktg").val();
    var c = $("#ktgs").val();
    var d = $("#pd").val();
    var e = $("#hg").val();
    var f = $("#br").val();
    var g = $("#st").val();
    var h = $("#dk").val();

    $.ajax({
      type: "POST",
      url: "pages/jawab/jawab.php?id="+id,
      data: "a="+a+"&b="+b,
    }).done(function( data ) {
      info.html(data);
      info.fadeOut(2000);
      view_kontak();
    });
    })