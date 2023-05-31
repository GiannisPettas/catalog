<?php
	$host = "localhost";   //ip / domain where mysql server run
	$user = "root";       // mysql server valid username
	$pass = "";			  // mysql user password
	$db   = "tel_catalog";        // database to select
	
	$conn = mysqli_connect($host, $user, $pass, $db) or die(mysqli_connect_error());
?>