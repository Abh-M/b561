<?php


/* Controller for operations on threads page*/

session_start();

include "dbconnect.php";

// Get info about the category for which the threads are being displayed
function searchThreadTitle($term,$cat)
{
	$result = json_encode(false);
	$query = "SELECT * from Thread where categoryid=".$cat." and lower(title) contains lower('".$term."')";
	$queryResult = mysql_query($query);
	if($queryResult==true)
	{
		$row = mysql_fetch_assoc($queryResult);
		$result = json_encode($row);
	}
	//list threads page
}


function searchPostContents($term,$cat)
{
	$result = json_encode(false);
	$query = "SELECT t.* from post as p, thread as t where categoryid=".$cat." and t.threadid = p.threadid and lower(p.text) contains lower('".$term."') group by t.threadid";
	$queryResult = mysql_query($query);
	if($queryResult==true)
	{
		$row = mysql_fetch_assoc($queryResult);
		$result = json_encode($row);
	}
	//list threads that matched
}

function searchFirstPostContents($term,$cat)
{
	$result = json_encode(false);
	$query = "SELECT t.* from post as p, thread as t where categoryid=".$cat." and t.threadid = p.threadid and !p.linkedpostid and lower(p.text) contains lower('".$term."') group by t.threadid";
	$queryResult = mysql_query($query);
	if($queryResult==true)
	{
		$row = mysql_fetch_assoc($queryResult);
		$result = json_encode($row);
	}
	//list threads that matched
}

function searchAuthor($term)
{
	$result = json_encode(false);
	$query = "SELECT t.* from user as u, thread as t where lower(u.username)=lower('".$term."') and u.userid=t.owner";
	$queryResult = mysql_query($query);
	if($queryResult==true)
	{
		$row = mysql_fetch_assoc($queryResult);
		$result = json_encode($row);
	}
	//list threads that matched
}
function searchTag($term)
{
	$result = json_encode(false);
	$query = "SELECT t.* from tag as ta, tagtothread as ttt, thread as th where lower(ta.keyword)=lower('".$term."') and ta.tagid=ttt.tagid and ttt.threadid=th.threadid";
	$queryResult = mysql_query($query);
	if($queryResult==true)
	{
		$row = mysql_fetch_assoc($queryResult);
		$result = json_encode($row);
	}
	//list threads that matched
}

$reqType = $_POST['searchtype'];
$cat = $_POST['category'];
$result = json_encode(false);
switch($reqType)
{
	
	
	case 'threadTitle':
	$term = $_POST['term'];
	$result = searchThreadTitle($term,$cat);
	break;
	
	
	case 'postContent':
	$term = $_POST['term'];
	$result = searchPostContents($term,$cat);
	break;
	
	case 'firstPostContent':
	$term = $_POST['term'];
	$result = searchFirstPostContents($term,$cat);
	break;
	
	case 'threadAuthor':
	$term = $_POST['term'];
	$result = searchAuthor($term);
	break;

	case 'tagMatch':
	$term = $_POST['term'];
	$result = searchTag($term);
	break;		
}
