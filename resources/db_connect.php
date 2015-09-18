<?php

$servername= "localhost";
$username = "root";
$password = "";
$db = "jarvik_heart";

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
