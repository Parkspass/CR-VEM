<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
require_once("connect.inc.php");

$user = '';
$park = '';
$location = '';
$entrance = 0;
$count = 0;

if(!isset($_REQUEST['park'])){
	die(json_encode(array('Error' => 'Park Not Set')));
}
if(!isset($_REQUEST['location'])){
	die(json_encode(array('Error' => 'Location Not Set')));
}

if(isset($_REQUEST['user'])){
	$user = $link->escape_string($_REQUEST['user']);
}
$park = $link->escape_string($_REQUEST['park']);
$location = $link->escape_string($_REQUEST['location']);
if(isset($_REQUEST['entrance'])){
	$entrance = intval($_REQUEST['entrance']);
}
if(isset($_REQUEST['count'])){
	$count = intval($_REQUEST['count']);
}

if($park != '' && $location != ''){
	$updated = false;
	$query1 = "UPDATE locations SET count = (count + $count), last_updated = NOW() WHERE park LIKE '$park' AND location LIKE '$location'";
	$query2 = "SELECT park, location, count, capacity, last_updated FROM locations WHERE park LIKE '$park' AND location LIKE '$location'";
	//error_log($query1);
	if($count != 0){
		$ret1 = $link->query($query1);
		if($ret1 && $link->affected_rows > 0){$updated = true;}
		if($updated){
			$tbl_name = str_replace(' ','_',$park) . "_" . str_replace(" ","_",$location) . "_activity";
			$query_u = "INSERT INTO $tbl_name (user, entrance, date_read, count) VALUES ('$user', $entrance, NOW(), $count)";
			$link->query($query_u);
		}	
	}

	//error_log($query2);
	$ret2 = $link->query($query2);
	if($ret2 && $ret2->num_rows > 0){
		$row = $ret2->fetch_assoc();
		echo json_encode($row);
	}
}
?>