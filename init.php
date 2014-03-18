<?php

// Start the session
session_start();

// MySQL Settings
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '123';
$db_database = 'projForum';

// Connect to the database
mysql_connect ($db_host, $db_user, $db_pass) or die ('Could not connect to the database.');
mysql_selectdb ($db_database) or die ('Could not select database.');

// Seed the random number generator
srand();

?>
