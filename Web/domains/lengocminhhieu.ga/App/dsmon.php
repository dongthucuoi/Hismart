<?php

require('../connect.php');


  $tb_dsmon= @mysql_query("select * from tbl_mon");

  if(@mysql_num_rows($tb_dsmon) == 0)
  {
  echo "DSMon-false";
  }
  else

  $rows = array();
  while($r = mysql_fetch_assoc($tb_dsmon)) {
      $rows[] = $r;
  }

  $data = array('DSMON' => $rows);
  print json_encode($data);



 ?>
