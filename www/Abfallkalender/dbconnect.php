<?php

$username = 'eugen';
$password = 'arges1hwz';

try {
	$main = new PDO('mysql:host=localhost;dbname=arges', $username, $password);
	$main->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    echo "Connection failed: " . $ex->getMessage();
}
?>
