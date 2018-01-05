
<?php
  include ('connect.php');

$MaBan =$_POST['MaBan'];


if(($MaBan!="")&&($r=mysql_query("INSERT INTO tbl_ban SET MaBan='$MaBan'",$con)))
{
  // $flag['code']=1;
  echo"Thêm thành công";
}
else echo"Thêm thất bại";

// print(json_encode($flag));
mysql_close($con);

?>
