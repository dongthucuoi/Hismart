<?php

include('../connect.php');
$Time= new DateTime();
$Time->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
$Time=$Time->format('Y-m-d H:i:s');
$idluot = $_POST['id_luot'];
$idmon = $_POST['id_mon'];

$file = 'mylog.log';
$ip_client = $_SERVER['REMOTE_ADDR'];
$content = $Time." ".$ip_client." "."id_luot=".$idluot." "."id_mon=".$idmon."\n";
file_put_contents($file, $content , FILE_APPEND | LOCK_EX);

  if(($idluot!="")&&($idmon!="")&&($Time!="")&&($r=@mysql_query("INSERT INTO tbl_order SET ID_LuotKhach='$idluot', ID_Mon='$idmon', DateTime_Mon='$Time'",$con))){
  echo"order-true";

  $tbgetidban = mysql_query("SELECT * FROM tbl_luotkhach WHERE ID='$idluot'");
  while ($row0 = mysql_fetch_array($tbgetidban)) {
    $idban= $row0["IDBan"];
  }
  $r2=mysql_query("UPDATE tbl_ban SET GoiMon='1' WHERE MaBan='$idban'",$con);

}
else echo"order-false";
// print(json_encode($flag));
mysql_close($con);
 ?>
