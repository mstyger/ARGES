<?php 
header('Content-Type: text/html; charset=UTF-8');  
error_reporting(E_ALL);
function printr($arg) {
	echo "<pre>";
	print_r($arg);
	echo "</pre>";
}

if(isset($_POST["send"])) 
{
	printr($_POST);
	

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

	$sql = "SELECT 
				count(*) 
			from 
				Abfalltypen 
			where 
				abfalltyp = '$_POST[inputAbfalltyp]' and 
				beschreibung = '$_POST[inputBeschreibung]'";
    $result = mysql_query($sql);
	$count = mysql_result($result,0);
		
	if($count > 0)
		{
		echo "Abfalltyp vorhanden";
		}
		else
		{
		$sql = "INSERT INTO 
					Abfalltypen 
					(
						abfalltyp,
						beschreibung
					)
					VALUES 
					(
						'$_POST[inputAbfalltyp]',
						'$_POST[inputBeschreibung]'
					)";
		echo 'Abfalltyp hinzugefügt';
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
		<title>Abfalltypen erfassen</title>
		<link href="bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<h1> Abfalltypen erfassen </h1>
		<div class="container">
			<form name="form" method="post" action="">
			  <div class="form-group">
				<label for="inputAbfalltyp" class="control-label">Abfalltyp</label>
				<div>
				  <input type="text" class="form-control" name="inputAbfalltyp" id="inputAbfalltyp" placeholder="Abfalltyp">
				</div>
			  </div>
			  <div class="form-group">
				<label for="inputBeschreibung" class="control-label">Beschreibung</label>
				<div>
			<!--	  //<input type="text" class="form-control" name="inputBeschreibung" id="inputOrt" placeholder="Beschreibung">   -->
				  <textarea  rows="3" class="form-control" name="inputBeschreibung" id="inputOrt" placeholder="Beschreibung"></textarea>
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