<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
require_once("connect.inc.php");
if(!isset($_REQUEST['park'])){
	die("[\"No Park Specified\"]");
}
$park = $link->escape_string($_REQUEST['park']);
$q = "SELECT location FROM locations WHERE park LIKE '$park' GROUP BY location ORDER BY location";
$result = $link->query($q);
$list = "";
if($result && $result->num_rows > 0){
	$list = "[";
	while($row = $result->fetch_assoc()){
		if($list != "["){$list .= ",";}
		$list .= '"' . $row['location'] . '"';
	}
	$list .= "]";
	echo $list;
}else{
	echo "['No Parks']";
}
?>