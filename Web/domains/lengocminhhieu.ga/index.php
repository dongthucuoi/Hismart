<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Hismart</title>
    <link rel="shortcut icon" href="icon/icon1.png" />
    <link rel="stylesheet" type="text/css" href="css/mycss.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="css/boostrap.css">
    <script type="text/javascript" src="js/home.js"></script>


  </head>
  <body>
<!-- database  -->
    <?php require ('connect.php');?>

    <div class="wrapper ">
      <?php
        include ('module/header.php');
        ?>
        <div class="div-menu">
          <?php $page="home";  include ('module/menu.php'); ?>
        </div>
        <div class="col-md-8 col-md-offset-2" style="border: solid;
            /* border-collapse: separate; */
            border-style: double;
            border-width: 3px;
            border-color: #b7b3b3;
            background-Color:#B7DEFF;">
        <form id="form-filter" >
          <div class="col-md-6">
            Tình trạng:
            <select id="filter-tinhtrang" name="tinhtrang" class="form-control" style="font-weight:bold; color:#F2543B;">
              <option value="1">Có khách</option>
              <option value="0">Trống</option>
              <option value="all">Tất cả</option>
            </select>
          </div>
          <div class="col-md-6">
            Yêu cầu:
              <select id="filter-yeucau" class="form-control" name=""  style="font-weight:bold; color:#F2543B;">
                <option value="all">Tất cả</option>
                <option value="1">Có yêu cầu</option>
                <option value="2">Gọi món</option>
                <option value="3">Thanh toán</option>

              </select>
          </div>
          <div class="col-md-12 clear-fix">
              <br>
          </div>
        </form>
          </div>
        <div class="clearfix" style="padding-bottom:10px;">
          <br>
        </div>

        <div id="list_ban">

        </div>
  <?php
  include ('module/footer.php');
 ?>

<!-- </div> -->

<!-- gọi popup hiển thịcho phép thêm món -->

<div id="modal_themban" class="modal">

  <form  class="modal-content animate" action="/">

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
  <form  class="modal-content animate" action="/">

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
        <button id="btsua_ban_update" class="btn btn-primary form-control" type="button" value="" onclick="bteditupdate(this)">Cập nhật món</button>
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
            <button  class="btn btn-primary form-control" id="btxoa_ban_update" type="button" idtbl="" onclick="btdelupdate(this)">Xóa món này</button>
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


<div id="modal_sttban" class="modal">

  <form  class="modal-content animate" action="/">

    <div class="imgcontainer">
      <span onclick="document.getElementById('modal_sttban').style.display='none'" class="close" title="Close PopUp" style="font-weight:bold; color:red; font-size:25px; opacity: 1!important;">&times;</span>
            <!-- <img src="1.png" alt="Avatar" class="avatar"> -->
      <h4 style="text-align:center"><strong>Thông tin lượt khách</strong></h4>
    </div>

    <div class="dialog_send">
      <form>
        <input id="idban-modal" type="hidden" name="" value="">
        <div id="dsmon0" class="form-group col-md-12">

        </div>
        <div id="dsmon1" class="form-group col-md-12">

        </div>

        <button type="button" class="" onclick="" style="height:0px; background-Color:white; padding:0;cursor: none;border-width:0;"></button>
      </form>

    </div>

  </form>

</div>

<script type="text/javascript">
// Get the modal
var modalsttban = document.getElementById('modal_sttban');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalsttban) {
        modalsttban.style.display = "none";
    }
}
</script>

</body>
</html>
