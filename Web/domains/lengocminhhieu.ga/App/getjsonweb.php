<?php

require('../connect.php');

$tbcuahang= @mysql_query("select * from tbl_cuahang where ID='1'");

if(@mysql_num_rows($tbcuahang) == 0)
{
echo "khong co du lieu";
}
else

$rows = array();
while($r = mysql_fetch_assoc($tbcuahang)) {
    $rows[] = $r;
}

$data = array('AREA' => $rows);
print json_encode($data);

$data2 = json_decode(json_encode($data));

 ?>
