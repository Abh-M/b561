<?php

// Inialize session
session_start();

// Include database connection settings
include('conn.php');

// Retrieve username and password from database according to user's input
$login = mysql_query("SELECT * FROM user WHERE (username = '" . mysql_real_escape_string($_POST['username']) . "') and (password = '" . mysql_real_escape_string($_POST['password']) . "')");
echo "no:"+mysql_num_rows($login);
// Check username and password match
if (mysql_num_rows($login) == 1) {
// Set username session variable
$_SESSION['username'] = $_POST['username'];
// Jump to secured page
//echo "successful";
header('Location: Categories.php');
}
else {
// Jump to login page
header('Location: login.php');
//echo "fail";
}

?>