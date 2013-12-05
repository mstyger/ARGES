<?php
error_reporting(E_ALL);
session_start();
header('Content-Type: text/html; charset=UTF-8');  
function showmestuff($arg) 
 {
	echo "<pre>";
	print_r($arg);
	echo "</pre>";
}

if(isset($_POST["ort"]) && $_POST["ort"] != ""){
	$_SESSION["inputOrt"] = $_POST["ort"];
	$_SESSION["inputAbfalltyp"] = $_POST["abfalltyp"];
	
}
echo "POST";
showmestuff($_POST);
echo "SESSION";
showmestuff($_SESSION);

if(isset($_POST["send"])) 
{
	
	$con = mysql_connect("localhost", "eugen", "arges1hwz");

	if (!$con) 
	{
		die ("Database Connection Failure: " . mysql_error () );
	}
	
	$db_select = mysql_select_db('arges', $con);
	if (!$con) 
	{
		die ("Database Selection Failure: " . mysql_error () );
	}

	if ($_SESSION["inputOrt"] == "" || $_SESSION["inputAbfalltyp"] == "")
	{
		echo "Fehler: Ort und/oder Abfalltyp konnte nicht gefunden werden";
	}

	
	$sql = "SELECT 
				COUNT( * )
			FROM 
				Ref_Gemeinde_Abfall r
			WHERE 
				r.fkGemeinde = '" . $_SESSION["inputOrt"] . "'
			AND r.fkAbfalltyp = '" . $_SESSION["inputAbfalltyp"] . "'
			
				";
		
		$result = mysql_query($sql);
		$count = mysql_result($result,0);
		//echo $count;
		echo 'First The Number Count: '.$count;// Is this working...?
		echo '<br />Result: '.$count;// Is this working...?

	if ($count == 0)
		{
	echo '<br />Second The Number'.$count;// Is this working...?
  	$sql = "INSERT INTO 
			Ref_Gemeinde_Abfall 
				(
					fkGemeinde,
					fkAbfalltyp,
					beschreibung,
					strasse
				)
			VALUES 
				(
					'" . $_SESSION["inputOrt"] . "',
					'" . $_SESSION["inputAbfalltyp"] . "',
					'" . $_POST[inputBeschreibung] . "',
					'" . $_POST[inputStrasse] . "'
				)";
				
				echo ($sql);
				
	if (!mysql_query($sql));
		{
		echo "Problem 1";
		die('Error: ' .mysql_error($con));
		}
	
	echo "Datensatz hinzugefügt";
	
	}else {
echo '<br />Already in the DB';

}
	
} 

?> 

<html>
	<head>
		<title>Abfall Lokalität erfassen</title>
		<link href="bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
		
		
		<h1>Abfall Lokalität erfassen</h1>
			<form name="form" method="post" action="">
			<h2>Ort: <?php echo $_SESSION["inputOrt"] ?></h2>
			<h2>Abfalltyp: <?php echo $_SESSION["inputAbfalltyp"] ?></h2>
	
				<div class="form-group">
					<label for="inputStrasse" class="control-label" >Strasse</label>
					<div>
						<input type="text" class="form-control" name="inputStrasse" id="inputStrasse" placeholder="Strasse eingeben">
					</div>
					</div>
				<div class="form-group">
					<label for="inputNr" class="control-label">Hausnummer</label>
					<div>
						<input type="text" class="form-control" name="inputNr" id="inputNr" placeholder="Hausnummer eingeben">
					</div>
				</div>
			  	 <div class="form-group">
					<label for="inputBeschreibung" class="control-label">Beschreibung</label>
					<div>
						<textarea  rows="3" class="form-control" name="inputBeschreibung" id="inputBeschreibung" placeholder="Beschreibung"></textarea>
					</div>
				</div>
				 <div class="form-group">
					<label for="inputOeffnungszeiten" class="control-label">Öffnungszeiten</label>
					<div>
						<textarea  rows="3" class="form-control" name="inputOeffnungszeiten" id="inputOrt" placeholder="Öffnungszeiten"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div>
						<input type="submit" name="send" class="btn btn-default"></button>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
