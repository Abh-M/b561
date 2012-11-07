<!DOCTYPE html>
<html>
  <head>
    <title>Categories</title>
    <!-- Bootstrap -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/Categories.js"></script>

    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	
	
	<link href="css/Categories.css" rel="stylesheet">
    
	
  </head>
  <body>
	<div class="navbar navbar-inverse">
		<div class="navbar-inner">
		    <div class="container">
		      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </a>
		      <a class="brand" href="#">Course Discussion System</a>
		      <div class="nav-collapse">
				<ul class="nav"><li></li></ul>
		      </div>
			<form class="navbar-search pull-right">
			  <input type="text" class="search-query" placeholder="Search">
			</form>
			
		    </div>
		  </div>
	</div>

	
	<div class="container-fluid">
	  <div class="row-fluid" id="row1"class="margin: 0px;">
			<div class="span2 well" id="sidebar">
		      <!--Sidebar content-->
		    </div>
		    <div class="span8" id="contentPane">
		      <!--Body content-->
				<table class="table table-striped">
					<caption>Categories</caption>
					<thead>
						
					</thead>
					<tbody>
						<?php 
							include "dbconnect.php";
	$tableName = "category"; 
	$query = "select * from $tableName"; 
	$result = mysql_query ($query);
	$num = mysql_numrows ($result);
	for ($i = 0; $i < $num; $i++) 
	{ 
		$categoryName = mysql_result ($result, $i, "Category"); 
		echo "<tr class=\"tableRow\" id=\"ref\">
				<td>$categoryName</td>
			</tr>";
	} 
	?>
					</tbody>
						
				</table>
		    </div>
			<div class="span2 well" id="rightPane"></div>
	  </div>
	</div>
	
	
  </body>