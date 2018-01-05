<?php

require('../connect.php');
$id_luot = $_POST['id_luot'];
$tborder= @mysql_query("select * from tbl_order where ID_LuotKhach='$id_luot'");

if(@mysql_num_rows($tborder) == 0)
{
echo "khong co du lieu";
}
else

$rows = array();
while($r = mysql_fetch_assoc($tborder)) {
    $rows[] = $r;
}

$data = array('ORDER' => $rows);
print json_encode($data);

$data2 = json_decode(json_encode($data));

 ?>
