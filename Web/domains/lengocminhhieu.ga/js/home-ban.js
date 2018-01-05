$( document ).ready(function() {

  $(".bt-sttban" ).click(function() {
    // alert("bt-sttban");
    var idluot=$(this).attr("idluot");
    $('#idban-modal').val(idluot);
    $.ajax({
      type: "POST",
      url: "list-mon0.php",
      data:{idluot:idluot},
      success: function(data0){
        $("#dsmon0").html(data0);
      }
    });
    $.ajax({
      type: "POST",
      url: "list-mon1.php",
      data:{idluot:idluot},
      success: function(data1){
        $("#dsmon1").html(data1);
      }
    });
  });

  if($('#modal_sttban').is(':visible')){
    setInterval(function(){
      var idluot = $('#idban-modal').val();
      // alert(idluot);
      $.ajax({
        type: "POST",
        url: "list-mon0.php",
        data:{idluot:idluot},
        success: function(data0){
          $("#dsmon0").html(data0);
        }
      });

      $.ajax({
        type: "POST",
        url: "list-mon1.php",
        data:{idluot:idluot},
        success: function(data1){
          $("#dsmon1").html(data1);
        }
      });
    }, 5000);
  };



  var arr = ["#f00","#0f0","#00f"];
  function changeColor(){
     $(".bt-sttban1").css({
          backgroundColor : arr[parseInt(Math.random() * 3)]
        });
  }
  changeColor();
  setInterval(changeColor,3000);







});
