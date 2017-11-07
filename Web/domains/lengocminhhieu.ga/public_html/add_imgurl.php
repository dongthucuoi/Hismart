<?php
  require ("connect.php");

// $criteid=$_POST['id'];
$critename=trim($_POST['name']);
$img=trim($_POST['img']);
//
//   UPDATE table_name
// SET column1=value, column2=value2,...
// WHERE some_column=some_value

// ALTER TABLE ten_bang
// DROP CONSTRAINT MyPrimaryKey;

$tbcrite = mysql_query("select * from tblcriterias WHERE NameEN='$critename' and IsDeleted='0'");
  if(mysql_num_rows($tbcrite) != 0)
  {
  echo "name duplicated";
  }
  else{
  	if((isset($_POST['name']))&&($critename!="")&&($img!="")&&($r=mysql_query("INSERT INTO tblcriterias SET NameEN='$critename', Imgpath='$img'",$con))){
		echo"add-true";
	}
	else echo"add-false";
  }
  	// print(json_encode($flag));
	mysql_close($con);
?>
