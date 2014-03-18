<?php

// Salt Generator
function generate_salt() {
	$salt = '';

	for ($i = 0; $i < 3; $i++) {
		$salt .= chr(rand(35, 126));
	}
	return $salt;
}


function is_authed() {
	// Check if the encrypted username is the same
	// as the unencrypted one, if it is, it hasn't been changed
	if (isset($_SESSION['username']) && (md5($_SESSION['username']) == $_SESSION['encrypted_name'])) {
		return true;
	} else {
		return false;
	}
}


function is_admin() {
	if (isset($_SESSION['username']) && (md5($_SESSION['username']) == $_SESSION['encrypted_name'])
			&& ($_SESSION['title'] == 'admin')) {
		return true;
	} else {
		return false;
	}
}


function user_register($username, $password, $firstname, $lastname, $yearofbirth, $monthofbirth, $dateofbirth, $address, $city, $zipcode, $homephonenumber, $cellphonenumber, $emailaddress, $basketballclub) {
	
	// Encrypt password with salt
	$salt = generate_salt();
	$encrypted = md5(md5($password).$salt);

	// Write to database
	$query = "insert into user (username, password, salt, title, firstname, lastname, yearofbirth, monthofbirth, dateofbirth, address, city, zipcode, homephonenumber, cellphonenumber, emailaddress, basketballclub) values ('$username', '$encrypted', '$salt', 'member', '$firstname', '$lastname', '$yearofbirth', '$monthofbirth', '$dateofbirth', '$address', '$city', '$zipcode', '$homephonenumber', '$cellphonenumber', '$emailaddress', '$basketballclub')";
	mysql_query ($query) or die ('Kunde inte skapa anv&auml;ndare.');
}


function change_userinfo( $password, $firstname, $lastname, $yearofbirth, $monthofbirth, $dateofbirth, $address, $city, $zipcode, $homephonenumber, $cellphonenumber, $emailaddress, $basketballclub) {
	// Encrypt password with salt
	$salt = generate_salt();
	$encrypted = md5(md5($password).$salt);

	// Write to database
	$query = "update user set password='$encrypted', salt='$salt', firstname='$firstname', lastname='$lastname', yearofbirth='$yearofbirth', monthofbirth='$monthofbirth', dateofbirth='$dateofbirth', address='$address', city='$city', zipcode='$zipcode', homephonenumber='$homephonenumber', cellphonenumber='$cellphonenumber', emailaddress='$emailaddress', basketballclub='$basketballclub' where userid='$_SESSION[userid]'";
	mysql_query ($query) or die ('Kunde inte ändra personuppgifter.');
}


function user_login($username, $password) {
	$query = "select salt from user where username='$username' limit 1";
	$result = mysql_query($query);
	$user = mysql_fetch_array($result);

	$encrypted_pass = md5(md5($password).$user['salt']);

	$query = "select userid, username, title, firstname, lastname, yearofbirth, monthofbirth, dateofbirth, address, city, zipcode, homephonenumber, cellphonenumber, emailaddress, basketballclub from user where username='$username' and password='$encrypted_pass'";
	$result = mysql_query($query);
	$user = mysql_fetch_array($result);
	$numrows = mysql_num_rows($result);

	$encrypted_id = md5($user['userid']);
	$encrypted_name = md5($user['username']);

	$_SESSION['userid'] = $user['userid'];
	$_SESSION['username'] = $username;
	$_SESSION['encrypted_id'] = $encrypted_id;
	$_SESSION['encrypted_name'] = $encrypted_name;
	$_SESSION['title'] = $user['title'];
	$_SESSION['firstname'] = $user['firstname'];
	$_SESSION['lastname'] = $user['lastname'];
	$_SESSION['yearofbirth'] = $user['yearofbirth'];
	$_SESSION['monthofbirth'] = $user['monthofbirth'];
	$_SESSION['dateofbirth'] = $user['dateofbirth'];
	$_SESSION['address'] = $user['address'];
	$_SESSION['city'] = $user['city'];
	$_SESSION['zipcode'] = $user['zipcode'];
	$_SESSION['homephonenumber'] = $user['homephonenumber'];
	$_SESSION['cellphonenumber'] = $user['cellphonenumber'];
	$_SESSION['emailaddress'] = $user['emailaddress'];
	$_SESSION['basketballclub'] = $user['basketballclub'];

	if ($numrows == 1) {
		return 'Correct';
	} else {
		return false;
	}
}


function user_logout() {
	// End the session and unset all vars
	session_unset ();
	session_destroy ();
}

?>

