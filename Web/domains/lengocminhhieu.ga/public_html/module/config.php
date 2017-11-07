<?php
  $tenmaychu ='localhost';
  $tentaikhoan ='root';
  $pass='';
  $csdl='quanlymoncuahang';
  $conn=mysql_connect($tenmaychu,$tentaikhoan,$pass,$csdl) or die ('không kết nối được csdl');
  mysql_select_db($csdl,$conn);
 ?>
