<?php
require_once("connect.inc.php");
if(!isset($_REQUEST['park'])){
	die("[\"No Park Specified\"]");
}
$park = $link->escape_string($_REQUEST['park']);
$q = "SELECT park FROM locations WHERE park LIKE '$park' GROUP BY park ORDER BY park";
$result = $link->query($q);
error_log($park);
if($result && $result->num_rows > 0){
	$row = $result->fetch_assoc();
	$park = strtolower(str_replace(' ','_',$row['park']));
	header('Location:https://parkscount.com/' . $park . "/");
}else{
	die("[\"No Park Specified\"]");
}
	
?>