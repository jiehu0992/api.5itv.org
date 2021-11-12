<?php
$id=$_SERVER["QUERY_STRING"];
$url="http://www.huaihai.tv/m2o/player/drm.php?url=http://live.huaihai.tv/".$id."/sd/live.m3u8";
$contents = file_get_contents($url); 
$getcontent = iconv("UTF-8", "UTF-8",$contents); 
header('location:'.urldecode($contents));
?>