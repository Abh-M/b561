<?php

session_start();
include "dbconnect.php";

$old = $_POST['cur_pass'];
$new = $_POST['new_pass'];
$user_id = $_POST['userid'];

$sql="SELECT * FROM User where userid='". $user_id ."'"; 
	 
 	$result = mysql_query($sql);

	if (!$result) 
	{
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
	}

	else if (mysql_num_rows($result) == 0) 
	{
    echo "You should not be in this page. Strict action will be taken against you";
    exit;
	}
	
	$row = mysql_fetch_array($result);
	
	if(strcmp($row['password'], $old) == 0)
	{
		$sql="UPDATE User SET password = '". $new ."' WHERE userid='". $user_id ."'";
		$result = mysql_query($sql);
		if (!$result) 
		{
			echo "Could not successfully run query ($sql) from DB: " . mysql_error();
			exit;
		}
		else 
		{
			echo "Password updated successfully";
			header( 'Location: http://localhost/b561/DBMS/profile.php?a=Password Updated Successfully' ) ;
		}
	}
	else echo "Invalid current password";

//echo $user_id;

?>