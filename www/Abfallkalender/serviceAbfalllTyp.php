<?php
//error_reporting(E_ALL ^ E_NOTICE);
header('Content-type: application/json');
 
if(!isset($_GET["ort"])) {
	die("Fehler: ort nicht gefunden.");
}

$ort = strtolower($_GET["ort"]);
$con = mysql_connect("localhost", "eugen", "arges1hwz");

if (!$con) {
	die ("Database Connection Failure: " . mysql_error () );
}

$db_select = mysql_select_db('arges', $con);

if (!$con) {
	die ("Database Selection Failure: " . mysql_error () );
}

$sql = "SELECT 
	a.abfalltype 
FROM 
	abfalltype a,
	place p, 
	abfalllocation l
WHERE 
	LOWER(p.place_name) LIKE '$ort' AND
	p.place_id = l.place_id AND
    a.type_id = l.type_id
";

$result = mysql_query($sql);

$resArr = array("abfalltypes" => array());

while($row = mysql_fetch_array($result)) {
	$resArr["abfalltypes"][] = array("name" => $row["abfalltype"]);
}

mysql_close($con);

die(json_encode($resArr));

?> 
