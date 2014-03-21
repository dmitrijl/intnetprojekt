<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>
<?php
//require 'init.php';
session_start();
require './model/functions.php';
include "view/banner.php";
//include "view/ucp.php";

if (!isset($_GET['action']) || $_GET['action'] == 'viewCategories') {
	//No action specified. List categories;
	//echo "viewCategories";
	include './view/viewCategories.php';
} else if ($_GET['action'] == 'viewForum') {
	//echo "viewForum";
	include './view/viewForum.php';
	$_GET["createthread"] = true;
	include 'createpost.php';
} else if ($_GET['action'] == 'viewThread') {
	//echo "viewThread";
	include './view/viewThread.php';
	include 'createpost.php';
} else {
	//echo "Unspecified action.";
}

?>



</body>
</html>
