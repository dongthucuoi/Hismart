<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Hismart</title>
    <link rel="shortcut icon" href="icon/icon1.png" />
    <link rel="stylesheet" type="text/css" href="css/mycss.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="css/boostrap.css">
    <script type="text/javascript" src="js/qlban.js"></script>


  </head>
  <body>
<!-- database  -->
    <?php require ('connect.php');?>

    <div class="wrapper ">
      <?php
        include ('module/header.php');
        ?>
        <div class="div-menu">
          <?php  $page="ql-ban"; include ('module/menu.php'); ?>
        </div>
        <div class="col-md-4 col-md-offset-4">
          <button id="btthem" onclick="document.getElementById('modal_themban').style.display='block'" > <strong>Thêm bàn</strong></button>
        </div>
        <table style="width:100%;">
      <tr>
        <!-- <th>ID</th> -->
        <th style="width:5%;">STT</th>
        <th style="width:65%;">Mã bàn</th>
        <th style="width:30%;">Hành động</th>
      </tr>

      <?php
      $tblban = mysql_query("select * from tbl_ban");
        $stt=0;
        if(mysql_num_rows($tblban) == 0)
        {
           echo "No data";
        }
        else
        while ($row = mysql_fetch_array($tblban)) {
            // printf ("ID: %s  Tên món: %s", $row["ID"], $row["TenMon"]);

       ?>

      <tr>
        <!-- <td><?php echo $row["ID"]; ?></td> -->
        <td style="font-weight:bold; color:#1A3A66;  padding-left:10px;"><?php echo $stt+=1; ?></td>
        <td style="font-weight:bold; color:#1A3A66;  padding-left:10px;"><?php echo $row["MaBan"]; ?></td>
        <td style="text-align:center;">
          <!-- <a target="_blank" href="chitiet-ban.php?idban=<?php echo $row["ID"]; ?>"><button  type="button" class="btn btn-default" idtbl="<?php  echo $row["ID"];  ?>" maban="<?php echo $row["MaBan"]; ?>">Xem</button></a> -->
          <button  type="button" class="btn btn-default" idtbl="<?php  echo $row["ID"];  ?>" maban="<?php echo $row["MaBan"]; ?>"  onclick="btsua(this)">Sửa</button>
          <button type="button" class="btn btn-default" idtbl="<?php  echo $row["ID"];  ?>" maban="<?php echo $row["MaBan"]; ?>"  onclick="btxoa(this)">Xóa</button>
        </td>
      </tr>

    <?php } ?>

    </table>
  <?php
  include ('module/footer.php');
 ?>

</div>

<!-- gọi popup hiển thịcho phép thêm món -->

<div id="modal_themban" class="modal">

  <form  class="modal-content animate" >

    <div class="imgcontainer">
      <span onclick="document.getElementById('modal_themban').style.display='none'" class="close" title="Close PopUp" style="font-weight:bold; color:red; font-size:25px; opacity: 1!important;">&times;</span>
            <!-- <img src="1.png" alt="Avatar" class="avatar"> -->
      <h4 style="text-align:center"><strong>Menu Thêm bàn</strong></h4>
    </div>

    <div class="dialog_send">
      <form>
        <div class="form-group col-md-8">
          <label >Mã bàn:</label>
          <input type="text" class="form-control" id="mabanthem">
        </div>
        <button type="button" class="btn btn-primary form-control" onclick="themban()">Thêm</button>
      </form>

    </div>

  </form>

</div>

<!-- sửa món modal -->
<div id="modal_suaban" class="modal" >
  <form  class="modal-content animate" >

    <div class="imgcontainer">
      <span onclick="document.getElementById('modal_suaban').style.display='none'" class="close" title="Close PopUp" style="font-weight:bold; color:red; font-size:25px; opacity: 1!important;">&times;</span>
            <!-- <img src="1.png" alt="Avatar" class="avatar"> -->
      <h4 style="text-align:center"><strong>Sửa bàn</strong></h4>
    </div>

    <div class="dialog_send">
      <form>
        <div class="form-group col-md-8">
          <label >Mã bàn:</label>
          <input type="text" class="form-control" id="mabansua">
        </div>
        <button id="btsua_ban_update" class="btn btn-primary form-control" type="button" value="" onclick="bteditupdate(this)">Cập nhật bàn</button>
      </form>
    </div>
  </form>
</div>

<!-- modal popup xóa món  -->
<div id="modal_xoaban" class="modal">
  <form  class="modal-content animate" action="/">
    <div class="imgcontainer">
      <span onclick="document.getElementById('modal_xoaban').style.display='none'" class="close" title="Close PopUp" style="font-weight:bold; color:red; font-size:25px; opacity: 1!important;">&times;</span>
      <h4 style="text-align:center"><strong>Xóa bàn</strong></h4>
    </div>

    <div class="dialog_send">
      <form class="" action="" method="">
          <div class="form-group">
            <h3><label id="mabanxoa" type="text" placeholder="Mã bàn" name="TenBan"></label></h3>
            <button  class="btn btn-primary form-control" id="btxoa_ban_update" type="button" idtbl="" onclick="btdelupdate(this)">Xóa bàn này</button>
          </div>
      </form>
    </div>

  </form>

</div>

<script type="text/javascript">
// Get the modal
var modaladd = document.getElementById('modal_themban');
var modaledit = document.getElementById('modal_suaban');
var modaldelete = document.getElementById('modal_xoaban');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modaladd) {
        modaladd.style.display = "none";
    }
    if (event.target == modaledit) {
        modaledit.style.display = "none";
    }
    if (event.target == modaldelete) {
        modaldelete.style.display = "none";
    }
}
</script>



</body>
</html>
