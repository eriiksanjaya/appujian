  $("#npt").keyup(function(){
    var n = $("#npt").val();
    $.ajax({
    type:"POST",
        url: "viewuac.php",
        data: "n=" + n,
        success: function(data){
      $("#vnpt").html(data);
        }
            
    });
  });

  $("#ernpt").hide();
  
  $("#npt").keyup(function(){
    $("#ernpt").fadeOut(500);
  });

  $("#npt").keyup(function(){
    var p = $("#npt").val();
    $.ajax({
    type:"POST",
        url: "checkuac.php",
        data: "p=" + p,
        success: function(data){
      $("#uac").html(data);
        }
            
    });
  });