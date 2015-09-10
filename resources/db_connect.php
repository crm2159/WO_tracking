<?php

$servername= "localhost";
$username = "root";
$password = "";
$db = "machine_shop_jobs";

try {
	$dbh = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
	//set the PDo error mode to exception
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully";
	}
	//$dbh = null;
catch(PDOException $e){
	//echo "Connection failed: " . $e->getMessage();
	die();
	}
