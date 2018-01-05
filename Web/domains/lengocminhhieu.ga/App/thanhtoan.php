<?php

require('../connect.php');
$idluot =$_REQUEST['idluot'];
$tborder= @mysql_query("select * from tbl_order, tbl_mon where tbl_order.ID_Mon= tbl_mon.ID AND tbl_order.ID_LuotKhach='$idluot'");

if(@mysql_num_rows($tborder) == 0)
{
echo "khong co du lieu";
}
else{
$rows = array();
while($r = mysql_fetch_assoc($tborder)) {
    $rows[] = $r;
}

$data = array('ORDER' => $rows);
print json_encode($data);

$data2 = json_decode(json_encode($data));


$tbgetidban = mysql_query("SELECT * FROM tbl_luotkhach WHERE ID='$idluot'");
while ($row0 = mysql_fetch_array($tbgetidban)) {
  $idban= $row0["IDBan"];
}
$r2=mysql_query("UPDATE tbl_ban SET ThanhToan='1' WHERE MaBan='$idban'",$con);


}
 ?>
