<?php

// Connect to the database
function dbconnect() {
	// MySQL Settings
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = 'hydrazine';
	$db_database = 'projForum';
	
	// Connect
	$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_database);
	if ($mysqli->connect_errno) {
		die ('Could not connect to the database.');
	}
	return $mysqli;
}

?>
