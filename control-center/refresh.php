<?php
require_once '../php/linkDB.php';
date_default_timezone_set(PRC);
$hour = Date("G");
$min = intval(Date("i"))>30?1:0;
$timeSection = $hour*2+$min;
$num_sql = mysql_query("SELECT COUNT(*) FROM temp_order WHERE time_section='$timeSection'");
if($row=mysql_fetch_array($num_sql)){
	$order_num = $row[0];
	echo $order_num;
}
?>