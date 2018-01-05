<?php
$Time= new DateTime();
$Time->setTimezone(new DateTimeZone('Asia/Ho_Chi_Minh'));
echo $Time->format('Y-m-d H:i:s');
 ?>
