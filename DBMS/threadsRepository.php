<?php


/* Controller for operations on threads page*/

session_start();

include "dbconnect.php";

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
	$query = "SELECT * from Thread WHERE categoryid = ".$kCatId;
	$queryResult = mysql_query($query);
	$allThreads = array();
	if($queryResult!=NULL)
	{
		while($row = mysql_fetch_assoc($queryResult))
		{
			//get tags for this thread
			$threadId = $row['threadid'];
			//select keyword from Tag where tagid IN (Select tagid from tagtothread where threadid=61);
			$tagSearchQuery = "select keyword from Tag where tagid IN (Select tagid from tagtothread where threadid = $threadId)";
			$tagSearchQueryResult  = mysql_query($tagSearchQuery);
			$alltags = array();
			if(mysql_num_rows($tagSearchQueryResult))
			{
				//got some tags
				
				while($tagRow = mysql_fetch_assoc($tagSearchQueryResult))
				{
					//for each tag
					$tag = $tagRow['keyword'];
					//echo $tag;
					array_push($alltags,$tag);
				}
			}
			$row['tags'] = $alltags;
			
			
			
			//get creater info
			$owner = $row['owner'];
			$ownerSearchQuery = "Select * from User where userid = $owner";
			$ownerSearchQueryResult = mysql_query($ownerSearchQuery);
			if(mysql_num_rows($ownerSearchQueryResult)==1)
			{
				$user = mysql_fetch_assoc($ownerSearchQueryResult);
				$row['owner'] = $user;
			}

			array_push($allThreads,$row);
		}
		$result = json_encode($allThreads);
	}
	return $result;
	
}


function createNewThreadForCategory($kCatId,$kTitle,$kDesc,$kGroup,$kTags)
{
	$result = json_encode(false);
	$currDateTime = date('Y-m-d H:i:s');
	$createrId = $_SESSION['userid'];
	$query  = "INSERT INTO Thread (title,description,categoryid,datecreated,owner,votes,views) VALUES ('".$kTitle."', '".$kDesc."', ".$kCatId.", '".$currDateTime."', ".$createrId.", 0, 0 )";
	$result = mysql_query($query);

	
	//set make entries in tags for the new thread
	if(!empty($kTags) && $result==true)
	{
		$kTags = json_decode($kTags);
		
		$threadId = mysql_insert_id();

		foreach($kTags as $tag)
		{
			if(empty($tag))
				continue;
			/* Tag    
			+---------+-------------+------+-----+---------+----------------+
			| Field   | Type        | Null | Key | Default | Extra          |
			+---------+-------------+------+-----+---------+----------------+
			| tagid   | int(11)     | NO   | PRI | NULL    | auto_increment |
			| keyword | varchar(45) | YES  |     | NULL    |                |
			+---------+-------------+------+-----+---------+----------------+
			*/
			
			//check if tag already exist or else create new tag
			$tagId =false;
			$tagQuery = "SELECT * FROM Tag WHERE keyword LIKE '$tag'";
			$tagQueryResult = mysql_query($tagQuery);
			if(!mysql_num_rows($tagQueryResult))
			{
				
				//tag is not present insert it
				$insertTageQuery = "INSERT INTO Tag (keyword) VALUES ('$tag')";
				$tagInsertResult = mysql_query($insertTageQuery);
				if($tagInsertResult)
				{
					$tagId = mysql_insert_id();
				}	
				
			}	
			else
			{
				//tag already exist fetch the tagid
				$row = mysql_fetch_assoc($tagQueryResult);
				$tagId = $row['tagid'];
				
			}
			
			
			
			/* tagtothread
			+----------+---------+------+-----+---------+-------+
			| Field    | Type    | Null | Key | Default | Extra |
			+----------+---------+------+-----+---------+-------+
			| threadid | int(11) | NO   | PRI | NULL    |       |
			| tagid    | int(11) | NO   | PRI | NULL    |       |
			+----------+---------+------+-----+---------+-------+
			*/
			
			
			//make entry in tagtothread
			
			if($tagId)
			{
				$insertTagToThreadQuery = "INSERT INTO tagtothread (threadid,tagid) VALUES ($threadId,$tagId)";
				if(mysql_query($insertTagToThreadQuery))
				{
					//insert complete
				}
			}
		}
	}
	if($result==true)
	$result = getThreadsForCategory($kCatId);
	
	
	return $result;

}


function deleteThreadInCategory($kThreadId,$kCatId)
{
	$result= array();
	$query = "DELETE FROM Thread WHERE threadid = ".$kThreadId;
	
	
	$queryResult = mysql_query($query);
	$result['deleteResult'] = mysql_affected_rows();
	$result['threads'] = json_decode(getThreadsForCategory($kCatId));
	
	
	
	//also delete tags
	$queryDeleteTags = "DELETE FROM tagtothread WHERE threadid = ".$kThreadId;
	$queryDeleteTagsResult = mysql_query($queryDeleteTags);
	
	// if($queryResult!=NULL || $queryResult == true)
	// {
	// 	$result['deleteResult'] = mysql_affected_rows();
	// 	$result['threads'] = json_decode(getThreadsForCategory($kCatId));
	// }
	// else
	// {
	// 	$result = false; 
	// }
	 
	return json_encode($result);
}


function incrementVoteForThread($kId)
{
	$result = json_encode(false);
	$query = "UPDATE Thread SET votes = votes +1  WHERE threadid = ".$kId;
	$queryResult = mysql_query($query);
	if($queryResult !=NULL || $queryResult == true)
	$result = json_encode(true);
	
	return $result;
}


function decrementVoteForThread($kId)
{
	$result = json_encode(false);
	$query = "UPDATE Thread SET votes = votes - 1  WHERE threadid = ".$kId;
	$queryResult = mysql_query($query);
	if($queryResult !=NULL || $queryResult == true)
	$result = json_encode(true);
	
	return $result;
}


function incrementViewCountForThread($kId)
{
	$result = json_encode(false);
	$query = "UPDATE Thread SET views = views + 1  WHERE threadid = ".$kId;
	$queryResult = mysql_query($query);

	if($queryResult !=NULL || $queryResult == true)
		$result = json_encode(true);
	
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
	$tags = $_POST['tags'];
	
	$group = 0;
	$result = createNewThreadForCategory($catId,$title,$desc,$group,$tags);
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
	
	case 'incrementVoteForThread':
	$threadId = $_POST['threadId'];
	$result = incrementVoteForThread($threadId);
	break;
	
	case 'decrementVoteForThread':
	$threadId = $_POST['threadId'];
	$result = decrementVoteForThread($threadId);
	break;
	
	case 'incrementViewCountForThread':
	$threadId = $_POST['threadId'];
	$result = incrementViewCountForThread($threadId);
	break;
	
		
}


echo $result;


?>