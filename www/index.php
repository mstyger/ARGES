<?php
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');  

function printr($arg) {
	echo "<pre>";
	print_r($arg);
	echo "</pre>";
}

if(isset($_POST["send"])) {
	printr($_POST);
	
	$meinfeld = $_POST["inputPassword3"];
	echo $meinfeld;
}

?> 
<html>
	<head>
		<title>Intro</title>
		<link href="bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<h1> Abfall lokationen und Öffnungszeiten </h1>
			<a href="gemeindeErfassen.php">Gemeinde erfassen</a><br>
			<a href="abfalltypenErfassen.php">Abfalltypen erfassen </a><br>
			<a href="abfallOrtAuswahl.php">Ort und Abfalltyp auswählen </a><br>
			<a href="abfallOrtErfassen.php">Abfall Ort Erfassen</a><br>
			<a href="service.php?ort=Bern">Serviceanzeige</a><br>
		</div>
		
	</body>
</html>