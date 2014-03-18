<?php

// Start the session
session_start();


// MySQL Settings
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '123';
$db_database = 'projForum';


// Connect to the database
//mysql_connect ($db_host, $db_user, $db_pass) or die ('Could not connect to the database.');
//mysql_selectdb ($db_database) or die ('Could not select database.');
//$mysqli = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_database);
if ($mysqli->connect_errno) {
	die ('Could not connect to the database.');
}


// Seed the random number generator
srand();

?>
