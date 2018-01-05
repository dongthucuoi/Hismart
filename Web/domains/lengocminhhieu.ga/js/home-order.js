
$( document ).ready(function() {
  $("#add-order").click(function(){
    var listadd="";
    var idluot=$("#add-order").attr("id_luot");
    $("#dsmon1").printThis();
  //   $.each(arr_mon_moi, function(index, value){
  // // $("#result").append(index + ": " + value + '<br>');
  //     // alert(idluot+": "+value);
  //     $.ajax({
  //       type: "POST",
  //       url: "update-lk-mon.php",
  //       data:{idluot:idluot,idmon:value},
  //       success: function(data0){
  //         if(data0!=""){
  //           listadd=listadd+data0+"\n";
  //         }
  //       }
  //     });
  //     if (index === (arr_mon_moi.length - 1)){
  //       alert("Chức năng in order tạm thời chưa hoạt động");
  //     }
  //   });

  });


  $("#end-order").click(function(){
    var idluot=$("#end-order").attr("id_luot");

    $.ajax({
      type: "POST",
      url: "end-lk-thanhtoan.php",
      data:{idluot:idluot},
      success: function(data1){
        if(data1!=""){
          alert(data1);
        }
      }
    });
  });






});
