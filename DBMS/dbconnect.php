<?php 
//$dbHost = "silo.cs.indiana.edu:3306"; 
//$dbUserName = "b561f12_27"; 
//$dbPass = "b561f12_27"; 
//$dbName = "b561f12_27"; 
$dbHost = 'localhost';        // Your MySQL hostname. Usualy named as 'localhost', so you're NOT necessary to change this even this script has already online on the internet.
$dbName   = 'b561f12_27'; // Your database name.
$dbUserName= 'root';             // Your database username.
$dbPass = '';                 // Your database password. If your database has no password, leave it empty.


$dbConnection = mysql_connect ($dbHost, $dbUserName, $dbPass) or die ("Cannot connect to host $dbHost with user $dbUserName and the password provided."); 
mysql_select_db ($dbName) or die ("Database $dbName not found on host $dbHost");
?>