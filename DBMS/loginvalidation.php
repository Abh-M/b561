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
	$_SESSION['userType'] = $row['type'];
	
	
	$userInfoMap = array();
	$userInfoMap['username'] = $_SESSION['username'];
	$userInfoMap['userid'] = $_SESSION['userid'];
	$userInfoMap['userType'] = $_SESSION['userType'];
	
	 $_SESSION['userInfoMap'] = $userInfoMap;
	 	
	

//Update lastlogin
	$currDateTime = date('Y-m-d H:i:s');
	$updateQuery = "UPDATE User SET lastlogin = '$currDateTime' WHERE userid = $userid ";
	$updateResult = mysql_query($updateQuery);
	if($updateQuery)
	{
		//update success
	}
	else
	{
		//update fiailed
	}

		
	
	header('Location: categories.php');
}
else {
	// Jump to login page
	 header('Location: index.php');

}

?>