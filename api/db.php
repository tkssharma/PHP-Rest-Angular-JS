<?php
function getDB() {
	$dbhost="localhost";
	$dbuser="demo";
	$dbpass="demo";
	$dbname="course";
	$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbConnection;
}
?>