<?php


/* Controller for operations on threads page*/

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

// Get info about the category for which the threads are being displayed
function getParentCategoryInfo($kCatId)
{
	$result = json_encode(false);
	$query = "SELECT * from category where categoryid = ".$kCatId;
	$queryResult = mysql_query($query);
	if($queryResult==true)
	{
		$row = mysql_fetch_assoc($queryResult);
		$result = json_encode($row);
	}
	return $result;
}


function getThreadsForCategory($kCatId)
{
	$result = json_encode(false);
	$query = "SELECT * from Thread";
	$queryResult = mysql_query($query);
	$allThreads = array();
	if($queryResult!=NULL)
	{
		while($row = mysql_fetch_assoc($queryResult))
			array_push($allThreads,$row);
			
		$result = json_encode($allThreads);
	}
	return $result;
	
}


function createNewThreadForCategory($kCatId,$kTitle,$kDesc,$kGroup)
{
	$result = json_encode(false);
	$query  = "INSERT INTO Thread (title,description,categoryid) VALUES ('".$kTitle."', '".$kDesc."', ".$kCatId." )";
	$result = mysql_query($query);
	if($result==true)
	{
			//$result = json_encode($result);
			$result = getThreadsForCategory($kCatId);
		
	}	
	return $result;

}


function deleteThreadInCategory($kThreadId,$kCatId)
{
	$result= json_encode(false);
	$query = "DELETE FROM Thread WHERE threadid = ".$kThreadId;
	$queryResult = mysql_query($query);
	if($queryResult==true)
	  $result = getThreadsForCategory($kCatId);
	return $result;
}


$reqType = $_POST['requestType'];
$result = json_encode(false);
switch($reqType)
{
	case "getParentCategoryInfo": 
	 $catId = $_POST['catId'];
	 $result  = getParentCategoryInfo($catId);
	break;
	
	case 'createNewThreadForCategory':
	$catId = $_POST['catId'];
	$title = $_POST['title'];
	$desc  = $_POST['desc'];
	$group = 0;
	$result = createNewThreadForCategory($catId,$title,$desc,$group);
	break;
	
	case 'getThreadsForCategory':
	$catId = $_POST['catId'];
	$result = getThreadsForCategory($catId);
	break;
	
	case 'deleteThreadInCategory':
	$catId = $_POST['catId'];
	$threadId = $_POST['threadId'];
	$result = deleteThreadInCategory($threadId,$catId);
	break;
		
}


echo $result;


?>