<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb">
<head>
<link rel="stylesheet" type="text/css" href="index.css">

<script>
function validateForm()
{
//checks for empty username, empty password, and that passwords match.
//DOES NOT check if username is unique.

var form=document.forms["register"];
var username = form["username"].value;
var pass1 = form["password1"].value;
var pass2 = form["password2"].value;
if (username == null || username == "") {
	alert("Cannot have an empty username!");
	return false;
}

if (pass1 != pass2) {
	alert("The passwords do not match!");
	return false;
}
if (pass1 == null || pass1 == "") {
	alert("Cannot have an empty password!");
	return false;
}
alert("Password ok, returning to frontpage. TODO: check if username available, but that cannot be dont in JS.");
}
</script>



</head>

<body>


<?php

//require 'init.php';
require 'model/functions.php';
include 'banner.php';

?>

<h1> Create your account! </h1>

<form name="register" action="frontpage.php" onsubmit="return validateForm()" method="post">
Username       : <input type='text' name='username'><br>
Password       : <input type='password' name='password1'><br>
Repeat Password: <input type='password' name='password2'><br>
<input type='submit' value='Register'></form>



