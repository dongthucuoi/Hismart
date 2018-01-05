<?php

require('../connect.php');

$id_ban = $_POST['id_ban'];
$tb_dsban= @mysql_query("select * from tbl_ban where MaBan='$id_ban'");
$tb_dsban2= @mysql_query("select * from tbl_ban where MaBan='$id_ban' and CoKhach='0'");
if(@mysql_num_rows($tb_dsban) == 0)
{
echo "QR-false";
}
else {
  if(@mysql_num_rows($tb_dsban2) == 0){
    echo "id_ban-false";
  }
  else {
  $Time= new DateTime();
  $Time->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
  $TimeLK=$Time->format('Y-m-d H:i:s');
  if(($r1=mysql_query("UPDATE tbl_ban SET CoKhach='1' WHERE MaBan='$id_ban'",$con))&&($r2=mysql_query("INSERT INTO tbl_luotkhach SET IDBan='$id_ban', DateTime_LK='$TimeLK'",$con))){
    $tb_luotkhach= @mysql_query("select * from tbl_luotkhach where DateTime_LK='$TimeLK'");
    if(@mysql_num_rows($tb_dsban) == 0)
    {
    echo "booking-false";
    }
    else{
       while($luotkhach_item = mysql_fetch_array($tb_luotkhach)){
         $id_luot=$luotkhach_item[ID];
       }
      echo $id_luot.",id_ban-successful";
    }

  }

  }
}
 ?>
