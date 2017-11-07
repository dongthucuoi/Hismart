
<?php
  include ('connect.php');



if ($_POST['them']= "them") {

$IDCH =$_POST['IDCH'];
$TenMon=$_POST['TenMon'];
$Gia=$_POST['Gia'];
$img=trim($_POST['img']);

if(($IDCH!="")&&($TenMon!="")&&($Gia!="")&&($img!="")&&($r=mysql_query("INSERT INTO tbl_mon SET IDCH='$IDCH', TenMon='$TenMon', Gia='$Gia', ImgUrl='$img'",$con)))
{
  // $flag['code']=1;
  echo"Thêm thành công";
}
else echo"Thêm thất bại";

// print(json_encode($flag));
mysql_close($con);


}





?>
