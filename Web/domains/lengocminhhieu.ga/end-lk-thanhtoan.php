
<?php
  include ('connect.php');

$idluot =$_REQUEST['idluot'];

// if(($idluot!="")&&($r=mysql_query("UPDATE tbl_luotkhach SET HoanThanh='1' WHERE ID='$idluot'",$con)))
if($idluot!="")
{
  if($idluot!="") $tbgetidban = mysql_query("SELECT * FROM tbl_luotkhach WHERE ID='$idluot'");
  while ($row0 = mysql_fetch_array($tbgetidban)) {
    $idban= $row0["IDBan"];
  }

  $tblorder = mysql_query("SELECT * FROM tbl_order WHERE ID_LuotKhach='$idluot' AND Order_True='0'");
  if((mysql_num_rows($tblorder) == 0)&&($r=mysql_query("UPDATE tbl_luotkhach SET HoanThanh='1' WHERE ID='$idluot'",$con))&&($r=mysql_query("UPDATE tbl_ban SET ThanhToan='0', CoKhach='0' WHERE MaBan='$idban'",$con))){
    echo"update-checkout-true";
  }
  else echo"update-checkout-false";
}
else echo"update-checkout-false";

// print(json_encode($flag));
mysql_close($con);

?>
