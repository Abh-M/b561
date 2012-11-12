<?php

// Inialize session
session_start();

// Include database connection settings
include('dbconnect.php');

// Retrieve username and password from database according to user's input
$login = mysql_query("SELECT * FROM User WHERE (username = '" . mysql_real_escape_string($_POST['username']) . "') and (password = '" . mysql_real_escape_string($_POST['password']) . "')");

if (mysql_num_rows($login) == 1) {
	// Set username session variable
	$row = mysql_fetch_assoc($login);
	$userid = $row["userid"];
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['userid'] = $userid;
	
	header('Location: Categories.php');
}
else {
	// Jump to login page
	 header('Location: index.php/?userid=1');

}

?>