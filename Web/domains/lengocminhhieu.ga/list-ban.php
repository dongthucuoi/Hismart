<?php
require ('connect.php');
$tinhtrang=$_GET["tinhtrang"];
$yeucau=$_GET["yeucau"];
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/home-ban.js"></script>
<table style="width:100%;">
<tr>
<!-- <th>ID</th> -->
<th style="width:10%;">STT</th>
<th style="width:60%;">Mã bàn</th>
<th style="width:30%;">Yêu cầu</th>
</tr>

<?php
/* tinh trang co 3 value ; yeu cau co 4 value
==>12TH
  all all
  all 1
  all 2
  all 3
  1 all
  1 1
  1 2
  1 3
  0 all
  0 1 -khong xay ra
  0 2 -khong xay ra
  0 3 -khong xay ra
*/
if(($tinhtrang=="all")&&($yeucau=="all"))$tblban = mysql_query("SELECT * FROM tbl_ban");
elseif(($tinhtrang=="all")&&($yeucau=="1"))$tblban = mysql_query("SELECT * FROM tbl_ban WHERE GoiMon='1' OR ThanhToan='1'");
elseif(($tinhtrang=="all")&&($yeucau=="2"))$tblban = mysql_query("SELECT * FROM tbl_ban WHERE GoiMon='1'");
elseif(($tinhtrang=="all")&&($yeucau=="3"))$tblban = mysql_query("SELECT * FROM tbl_ban WHERE ThanhToan='1'");
elseif(($tinhtrang=="1")&&($yeucau=="all"))$tblban = mysql_query("SELECT * FROM tbl_ban WHERE CoKhach='1'");
elseif(($tinhtrang=="1")&&($yeucau=="1"))$tblban = mysql_query("SELECT * FROM tbl_ban WHERE CoKhach='1' AND  GoiMon='1' OR ThanhToan='1'");
elseif(($tinhtrang=="1")&&($yeucau=="2"))$tblban = mysql_query("SELECT * FROM tbl_ban WHERE CoKhach='1' AND  GoiMon='1'");
elseif(($tinhtrang=="1")&&($yeucau=="3"))$tblban = mysql_query("SELECT * FROM tbl_ban WHERE CoKhach='1' AND ThanhToan='1'");
elseif(($tinhtrang=="0")&&($yeucau=="all"))$tblban = mysql_query("SELECT * FROM tbl_ban WHERE CoKhach='0'");
else $tblban=null;

// switch ($tinhtrang) {
//     case "all":
//         $tblban = mysql_query("SELECT * FROM tbl_ban");
//         break;
//     case "0":
//         $tblban = mysql_query("SELECT * FROM tbl_ban WHERE CoKhach='0'");
//         break;
//     case "1":
//         $tblban = mysql_query("SELECT * FROM tbl_ban WHERE CoKhach='1'");
//         break;
//     default:
//         $tblban=null;
// }


$stt=0;
if(mysql_num_rows($tblban) == 0)
{
   echo "No data";
}
else
while ($row = mysql_fetch_array($tblban)) {
    // printf ("ID: %s  Tên món: %s", $row["ID"], $row["TenMon"]);

?>

<tr class="rowban" style="line-height:2; background-color:<?php if($row["CoKhach"]==1) echo "green"; else echo "white" ?>;">
<!-- <td><?php echo $row["ID"]; ?></td> -->
<td style="font-weight:bold; color:#1A3A66;  padding-left:10px; color:<?php if($row["CoKhach"]==1) echo "yellow"; ?>"><?php echo $stt+=1; ?></td>
<td style="font-weight:bold; color:#1A3A66;  padding-left:10px; color:<?php if($row["CoKhach"]==1) echo "yellow"; ?>"><?php echo $maban=$row["MaBan"]; ?></td>
<td style="text-align:center;">
  <?php
  $tblluotkhach = mysql_query("SELECT * FROM tbl_luotkhach WHERE IDBan='$maban' AND HoanThanh='0' ORDER BY ID DESC LIMIT 1");
  if(mysql_num_rows($tblluotkhach) != 0)
  {
    while ($row2 = mysql_fetch_array($tblluotkhach)) {
    ?>
    <?php if((($row["GoiMon"]==0)&&($row["ThanhToan"]==0))&&($row["CoKhach"]==1)){?>
      <button  type="button" class="btn btn-default btn-xs bt-sttban" idluot="<?php  echo $row2["ID"];  ?>" maban="<?php echo $row["MaBan"]; ?>"  onclick="document.getElementById('modal_sttban').style.display='block'">Xem</button>
    <?php } ?>
  <?php if(($row["GoiMon"]==1)&&($row["CoKhach"]==1)){?>
    <button  type="button" class="btn btn-default btn-xs bt-sttban bt-sttban1" idluot="<?php  echo $row2["ID"];  ?>" maban="<?php echo $row["MaBan"]; ?>"  onclick="document.getElementById('modal_sttban').style.display='block'"  style="color:white;">Gọi món</button>
  <?php } ?>
  <?php if(($row["ThanhToan"]==1)&&($row["CoKhach"]==1)){?>
  <button type="button" class="btn btn-default btn-xs bt-sttban bt-sttban1" idluot="<?php  echo $row2["ID"];  ?>" maban="<?php echo $row["MaBan"]; ?>"  onclick="document.getElementById('modal_sttban').style.display='block'" style="color:white;">Thanh toán</button>
<?php } } ?>
<?php } ?>
</td>
</tr>

<?php } ?>

</table>
