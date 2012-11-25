<?php

session_start();

include "dbconnect.php";

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
	 //$result  = getParentPostContent();
	 $postId = $_POST['postId'];
	 $result  = getParentPostContent($postId);
	 break;



}

echo $result;


?>