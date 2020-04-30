<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
require_once("connect.inc.php");
$q = "SELECT park FROM locations GROUP BY park ORDER BY park";
$result = $link->query($q);
$list = "";
if($result && $result->num_rows > 0){
	$list = "[";
	while($row = $result->fetch_assoc()){
		if($list != "["){$list .= ",";}
		$list .= '"' . $row['park'] . '"';
	}
	$list .= "]";
	echo $list;
}else{
	echo "['No Parks']";
}
?>