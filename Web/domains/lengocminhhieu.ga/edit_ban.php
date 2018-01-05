
    <?php
  require ("connect.php");




      $idban=$_POST['ID'];
      $maban=$_POST['MaBan'];



    	if(($idban!="")&&($maban!="")&&($r=mysql_query("UPDATE tbl_ban SET MaBan='$maban' WHERE ID='$idban'",$con)))
    	{
    		// $flag['code']=1;
    		echo"Cập nhật thành công";
    	}
    	else {
        echo"Cập nhật thất bại";

      }
    	// print(json_encode($flag));
    	mysql_close($con);
    ?>
