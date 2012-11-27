<html>


    
 </html> 
 
   

<?php
$q=$_GET["q"];
session_start();
$userid = $_SESSION['userid'];
include "dbconnect.php";



// as Q, User as U where Q.creator=U.userid and U.userid='". $_SESSION['userid']."' ";   //WHERE id = '".$q."'";

if ($q == 'category')
 {
	 $sql="SELECT * FROM ".$q.""; 
	 
 $result = mysql_query($sql);

if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

else if (mysql_num_rows($result) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}
	 
 echo "<!-- <table class=\"table\">
  <tbody>
  <tr >
  <td>
  <table class=\"cellSkeleton\">
  <tbody>
  <tr class=\"rowSkeleton\">
  <th class=\"skeletonCol catName\"> Category Name </th>
  <th class=\"skeletonCol catCreated\">Created By </th>
  <th> </th>
  
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table> -->
  <table class='table cellSkeleton'>
	  <thead >
		  <th>category name</th>
		  <th>created by</th>
	  </thead>
   <tbody>
 
 ";
  while($row = mysql_fetch_array($result))
   {
	   $creator = $row['creator'];
	   $sql2="SELECT * FROM User where userid = '".$creator."'";
	   $result2 = mysql_query($sql2);
	   $row2 = mysql_fetch_array($result2);
	   if($creator == $_SESSION["userid"])
	   {
		   $mode="visible";
	   }
	   else $mode="hidden";
	   echo "
		     <tr class=\"rowSkeleton\">
		     <td class=\"skeletonCol catName\"> <a href=\"javascript:void(0)\" onclick=\"goToThread(". $row['categoryid'] .")\">" . $row['Category'] . "</a> </td>
 		     <td class=\"skeletonCol catCreated\"> " .$row2['firstname'] . " " .$row2['lastname'] . " </td> <td class=\"skeletonCol catDelButton\" colspan=\"1\"><a style=\"visibility:". $mode ."; \" id=\"$creator\" href=\"javascript:void(0)\" class=\"delLink\" onclick=\"ondel(". $row['categoryid'] .")\" ><i class=\"icon-trash\"></i></a></td> 
		 
		     </tr>
";
	 
  }
  echo "		   </tbody>
		  </table>
		 </td>
	  </tr> 
	  </tbody>
	  </table>";
 
 }
 
 else if ($q == 'Thread')
 {
	 $sql="SELECT * FROM ".$q." as Q, User as U where Q.owner=U.userid and U.userid='". $_SESSION['userid']."'"; 
	 
 $result = mysql_query($sql);

if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

else if (mysql_num_rows($result) == 0) {
    echo "You are a lousy user. You have not created any Threads yet. So go create some.";
    exit;
}
	 
 echo "<table class=\"table\" border='1' id='thrdTable'>
 <tr>
 <th>Title</th>
 <th>Description</th>
 <th>Votes</th>
 <th>Views</th>
 </tr>";
  while($row = mysql_fetch_array($result))
   {
   echo "<tr>";
   echo "<td>" . $row['title'] . "</td>";
   echo "<td>" . $row['description'] . "</td>";
   echo "<td>" . $row['votes'] . "</td>";
   echo "<td>" . $row['views'] . "</td>";
   echo "</tr>";
   }
 echo "</table>";
 }
 
 if ($q == 'roster')
 {
	 $sql="SELECT * FROM User"; 
	 
 $result = mysql_query($sql);

if (!$result) {
    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
    exit;
}

else if (mysql_num_rows($result) == 0) {
    echo "No rows found, nothing to print so am exiting";
    exit;
}

echo "<table class=\"table\">
	<thead>
 <th class=\"skeletonCol catName\"> Name </th>
 <th class=\"skeletonCol catCreated\">Email ID</th>
 <th class=\"skeletonCol catCreated\">Role</th>
</thead>
	 <tbody>
 
 
 
 ";


while($row = mysql_fetch_array($result))
   {
	   $type = $row['type'];
//	   $sql2="SELECT * FROM User where userid = '".$creator."'";
//	   $result2 = mysql_query($sql2);
//	   $row2 = mysql_fetch_array($result2);
	   if($type == "0")
	   {
		   $role="Instructor";
	   }
	   else if($type == "1")
	   {
		   $role="Associate Instructor";
	   }
	   else if($type == "2")
	   {
		   $role="Student";
	   }
	   echo "
		     <tr class=\"rowSkeleton\">
		     <td class=\"skeletonCol catName\"> " . $row['firstname'] . " " . $row['lastname'] ."</a> </td>
 		     <td class=\"skeletonCol catCreated\"> <a href=\"mailto:".$row['emailid'] ."\" > " .$row['emailid'] . "</a> </td> 							
			 <td class=\"skeletonCol catCreated\"> " .$role . " </td>
		 
		     </tr>";
   }
   echo "</tbody>
		  </table>";

 }
 
 mysql_close($dbConnection);
 ?>