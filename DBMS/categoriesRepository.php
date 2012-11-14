<?php

session_start();

include "dbconnect.php";

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

function deleteCategory($kCategoryId)
{
	 $result = json_encode(false);
	 $query = "DELETE FROM category WHERE categoryid = ".$kCategoryId;
	 $result = mysql_query($query);
	 if($result==true)
	 	$result = getAllCategories();
		
	return $result;
}


function getUserInfo()
{
	return json_encode($_SESSION['username']);
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
	
	case "deleteCategory":
	{
		$catId = $_POST['categoryId'];
		$result = deleteCategory($catId);
	}
	break;
	
	case "getUserInfo":
	{
		$result = getUserInfo();
	}
}

echo $result;

?>