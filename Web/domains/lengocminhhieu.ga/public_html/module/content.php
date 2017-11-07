<div class="content">
<?php
  if(isset($_GET['quanly'])){
    $tam=$_GET['quanly'];
  }else{
    $tam='';
  }
  if ($tam=='tenloaimon') {
    include ('quanlymon/main.php');
  }
 ?>
<div class="clear"> </div>
