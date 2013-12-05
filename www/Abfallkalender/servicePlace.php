<?php
//error_reporting(E_ALL ^ E_NOTICE);
header('Content-type: application/json');
 
$con = mysql_connect("localhost", "eugen", "arges1hwz");

if (!$con) {
	die ("Database Connection Failure: " . mysql_error () );
}

$db_select = mysql_select_db('arges', $con);

if (!$con) {
	die ("Database Selection Failure: " . mysql_error () );
}

$sql = "SELECT * FROM place";

$result = mysql_query($sql);

$resArr = array("places" => array());

while($row = mysql_fetch_array($result)) {
  $resArr[places][] = array("name" => $row["place_name"]);
}

mysql_close($con);
die(json_encode($resArr));
?> 
