<?php
// This is a function, it redirects to a new page to clear the POST
// and give you a place for a message...
function RedirectToURL($url)
{
header("Location: $url");
exit;
}
// I put all the db routines inside one cascading "IF" statement
// if you add another, follow the same syntax, using ELSEIF otherwise you will need to break them all out
// as individual routines. That is, if the routine is not inside this if, any POST outside
// will not be caught, but trapped by the last ELSE statement below.
// Given more time, I would make this one routine using global var's, but it is syntactically correct
// and it works!
// *********************************
// If the page caught the POST and both fields have something in them,
// open the DB connect file and update the DB with new information.
// This is for PLACES
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['gemeinde']) && !empty($_POST['plz'])) {
//if POST is used and both fields have something in them
	include ('dbconnect.php');
	$result = $main->prepare('INSERT INTO place (`place_name`, `plz`) VALUES(:place_name, :plz)');
	$result->execute(
         array(
          ':place_name' => $_POST[gemeinde],
// notice no comma on the last line of the array below
          ':plz' => $_POST[plz]
              )
    );
RedirectToURL("thank-you.html");
exit;
// Message and auto return to flush POST
// This is for TYPES
    } elseif (!empty($_POST['abfalltyp']) && !empty($_POST['typdesc'])) {
// elseif on line above = if not PLACES, is it TYPES?
//if POST is used and both fields have something in them
	include ('dbconnect.php');
	$result = $main->prepare('INSERT INTO abfalltype (`abfalltype`, `description`) VALUES(:abfalltype, :description)');
	$result->execute(
         array(
          ':abfalltype' => $_POST[abfalltyp],
// notice no comma on the last line of the array below
          ':description' => $_POST[typdesc]
              )
    );
RedirectToURL("thank-you.html");
exit;
// Message and auto return to flush POST
// This is for VERBINDUNGEN
    } elseif (!empty($_POST['abfallverbindung']) && !empty($_POST['gemeindeverbindung'])) {
// elseif on line above = if not PLACES, or is not TYPES is it VERBINDUNGEN?
	include ('dbconnect.php');
	$result = $main->prepare('INSERT INTO abfalllocation (`place_id`, `type_id`, `street`, `streetnumber`, `descriptionver`, `openingtime`) VALUES(:place_id, :type_id, :street, :streetnumber, :descriptionver, :openingtime)');
	$result->execute(
         array(
			':place_id' => $_POST[gemeindeverbindung],
			':type_id' => $_POST[abfallverbindung],
			':street' => $_POST[streetVer],
			':streetnumber' => $_POST[streetnumVer],
			':descriptionver' => $_POST[descVer],
			':openingtime' => $_POST[openVer]
              )
    );
RedirectToURL("thank-you.html");
exit;
// Message and auto return to flush POST
// This is the DELETE routine for verbindung items
    } elseif (isset($_POST['deleteVer']) and is_numeric($_POST['deleteVer'])) {
// elseif on line above = if not PLACES, or is not TYPES or is not VERBINDUNGEN is it DELETEVER?
	include ('dbconnect.php');
	$result = $main->prepare('DELETE FROM abfalllocation WHERE location_id = :location_id');
	$result->bindParam(':location_id', $_POST['deleteVer']);
	$result->execute();
RedirectToURL("thank-you.html");
exit;
// Message and auto return to flush POST
    } else {
// elseif on line above = if not PLACES, or is not TYPES or is not VERBINDUNGEN or is not DELETEVER
// redirect to empty.html, then end.
RedirectToURL("empty.html");
exit;
// Crash out - we pressed a button but no applicable fields are empty
} // end last ELSE on line 83.
// End an IF with ELSE, if you need logic in between use ELSEIF but always end with ELSE.
} // end IF on line 32
// End the DB update IF statement

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>My Test Page</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>




<!-- Show the add Gemeind form -->
<div class="addGemeinde">
<h2>Gemeinde Erfassen</h2>
<form class="addGemeinde" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" name="form1">
<span>Gemeinde: <input type="text" name="gemeinde"></span><br />
<span>PLZ: <input type="text" name="plz"></span><br />
<input type="submit">
</form>
</div>

<?php

// Here we'll display the places that already exist
	include ('dbconnect.php');
  $result = $main->prepare('SELECT * FROM place GROUP BY place_name');
  $result->execute(array('id' => '*'));
  $places = $result->fetchAll();
  if ( count($places) ) {
	echo '<div class="tableClass"><h2>Existing Gemeinde</h2><table border="1">';
//loop through array showing results
    foreach($places as $row) {
      echo '<tr><td>' .$row['plz'].'</td><td>'.$row['place_name']. '</td></tr>';
    }// end foreach
	echo '</table></div>';
	} else { //If count places is empty 
	echo "No rows returned.";
    }

echo '<div style="clear:both;margin-top:50px"></div><br /><hr>';

?>

<!-- Show the add Abfalltyp form -->
<div class="addGemeinde">
<h2>Abfalltyp Erfassen</h2>
<form class="addGemeinde" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" name="form2">
<span>Abfalltyp: <input type="text" name="abfalltyp"></span><br />
<span>Description: <input type="text" name="typdesc" style="height:100px;"></span><br />
<input type="submit">
</form>
</div>


<?php

// Here we'll display the abfaltyp that already exist
	include ('dbconnect.php');
  $result = $main->prepare('SELECT * FROM abfalltype GROUP BY abfalltype');
  $result->execute(array('id' => '*'));
  $abfalltype = $result->fetchAll();
  if ( count($abfalltype) ) {
	echo '<div class="tableClass"><h2>Existing Abfalltypen</h2><table border="1">';
//loop through array showing results
    foreach($abfalltype as $row) {
      echo '<tr><td>' .$row['abfalltype'].'</td><td>'.$row['description']. '</td></tr>';
    }// end foreach
	echo '</table></div>';
	} else { //If count places is empty 
	echo "No rows returned.";
    }
echo '<div style="clear:both;margin-top:50px"></div><br /><hr>';

?>


<!-- Show the Abfalltyp/gemeinde Verbindung selection -->
<div class="addGemeinde">
<h2>Abfalltyp/Gemeinde Verbindung</h2>

<form class="gemeindeVer" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" name="form3">
<?php
//loop through Places array to get dropdown array
if ( count($places) ) {
echo '<select name = "gemeindeverbindung" id= "select1">';
echo '<option value="">Select Gemeinde</option>';
    foreach($places as $row) {
      echo '<option value="'.$row['place_id'].'">'.$row['plz'].'&nbsp;-&nbsp;'.$row['place_name'].'</option>';
    }// end foreach
	echo '</select>';
	} else { //If count places is empty 
	echo "No rows returned.";
  }

//loop through Types array to get dropdown array
  if ( count($abfalltype) ) {
echo '<select name = "abfallverbindung" id= "select2">';
echo '<option value="">Select Abfalltyp</option>';
    foreach($abfalltype as $row) {
      echo '<option value="'.$row['type_id'].'">'.$row['abfalltype'].'</option>';
    }// end foreach
	echo '</select>';
	} else { //If count places is empty 
	echo "No rows returned.";
    }

echo '<br /><span>Street: <input type="text" name="streetVer">  <input style="width:20px;" type="text" name="streetnumVer"></span><br />
<span>Description: <input  style="height:100px;" type="text" name="descVer"></span><br />
<span>Opening Times: <input type="text" name="openVer"></span>';
echo '<br /><input type="submit"></form></div><br />';

// Here we'll display the verbindungen that already exist
	include ('dbconnect.php');
  $result = $main->prepare('SELECT *
FROM place, abfalllocation, abfalltype
WHERE place.place_id = abfalllocation.place_id
AND abfalltype.type_id = abfalllocation.type_id
GROUP BY plz');
  $result->execute(array('id' => '*'));
  $verbindung = $result->fetchAll();
  if ( count($verbindung) ) {
	echo '<div class="tableClass"><h2>Existing Verbindungen</h2><table border="1">';
//loop through array showing results
echo '<tr><th>PLZ</th><th>Ort</th><th>Abfalltyp</th><th>Address</th><th>Description</th><th>Opening time</th><th>Edit</th></tr>';
    foreach($verbindung as $row) {
      echo '<tr><td>' .$row['plz'].'</td><td>'.$row['place_name']. '</td><td>'.$row['abfalltype'].'</td><td>'.$row['street'].',&nbsp; '.$row['streetnumber'].'</td><td>'.$row['descriptionver'].'</td><td>'.$row['openingtime'].'</td>

<td>
<form action="" method="post">
<input type ="hidden" name="deleteVer" value="'.$row['location_id'].'" />
<input type="submit" name="submit" value="Delete" />
</form>
</td>
</tr>';
    }// end foreach
	echo '</table></div>';
	} else { //If count places is empty 
	echo "No rows returned.";
    }
echo '<div style="clear:both;margin-top:50px"></div><br /><hr>';

?>


</head>
<body>



