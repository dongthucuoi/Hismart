<?php
require ('connect.php');
$idluot=$_POST["idluot"];
if($idluot!="")$tblban=mysql_query("SELECT * FROM tbl_luotkhach WHERE ID='$idluot'");
$rowban = mysql_fetch_row($tblban);
echo "<b>Mã bàn: ".$rowban[1]."</b>";
echo "<br>";
echo "Danh sách món đã gọi";
?>
<!-- <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/home-ban.js"></script> -->
<table style="width:100%;">
<tr>
<!-- <th>ID</th> -->
<th style="width:10%;">STT</th>
<th style="width:30%;">Thời gian</th>
<th style="width:40%;">Tên món</th>
<th style="width:20%;">Giá</th>
</tr>

<?php
if($idluot!="")$tblsttban = mysql_query("SELECT * FROM tbl_order LEFT OUTER JOIN tbl_mon ON tbl_order.ID_Mon = tbl_mon.ID WHERE tbl_order.ID_LuotKhach='$idluot' AND Order_True='1' ORDER BY DateTime_Mon");

else $tblsttban=null;


$stt=0;
$tongtien=0;
if(mysql_num_rows($tblsttban) == 0)
{
    echo "<b>Không có</b>";
}
else
while ($row = mysql_fetch_array($tblsttban)) {
    // printf ("ID: %s  Tên món: %s", $row["ID"], $row["TenMon"]);

?>

<tr class="rowban" style="line-height:2;">
<!-- <td><?php echo $row["ID"]; ?></td> -->
<td style="color:#1A3A66;  padding-left:10px; "><?php echo $stt+=1; ?></td>
<td style="color:#1A3A66;  padding-left:10px; "><?php echo $tgmon=$row["DateTime_Mon"]; ?></td>
<td style="color:#1A3A66;  padding-left:10px; "><?php echo $tenmon=$row["TenMon"]; ?></td>
<td style="color:#1A3A66;  padding-left:10px; "><?php echo $giamon=$row["Gia"]; $tongtien=$tongtien+$giamon;?></td>
</tr>

<?php } ?>
<tr class="rowban" style="line-height:2;">
<td colspan="3" style="font-weight:bold;  padding-left:10px; text-align:center;">Tổng tiền</td>
<td style="font-weight:bold; color:red;  padding-left:10px; "><?php echo $tongtien; ?></td>
</tr>

</table>
