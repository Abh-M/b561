<?php
session_start();
include "dbconnect.php";

function deleteGroup($groupId)
{
	 $result = array();
	 $query = "DELETE FROM groups WHERE id = ".$groupId;
	 $queryRessult = mysql_query($query);
	 
	 $result['deleteResult']=mysql_affected_rows();
	  return json_encode(true);
	 //return json_encode($result);
}
function deleteThread($threadId)
{
	 $result = array();
	 $query = "DELETE FROM Thread WHERE threadid = ".$threadId;
	 $queryRessult = mysql_query($query);
	 $result['deleteResult']=mysql_affected_rows();
	  return json_encode(true);
	 //return json_encode($result);
}
function deleteUser($threadId)
{
	 $result = array();
	 $query = "DELETE FROM Thread WHERE threadid = ".$threadId;
	 $queryRessult = mysql_query($query);
	 $result['deleteResult']=mysql_affected_rows();
	  return json_encode(true);
	 //return json_encode($result);
}

$event = $_POST["eventType"];

$result;
switch($event)
{
	case "deleteGroup":
	{
		$grpId = $_POST['groupId'];
		$result = deleteGroup($grpId);
	}
	break;
	case "deleteThread":
	{
		$t_Id = $_POST['threadId'];
		$result = deleteThread($t_Id);
	}
	break;
	
 }
 
  echo $result;
?>