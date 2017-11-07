
<?php
  require ("connect.php");


	// $id=$_REQUEST['ID'];
	$id_mon=$_POST['idmon'];

	if(($id_mon!="")&&($r=mysql_query("DELETE FROM tbl_mon WHERE ID='$id_mon'",$con)))
	{
		// $flag['code']=1;
		echo"Xóa thành công";
	}
	else echo"Xóa thất bại";

	// print(json_encode($flag));
	mysql_close($con);
?>
