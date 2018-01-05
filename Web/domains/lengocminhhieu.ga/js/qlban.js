
function themban() {

    var ma_ban = document.getElementById("mabanthem").value;
    if(ma_ban !== ""){

            $.ajax({
            type: "POST",
            url: "add_ban.php",
            data:{MaBan:ma_ban },
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


    }else {
        alert("vui lòng điền vào các trường bắt buộc");
    }


}



function btxoa(obj) {
    var idban =$(obj).attr('idtbl');
    var ma_ban=$(obj).attr('maban');

    document.getElementById('modal_xoaban').style.display='block';
    document.getElementById("btxoa_ban_update").value = ''+idban;
    document.getElementById("mabansua").value = ''+ma_ban;

}




function btdelupdate(obj) {
    var idmon = document.getElementById("btxoa_ban_update").value;
    if (idmon !== ""){
        $.post("delete_ban.php",{idmon:idmon},function(data){
            alert(data);
            if(data!==null){
              window.location.reload();
            }
        });


    }
};


function btsua(obj) {
    // alert(tenmon+gia);
      var id_ban=$(obj).attr('idtbl');
      var ma_ban=$(obj).attr('maban');
    document.getElementById('modal_suaban').style.display='block';
    document.getElementById("mabansua").value = ''+ma_ban;
    document.getElementById("btsua_ban_update").value = ''+id_ban;

};


function bteditupdate(obj) {

    var idban=$(obj).val();
    var ma_ban = document.getElementById("mabansua").value;
// alert(idban + "-" + ma_ban);
    if((ma_ban !== "")&&(idban !== "")){

          // alert(data);

            $.ajax({
            type: "POST",
            url: "edit_ban.php",
            data:{MaBan:ma_ban,ID:idban },
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
    else{
      img = "";
      alert("có lỗi");
    }
}
