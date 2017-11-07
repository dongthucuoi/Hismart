

function themmon() {
    var id_ch = '1';
    var ten_mon = document.getElementById("tenmonthem").value;
    var gia = document.getElementById("gianhap").value;
    var img = $('#addimgmon').val().split('\\').pop();
    // alert(img);
    if((img!=="")&&(id_ch !== "")&&(ten_mon !== "")&&(gia !== "")){
      img = "http://lengocminhhieu.ga/upload/"+img;
      var dataimg = new FormData();

      $.each($('#addimgmon')[0].files, function(i, file) {
          dataimg.append('img', file);
      });

      $.ajax({
        url: 'upimg.php',
        data: dataimg,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
          // alert(data);
          if(data.trim()=="upimg-true"){
            $.ajax({
            type: "POST",
            url: "add_mon.php",
            data:{IDCH:id_ch,TenMon:ten_mon,Gia:gia, img:img },
            success: function(data){
              if(data.trim()=="Thêm thành công"){
                alert(data);
                if(data!==null){
                  window.location.reload();
                }
              }
              else {
              alert(data);
              }
            }
          });
          }
        }
      });
    }
    else{
      img = "";
      alert("Chưa nhập đủ thông tin hoặc chưa up hình món ăn");
    }

}



function btxoa(obj) {
    var idmon=$(obj).attr('idmon');
    var tenmon=$(obj).attr('tenmon');

    document.getElementById('modal_xoamon').style.display='block';
    document.getElementById("btxoa_mon_update").value = ''+idmon;
    document.getElementById("TenMonxoa").innerHTML = tenmon;
}




function btdelupdate(obj) {
    var idmon = document.getElementById("btxoa_mon_update").value;
    if (idmon !== ""){
        $.post("delete_mon.php",{idmon:idmon},function(data){
            alert(data);
            if(data!==null){
              window.location.reload();
            }
        });


    }
};


function btsua(obj) {
    var idmon=$(obj).attr('idmon');
    var id_ch= '1';
    var tenmon=$(obj).attr('tenmon');
    var gia=$(obj).attr('gia');
    var img=$(obj).attr('img');
    // alert(tenmon+gia);
    $('#edtmonimg0').attr('src', img).width(200).height(200);
    document.getElementById('modal_suamon').style.display='block';
    document.getElementById("tenmonupdate").value = ''+tenmon;
    document.getElementById("giaupdate").value = ''+gia;
    document.getElementById("btsua_mon_update").value = ''+idmon;

};


function bteditupdate(obj) {

    var idmon = $(obj).attr("value");
    var ten_mon = document.getElementById("tenmonupdate").value;
    var gia = document.getElementById("giaupdate").value;
    var id_ch ='1';
    // alert(idmon);



    var img = $('#edtimgmon').val().split('\\').pop();
    // alert(img);
    if((idmon !=="")&&(img!=="")&&(id_ch !== "")&&(ten_mon !== "")&&(gia !== "")){
      img = "http://lengocminhhieu.ga/upload/"+img;
      var dataimg = new FormData();

      $.each($('#edtimgmon')[0].files, function(i, file) {
          dataimg.append('img', file);
      });

      $.ajax({
        url: 'upimg.php',
        data: dataimg,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
          // alert(data);
          if(data.trim()=="upimg-true"){
            $.ajax({
            type: "POST",
            url: "edit_mon.php",
            data:{IDCH:id_ch,ID:idmon, TenMon:ten_mon,Gia:gia,img:img },
            success: function(data){
              if(data.trim()=="Cập nhật thành công"){
                alert(data);
                if(data!==null){
                  window.location.reload();
                }
              }
              else {
              alert(data);
              }
            }
          });
          }
        }
      });
    }
    else{
      img = "";
      alert("Chưa nhập đủ thông tin hoặc chưa up hình món ăn");
    }
}


function readURLadd(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#addmonimg0')
              .attr('src', e.target.result)
              .width(200)
              .height(200);
      };

      reader.readAsDataURL(input.files[0]);
  }
}

function readURLedit(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#edtmonimg0')
              .attr('src', e.target.result)
              .width(200)
              .height(200);
      };

      reader.readAsDataURL(input.files[0]);
  }
}
