<?php
$servernimi = "localhost";
$kasutajanimi = "*****";
$parool = "*****";
$andmebaas = "*****";
$mysqli = new mysqli($servernimi, $kasutajanimi, $parool, $andmebaas);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$mysqli->set_charset('UTF8');
return $mysqli;
?>
