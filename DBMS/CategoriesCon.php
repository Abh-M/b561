<?php

session_start();

$dbHost = "silo.cs.indiana.edu:3306"; 
$dbUserName = "b561f12_27"; 
$dbPass = "b561f12_27"; 
$dbName = "b561f12_27"; 

$dbConnection = mysql_connect ($dbHost, $dbUserName, $dbPass);


if($dbConnection!=NULL)
{
	//echo "<br/>Connected to database";
	
}
else
{
	die("Error connection :".mysql_error());
}
$selResult = mysql_select_db ($dbName);


if($selResult!=NULL)
{
	//echo "<br/>Database selected ";
}
else
{
	die("Error selection : ".mysql_error());
}	



function getAllCategories()
{
	$allCat = array();
	$jsonString = json_encode("failure");
	$allCategoriesQuery  = "SELECT * FROM category";
	$result = mysql_query($allCategoriesQuery);
	if($result==NULL)
	{
		die("Error fetching all Categories".mysql_error());
	}
	else
	{
		//Fetch all queries and encode in to jsos
		while($row = mysql_fetch_assoc($result))
			array_push($allCat,$row);
		$jsonString = json_encode($allCat);
	}
	
	return $jsonString;
	
	
}

function createNewCategory($catName,$ownerId)
{
	$result = json_encode(false);
	$query = "INSERT INTO category (Category, creator) VALUES ('".$catName."',".$ownerId.")";
	$result = mysql_query($query);
	if($result==true)
		$result = getAllCategories();
	
 	return $result;

}


$event = $_POST["eventType"];
$result;
switch($event)
{
	case "getAllCategories":
	$result = getAllCategories();
	break;
	
	case "createNewCategory":
	{
		
		 $catName = $_POST['kName'];
		 $userid = $_SESSION['userid'];
		 $result = createNewCategory($catName,$userid);
		
	}
	break;
}






echo $result;

// $jsonString = getAllCategories();
// echo $jsonString";


//Get all categories




?>