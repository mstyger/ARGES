<?php
error_reporting(E_ALL);
function printr($arg) {
	echo "<pre>";
	print_r($arg);
	echo "</pre>";
}

if(isset($_POST["send"])) {
	printr($_POST);
	
	$strasse = $_POST["sammelStrasse"];
	$nummer = $_Post["sammelNummer"];
	$abfalltyp = $_Post["abfalltyp"];
	$beschreibung = $_Post["beschreibung"];
	$oeffnungszeiten = $_Post["oeffnungszeiten"];
	echo $strasse . " " . $nummer . " " . $abfalltyp . " " . $beschreibung . " " . $oeffnungszeiten;
}

?> 
<html>
	<head>
		<title>Erfassen</title>
		<link href="bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<form name="form" method="post" action="">
			  <div class="form-group">
				<label for="SammelStrasse" class="control-label">Sammelstelle Strasse</label>
				<div>
				  <input type="text" class="form-control" name="sammelStrasse" id="sammelStrasse" placeholder="Sammelstelle Strasse">
				</div>
			  </div>
			  <div class="form-group">
				<label for="SammelNummer" class="control-label">Sammelstelle Hausnummer</label>
				<div>
				  <input type="text" class="form-control" name="sammelNummer" id="sammelNummer" placeholder="Sammelstelle Hausnummer">
				</div>
			  </div>
			  <div class="form-group">
				<label for="Abfalltyp" class="control-label">Abfalltyp</label>
				<div>
				  <input type="text" class="form-control" name="abfalltyp" id="abfalltyp" placeholder="Abfalltyp">
				</div>
			  </div>
			   <div class="form-group">
				<label for="Beschreibung" class="control-label">Beschreibung</label>
				<div>
				  <input type="text" class="form-control" name="beschreibung" id="beschreibung" placeholder="Beschreibung des Abfalls">
				</div>
			  </div>
			   <div class="form-group">
				<label for="Oeffnungszeiten" class="control-label">Öffnungszeiten</label>
				<div>
				  <input type="text" class="form-control" name="oeffnungszeiten" id="oeffnungszeiten" placeholder="Oeffnungszeiten">
				</div>
			  </div>
			  <div class="form-group">
				<div>
				  <div class="checkbox">
					<label>
					  <input type="checkbox"> Remember me
					</label>
				  </div>
				</div>
			  </div>
			  <div class="form-group">
				<div>
				  <input type="submit" name="send" class="btn btn-default">Sign in</button>
				</div>
			  </div>
			</form>
		</div>
		<a href="Service.php?ort=Bern">Serviceanzeige</a>
	</body>
</html>