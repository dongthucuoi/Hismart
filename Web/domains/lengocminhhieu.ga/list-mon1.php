<link rel="stylesheet" type="text/css" href="css/boostrap.css">
<script type="text/javascript" src="js/home-order.js"></script>
<?php
require ('connect.php');
$idluot=$_POST["idluot"];
?>
<!-- <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/home-ban.js"></script> -->


<?php
if($idluot!="") $tblsttban = mysql_query("SELECT * FROM tbl_order LEFT OUTER JOIN tbl_mon ON tbl_order.ID_Mon = tbl_mon.ID WHERE tbl_order.ID_LuotKhach='$idluot' AND Order_True='0'  ORDER BY TenMon");
else $tblsttban=null;

if($idluot!="") $tbgetidban = mysql_query("SELECT * FROM tbl_luotkhach WHERE ID='$idluot'");
while ($row0 = mysql_fetch_array($tbgetidban)) {
  $idban= $row0["IDBan"];
}

$stt=0;
$tongtien=0;
if(mysql_num_rows($tblsttban) == 0)
{
   // echo "<b>Không có</b>";
   $r=mysql_query("UPDATE tbl_ban SET GoiMon='0' WHERE MaBan='$idban'",$con);
}
else{
  $r=mysql_query("UPDATE tbl_ban SET GoiMon='1' WHERE MaBan='$idban'",$con);
  echo "Danh sách món mới gọi";
  ?>
  <table style="width:100%;" id="tbl-monmoi" idluot="">
  <tr>
  <!-- <th>ID</th> -->
  <th style="width:10%;">STT</th>
  <!-- <th style="width:30%;">Thời gian</th> -->
  <th style="width:50%;">Tên món</th>
  <th style="width:20%;">Giá</th>
  </tr>
  <script type="text/javascript">
      var arr_mon_moi=[];
  </script>
  <?php
  // $arr_mon_moi = Array();

while ($row = mysql_fetch_array($tblsttban)) {
   // $arr_mon_moi[] =$row["ID"];
    // printf ("ID: %s  Tên món: %s", $row["ID"], $row["TenMon"]);
?>
<script type="text/javascript">
  arr_mon_moi.push(<?php echo $row["ID"];?>);
</script>

<tr class="rowban" style="line-height:2;">
<!-- <td><?php echo $row["ID"]; ?></td> -->
<td style="color:#1A3A66;  padding-left:10px; "><?php echo $stt+=1; ?></td>
<!-- <td style="color:#1A3A66;  padding-left:10px; "><?php echo $tgmon=$row["DateTime_Mon"]; ?></td> -->
<td style="color:#1A3A66;  padding-left:10px; "><?php echo $tenmon=$row["TenMon"]; ?></td>
<td style="color:#1A3A66;  padding-left:10px; "><?php echo $giamon=$row["Gia"]; $tongtien=$tongtien+$giamon;?></td>
</tr>

<?php } ?>

</table>
<center>
  <button type="button" class="btn btn-primary" id="add-order" id_luot="<?php echo $idluot; ?>">Nhập món mới</button>
<?php } ?>
<button type="button" class="btn btn-primary"  id="end-order" id_luot="<?php echo $idluot; ?>">Trả bàn</button>
</center>
