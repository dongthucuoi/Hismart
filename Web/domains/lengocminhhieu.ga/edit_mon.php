
    <?php
  require ("connect.php");



    	$idch=$_POST['IDCH'];
      $idmon=$_POST['ID'];
      $tenmon=$_POST['TenMon'];
    	$gia=$_POST['Gia'];
      $img=$_POST['img'];


    	if(($idch!="")&&($idmon!="")&&($tenmon!="")&&($gia!="")&&($img!="")&&($r=mysql_query("UPDATE tbl_mon SET IDCH='$idch', TenMon='$tenmon', Gia='$gia', ImgUrl='$img' WHERE ID='$idmon'",$con)))
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
