<?php
$conn=mysqli_connect('localhost','root','','db_lms');

date_default_timezone_set("Asia/Karachi");
$time = date("d-M-Y h:i:s A");
$date=date("d-m-y");
$today_date=date("d-m-y");
$trans_date = date("Y-m-d");
$machine_name = php_uname('n');
?>