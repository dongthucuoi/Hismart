<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Hismart</title>
    <link rel="shortcut icon" href="icon/icon1.png" />
    <link rel="stylesheet" type="text/css" href="css/mycss.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="css/boostrap.css">
    <script type="text/javascript" src="js/qlmon.js"></script>


  </head>
  <body>
<!-- database  -->
    <?php require ('connect.php');?>

    <div class="wrapper ">
      <?php
        include ('module/header.php');
        ?>
        <div class="div-menu">
          <?php $page="ql-mon"; include ('module/menu.php'); ?>
        </div>
        <div class="col-md-4 col-md-offset-4">
          <button id="btthem" onclick="document.getElementById('modal_themmon').style.display='block'" > <strong>Thêm món</strong></button>
        </div>
        <table style="width:100%;">
      <tr>
        <!-- <th>ID</th> -->
        <th style="width:5%;">STT</th>
        <th style="width:35%;">Tên món</th>
        <th style="width:20%;">Hình</th>
        <th style="width:20%;">Giá</th>
        <th style="width:20%;">Hành động</th>
      </tr>

      <?php
      $tblmon = mysql_query("select * from tbl_mon");
      $stt=0;
        if(mysql_num_rows($tblmon) == 0)
        {
           echo "No data";
        }
        else
        while ($row = mysql_fetch_array($tblmon)) {
            // printf ("ID: %s  Tên món: %s", $row["ID"], $row["TenMon"]);

       ?>

      <tr>
        <!-- <td><?php echo $row["ID"]; ?></td> -->
        <td style="font-weight:bold; color:#1A3A66;  padding-left:10px;"><?php echo $stt+=1; ?></td>
        <td style="font-weight:bold; color:#1A3A66;  padding-left:10px;"><?php echo $row["TenMon"]; ?></td>
        <td style="padding:10px;"><center> <img src="<?php echo $row["ImgUrl"]; ?>" alt="" width="80" height="80"></center></td>
        <td style="text-align:right;font-weight:bold; color:red; font-size:18px; padding-right:10px;"><?php echo $row["Gia"]." VNĐ"; ?></td>
        <td style="text-align:center;">
          <button  type="button" class="btn btn-default" idmon="<?php  echo $row["ID"];  ?>" tenmon="<?php echo $row["TenMon"]; ?>" gia="<?php echo $row["Gia"]; ?>" img="<?php echo $row["ImgUrl"];?>" onclick="btsua(this)">Sửa</button>
          <button type="button" class="btn btn-default" idmon="<?php  echo $row["ID"];  ?>" tenmon="<?php echo $row["TenMon"]; ?>"  onclick="btxoa(this)">Xóa</button>
        </td>
      </tr>

    <?php } ?>

    </table>
  <?php
  include ('module/footer.php');
 ?>

</div>

<!-- gọi popup hiển thịcho phép thêm món -->

<div id="modal_themmon" class="modal">

  <form  class="modal-content animate" action="/">

    <div class="imgcontainer">
      <span onclick="document.getElementById('modal_themmon').style.display='none'" class="close" title="Close PopUp" style="font-weight:bold; color:red; font-size:25px; opacity: 1!important;">&times;</span>
            <!-- <img src="1.png" alt="Avatar" class="avatar"> -->
      <h4 style="text-align:center"><strong>Menu Thêm món</strong></h4>
    </div>

    <div class="dialog_send">
      <form>
        <div class="form-group col-md-8">
          <label >Tên món:</label>
          <input type="text" class="form-control" id="tenmonthem">
        </div>
        <div class="form-group col-md-4">
          <label >Giá:</label>
          <input type="number" class="form-control" id="gianhap">
        </div>
        <div class="form-group col-md-12">
          <label><b>Hình ảnh:</b></label><br>
          <center>
            <img id="addmonimg0" src="" alt="" width="200px" height="200px"><br>
          </center>
          <label>Chọn hình:</label>
          <input id="addimgmon"  type="file" class="form-control" name="imgmon" value="" accept="image/png,image/jpeg" onchange="readURLadd(this)">
        </div>
        <button type="button" class="btn btn-primary form-control" onclick="themmon()">Thêm</button>
      </form>

    </div>

  </form>

</div>

<!-- sửa món modal -->
<div id="modal_suamon" class="modal" >
  <form  class="modal-content animate" action="/">

    <div class="imgcontainer">
      <span onclick="document.getElementById('modal_suamon').style.display='none'" class="close" title="Close PopUp" style="font-weight:bold; color:red; font-size:25px; opacity: 1!important;">&times;</span>
            <!-- <img src="1.png" alt="Avatar" class="avatar"> -->
      <h4 style="text-align:center"><strong>Sửa món</strong></h4>
    </div>

    <div class="dialog_send">
      <form>
        <div class="form-group col-md-8">
          <label >Tên món:</label>
          <input type="text" class="form-control" id="tenmonupdate">
        </div>
        <div class="form-group col-md-4">
          <label >Giá:</label>
          <input type="number" class="form-control" id="giaupdate">
        </div>
        <div class="form-group col-md-12">
          <label><b>Hình ảnh:</b></label><br>
          <center>
            <img id="edtmonimg0" src="" alt="" width="200px" height="200px"><br>
          </center>
          <label>Chọn hình:</label>
          <input id="edtimgmon"  type="file" class="form-control" value="" accept="image/png,image/jpeg" onchange="readURLedit(this)">
        </div>
        <button id="btsua_mon_update" class="btn btn-primary form-control" type="button" value="" onclick="bteditupdate(this)">Cập nhật món</button>
      </form>
    </div>
  </form>
</div>

<!-- modal popup xóa món  -->
<div id="modal_xoamon" class="modal">
  <form  class="modal-content animate" action="/">
    <div class="imgcontainer">
      <span onclick="document.getElementById('modal_xoamon').style.display='none'" class="close" title="Close PopUp" style="font-weight:bold; color:red; font-size:25px; opacity: 1!important;">&times;</span>
      <h4 style="text-align:center"><strong>Xóa món</strong></h4>
    </div>

    <div class="dialog_send">
      <form class="" action="index.html" method="post">
          <div class="form-group">
            <h3><label id="TenMonxoa" type="text" placeholder="Tên món" name="TenMon"></label></h3>
            <button  class="btn btn-primary form-control" id="btxoa_mon_update" type="button" idmon="" onclick="btdelupdate(this)">Xóa món này</button>
          </div>
      </form>
    </div>

  </form>

</div>

<script type="text/javascript">
// Get the modal
var modaladd = document.getElementById('modal_themmon');
var modaledit = document.getElementById('modal_suamon');
var modaldelete = document.getElementById('modal_xoamon');
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
