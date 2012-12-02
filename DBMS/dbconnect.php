<?php 
$dbHost = "localhost:3306"; 
$dbUserName = "root"; 
$dbPass = ""; 
$dbName = "b561f12_27"; 

$dbConnection = mysql_connect ($dbHost, $dbUserName, $dbPass) or die ("Cannot connect to host $dbHost with user $dbUserName and the password provided."); 
mysql_select_db ($dbName) or die ("Database $dbName not found on host $dbHost");
?>