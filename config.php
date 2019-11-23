<?php
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="login_system";

	$conn = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	if($conn->connect_error){
		die("could not connect to the database".$conn->connect_error);
	}
?>