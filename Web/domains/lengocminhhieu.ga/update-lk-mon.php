
<?php
  include ('connect.php');

$idluot =$_POST['idluot'];
$idmon=$_POST['idmon'];

if(($idluot!="")&&($idmon!="")&&($r=mysql_query("UPDATE tbl_order SET Order_True='1' WHERE ID_LuotKhach='$idluot' AND ID_Mon='$idmon'",$con)))
{
  // $flag['code']=1;
  echo"update-order-true";
}
else echo"update-order-false";

// print(json_encode($flag));
mysql_close($con);

?>
