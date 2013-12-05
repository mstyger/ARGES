<?php
error_reporting(E_ALL ^ E_NOTICE);
header('Content-Type: text/html; charset=utf-8');
 
if(!isset($_GET["ort"])) {
	die("Fehler: ort nicht gefunden.");
}

$ort = strtolower($_GET["ort"]);
$abfalltype = strtolower ($_GET["abfalltype"]);
$con = mysql_connect("localhost", "eugen", "arges1hwz");

if (!$con) {
	die ("Database Connection Failure: " . mysql_error () );
}

$db_select = mysql_select_db('arges', $con);

if (!$con) {
	die ("Database Selection Failure: " . mysql_error () );
}

$sql = "SELECT 
	a.abfalltype, 
	l.descriptionver, 
	l.street, 
	l.streetnumber,
	l.openingtime
FROM 
	abfalltype a,
	place p, 
	abfalllocation l
WHERE 
	LOWER(p.place_name) LIKE '$ort' AND
	LOWER(a.abfalltype) LIKE '$abfalltype' AND
	a.type_id = l.type_id AND
	p.place_id = l.place_id
";



$result = mysql_query($sql);

$hasres = false;

while($row = mysql_fetch_array($result)) {
  $hasres = true;
  echo "<h1>Abfalltyp: " . $row["abfalltype"] . "</h1>";
  echo "<p>Beschreibung: " . $row["descriptionver"] . "</p>";
  echo "<p>Strasse: " . $row["street"] . " " . $row["streetnumber"] . "</p>";
  echo "<p>Öffnungszeiten: " . $row["openingtime"] . "</p>";
}

mysql_close($con);

if(!$hasres) {

	die("Keine Angaben gefunden." . $ort);
}
?> 
