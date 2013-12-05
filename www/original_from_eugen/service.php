<?php
error_reporting(E_ALL ^ E_NOTICE);
header('Content-Type: text/html; charset=utf-8');
 
if(!isset($_GET["ort"])) {
	die("Fehler: ort nicht gefunden.");
}

$ort = strtolower($_GET["ort"]);
$abfalltyp = strtolower ($_GET["abfalltyp"]);
$abfalltyp = "Altglas";
$con = mysql_connect("localhost", "eugen", "arges1hwz");

if (!$con) {
	die ("Database Connection Failure: " . mysql_error () );
}

$db_select = mysql_select_db('arges', $con);

if (!$con) {
	die ("Database Selection Failure: " . mysql_error () );
}

$sql = "SELECT 
	a.* 
FROM 
	Abfalltypen a,
	Gemeinden g, 
	Ref_Gemeinde_Abfall r
WHERE 
	LOWER(g.ort) LIKE '$ort' AND
	LOWER(a.abfalltyp) LIKE '$abfalltyp' AND
	a.id = r.fkAbfalltyp AND
	g.id = r.fkGemeinde
";

$result = mysql_query($sql);

$hasres = false;

while($row = mysql_fetch_array($result)) {
  $hasres = true;
  echo "<h1>" . $row["abfalltyp"] . "</h1>";
  echo "<p>" . $row["beschreibung"] . "</p>";
  echo "<p>Strasse: " . $row["strasse"] . " " . $row["nr"] . "</p>";
  echo "<p>Öffnungszeiten: " . $row["oeffnungszeiten"] . "</p>";
//  echo "<p>Abfalltyp: " . $abfalltyp . "</p>";
  
}



mysql_close($con);

if(!$hasres) {
	die("Keine Angaben gefunden.");
}
?> 
