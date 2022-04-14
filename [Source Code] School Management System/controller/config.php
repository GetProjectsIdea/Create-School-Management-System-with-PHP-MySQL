<?php

$servername = "localhost";
$username   = "Enter Database Username";
$password   = "Exter Database Password";
$dbname     = "Enter Database Name";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
	
die("Connection failed: " . mysqli_connect_error());

}

?>