
<?php
  require ("connect.php");


	// $id=$_REQUEST['ID'];
	$idban=$_POST['idtbl'];

	if(($idban!="")&&($r=mysql_query("DELETE FROM tbl_mon WHERE ID='$idban'",$con)))
	{
		// $flag['code']=1;
		echo"Xóa thành công";
	}
	else echo"Xóa thất bại";

	// print(json_encode($flag));
	mysql_close($con);
?>
