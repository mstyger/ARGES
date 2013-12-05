<?php
error_reporting(E_ALL);
session_start();
header('Content-Type: text/html; charset=UTF-8');  

function printr($arg) 
{
	echo "<pre>";
	print_r($arg);
	echo "</pre>";
}

if(isset($_POST["send"])) 
{

	printr($_POST);
/*	
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
	else
	{
		
	}	
	if (!mysql_query($sql))
	{
		die('Error: ' . mysql_error($con));
	}
*/
}

?> 
<html>
	<head>
		<title>Ort und Abfalltyp auswählen </title>
		<link href="bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
		<h1>Ort und Abfalltyp auswählen </h1>
			<form name="form" method="post" action="abfallOrtErfassen.php">
				<div>
  					<?php
						$con = mysql_connect("localhost", "eugen", "arges1hwz");
						$db_select = mysql_select_db('arges', $con);
						$sql = mysql_query(
							"SELECT
								ort, id
							FROM
								Gemeinden");
	
						echo '<select name = "ort" id= "ort">';//RG changed ID from id to ort
						while ($row = mysql_fetch_array($sql)) 
	  					{
							echo '<option value="' . $row["id"] . '">' . $row["ort"] .'</option>';
						}
						echo '</select>';
													
					?>
				</div>
				<div>
  					<?php
						$con = mysql_connect("localhost", "eugen", "arges1hwz");
						$db_select = mysql_select_db('arges', $con);
						$sql = mysql_query(
							"SELECT
								abfalltyp, id
							FROM
								Abfalltypen");
	
						echo '<select name = "abfalltyp" id= "id">';
						while ($row = mysql_fetch_array($sql)) 
	  					{
							echo '<option value="' . $row["id"] . '">' . $row["abfalltyp"] .'</option>';
						}
						echo '</select>';
													
					?>
				</div>
				
				
				<br>
				<div>
					<input type="submit" name="send" class="btn btn-default"></button>
				</div>
			</form>
		</div>
	</body>
</html>
