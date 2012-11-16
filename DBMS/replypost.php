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





function getParentPostContent()
{
	$content = "";
	$jsonString = json_encode("failure");
	$parentPostContent  = "SELECT text FROM Post where postid=47";
	$result = mysql_query($parentPostContent);
	if($result==NULL)
	{
		die("Error fetching Parent Post content".mysql_error());
	}
	else
	{
		//Fetch all queries and encode in to json
		while($row = mysql_fetch_assoc($result))
			//array_push($allCat,$row);
			$content =  $row;
		$jsonString = json_encode($content);
	}
	
	return $jsonString;
}

$reqType = $_POST["eventType"];
$result = json_encode(false);
switch($reqType)
{
	 case "getParentPostContent":
	 $result  = getParentPostContent();
	 //$postId = $_POST['postId'];
	 //$result  = getParentPostContent($postId);
	 break;

	


}



echo $result;






?>