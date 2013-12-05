<?php
error_reporting(E_ALL);
function printr($arg) {
	echo "<pre>";
	print_r($arg);
	echo "</pre>";
}

if(isset($_POST["send"])) 
{
	printr($_POST);
	
	$meinfeld = $_POST["inputOrt"];
	echo $meinfeld;
	
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
	
	// todo: Prüfen ob was in den Feldern steht bevor SQL gestartet wird.
	// if ($_POST[inputPLZ] == "" || $_POST[inputOrt] == "" || $_POST[inputZusatzzahl] == "")
	//	{
	//  Hier noch irgend ein Fehler ausgeben
	//	}
	
	
	
	$sql = "SELECT 
				count(*) 
			from 
				Gemeinden 
			where 
				plz = '$_POST[inputPLZ]' and 
				ort = '$_POST[inputOrt]' and
				zusatzzahl = '$_POST[inputZusatzzahl]'";
    $result = mysql_query($sql);
	$count = mysql_result($result,0);
		
	if($count > 0)
		{
		echo "Gemeinde vorhanden";
		}
		else
		{
		$sql = "INSERT INTO 
					Gemeinden 
					(
						plz,
						ort,
						zusatzzahl
					)
				VALUES (
						'$_POST[inputPLZ]',
						'$_POST[inputOrt]',
						'$_POST[inputZusatzzahl]'
						)";
		echo 'Gemeinde hinzugefügt';
		}
	if (!mysql_query($sql))
	{
		die('Error: ' . mysql_error($con));
	}
	echo '<p><a href="index.php">Home</a></p>';
	mysql_close($con);

	}

?> 
<html>
	<head>
		<title>Gemeinde Erfassen</title>
		<link href="bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
			<h1> Gemeinde erfassen </h1>
		<div class="container">
			<form name="form" method="post" action="">
			  <div class="form-group">
				<label for="inputPLZ" class="control-label">plz</label>
				<div>
				  <input type="text" class="form-control" name="inputPLZ" id="inputPLZ" placeholder="plz">
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputOrt" class="control-label">Ort</label>
				<div>
				  <input type="text" class="form-control" name="inputOrt" id="inputOrt" placeholder="Ort">
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputZusatzzahl" class="control-label">Zusatzzahl</label>
				<div>
				  <input type="text" class="form-control" name="inputZusatzzahl" id="inputZusatzzahl" placeholder="Zusatzzahl">
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