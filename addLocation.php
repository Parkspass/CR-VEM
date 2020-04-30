<?php

require_once("connect.inc.php");
$park = "Zion";
$capacity = 10;
$entrances = 2;
$count = 0;
$locations = array(
	'Kolob VC',
	'HH Museum',
	'Film Auditorium',
	'Visitors Center',
	'ZFP Park Store',
	'Zion Lodge',
	'Red Rock Grill',
	'Castle Dome Cafe',
);
$query = "INSERT INTO locations (park, location, capacity, entrances, count) VALUES ";
$values = "";
foreach($locations AS $location){
	if($values != ""){$values .= ",";}
	$values .= "('$park', '$location', $capacity, $entrances, $count)";
}
if($values != ""){
	/*
	$ret = $link->query($query . $values);
	echo "Inserted " . $link->affected_rows . " $park entries <br>" . PHP_EOL;
	error_log("Inserted " . $link->affected_rows . " $park entries");
	*/
}
//add table for location

foreach($locations AS $location){
	/*
	$tbl_name = str_replace(' ','_',$park) . "_" . str_replace(" ","_",$location) . "_activity";
	$query = "CREATE TABLE `parkscount`.`$tbl_name` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `user` VARCHAR(150) NOT NULL , `entrance` INT NOT NULL DEFAULT 0, `date_read` DATETIME NOT NULL , `count` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
	if($link->query($query) === true){
		echo "Created table for $park $location " . $link->affected_rows . " <br>" . PHP_EOL;
		error_log("Created table for $park $location " . $link->affected_rows . " ");
	}else{
		echo "Failed to create table for $park $location";
		error_log("Failed to create table for $park $location");
	}
	*/
}
?>