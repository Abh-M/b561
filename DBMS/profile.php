<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
session_start();
include 'header.php';
?>
<title>Profile Page</title>

<script>
global_str="0";

 function list(str)
 {
 global_str=str;
	 
 if (str=="")
   {
   document.getElementById("contentPane").innerHTML="";
   return;
   } 
 if (window.XMLHttpRequest)
   {// code for IE7+, Firefox, Chrome, Opera, Safari
   xmlhttp=new XMLHttpRequest();
   }
 else
   {// code for IE6, IE5
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
 xmlhttp.onreadystatechange=function()
   {
   if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
     document.getElementById("contentPane").innerHTML=xmlhttp.responseText;
     }
   }
 xmlhttp.open("GET","profileRepository.php?q="+str,true);
 xmlhttp.send();
 
 }
 
 function ondel(id)
 {
 	
			var catId = id;
			console.log(catId);
			
			$.ajax({
				type: "POST",
				url: "categoriesRepository.php",
				async: false,
				data: {eventType: "deleteCategory", categoryId: catId},
			}).done(function(response){});
			
			list(global_str);
 }
 
   
   function goToThread(id)
   {
	   //var a = "<?php echo $_SESSION['userid']; ?>";
	   //alert (a);
	   
	  //alert("i am here");
   	window.location = 'threads.php?catId='+id;
   }
   
 </script>
	
</head>
    

<body >
<div style="background-color: ; position: relative; top: 60px; left: 20px;">
<div class="span2 well" id="sidebar">			

	
        <ul class="nav nav-list bs-docs-sidenav">
          <li id="category" onclick="list(this.id)"><a href="#"><i class="icon-chevron-right"></i> Categories</a></li>
          <li id="Thread" onclick="list(this.id)"><a href="#"><i class="icon-chevron-right"></i> Threads</a></li>
          <li id="Post" onclick="list(this.id)"><a href="#"><i class="icon-chevron-right"></i> Posts</a></li>
          <li id="roster" onclick="list(this.id)"><a href="#"><i class="icon-chevron-right"></i> Roster</a></li>
          <li id="" onclick="list(this.id)"><a href="#"><i class="icon-chevron-right"></i> whatever</a></li>
          
        </ul>
    </div>
    <!--<div style="  " class="" id="block">
    
    </div>-->
    <div style="background-color: " class=" span9 well" id="contentPane">
    
    Welcome! to your profile page
    </div>
    

</div>

</body>
</html>