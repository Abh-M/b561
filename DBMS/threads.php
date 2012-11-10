<!DOCTYPE html>
<html>
<head>
	<title>Threads</title>
	<!-- Bootstrap -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-popover.js"></script>  
	<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tooltip.js"></script>
	// <script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-transition.js"></script>


	<script src="js/Categories.js"></script>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">



	<link href="css/Categories.css" rel="stylesheet">


	<script type="text/javascript">  
	$(document).ready(function () {  
		$('.dropdown-toggle').dropdown(); 
		$('[rel=tooltip]').tooltip(); 
		});</script>


	</head>
	<body>
		<?php 
	// include "dbconnect.php";
	// $tableName = "category"; 
	// $query = "select * from $tableName"; 
	// $result = mysql_query ($query);
	// $num = mysql_numrows ($result);
	// for ($i = 0; $i < $num; $i++) 
	// { 
		// 	$categoryid=mysql_result ($result, $i, "categoryid"); 
		// 	$categoryName = mysql_result ($result, $i, "Category"); 
		// 	echo "<tr class=\"tableRow\" id=\"ref\">
		// 	
		// 	<td><a href="."reply.php?categoryid=$categoryid".">".$categoryName."</a></td>
		// 	</tr>";
		// }
		?>


		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner" style="padding: 0px 10px;">
				<a class="brand" href="#">Course Disscussion System</a>
				<ul class="nav">
					<li class="divider-vertical"></li>				
					<li><a  rel="tooltip" data-toggle="modal" href="#myModal" data-original-title="create thread" data-placement="bottom"><i class="icon-pencil icon-white"></i></a></li>
					<li class="divider-vertical"></li>				
				</ul>



				<ul class="nav pull-right">
					<!-- <li class="divider-vertical"></li> -->
					<li class="divider-vertical"></li>				
					<li class="dropdown">
						<a  id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#"><i class="icon-user icon-white"></i></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
							<li>
								<a href="#" tabindex="-1">profile</a>
							</li>
							<li>
								<a href="#" tabindex="-1">logout</a>
							</li>

						</ul>
					</li>
					<li class="divider-vertical"></li>				
				</ul>




				<form class="navbar-search">
					<div class="input-append">
						<input class="span3" id="appendedInputButtons" type="text">
						<a class="btn" href="#" rel="popover" id="searchFilter" data-placement="top" data-content="demo" data-orignal-title="popvoer"><i class="icon-search"></i></a>
						<div class="popover fade bottom in" id="example">
							<div class="arrow"></div>
							<div class="popover-inner">
								<h3 class="popover-title">Sample Popover</h3>
								<div class="popover-content">
									<p>Sample value</p>
								</div>
							</div>
						</div>
						<button class="btn" type="button">Advanced Options</button>
					</div>
				</form>
			</div>
		</div>


		<div class="container-fluid" id="content_container">
			<div class="row-fluid" id="row1"class="margin: 0px;">


				<div style="position:fixed; left:30px; top:70px;" class="span2 well well-small"   id="sidebar">
					<!-- Side bar div  -->
				</div>

				<div  style="position:relative; left:205px; top:;" class="span7" id="contentPane">
					<!--Body content-->
					<table class="table">
						<caption><ul class="breadcrumb pull-left">
							<li><a href="#">Category</a> <span class="divider">/</span><a href="#">Thread</a></li>
						</ul></caption>
						<thead>
						</thead>
						<tbody>
							<tr class="tableRow" id="ref">
								<td>
									<table class="cellSkeleton">
										<tbody>
											<tr class="rowSkeleton">
												<td class="skeletonCol catName"><a href="#">&lt;Thread Name&gt;</a></td>
												<td class="skeletonCol catCreated"><!-- &lt;Date Created&gt; -->Date created: </td>
											</tr>
											<tr class="rowSkeleton">
												<td class="skeletonCol catThreadsCount"><!-- &lt;Total Posts&gt; -->50 Posts</td>
												<td class="skeletonCol catModified"><!-- &lt;Last Modified&gt; -->Last Modified: </td>											
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>


				<div style="position:fixed; left:980px; top:70px;" class="span3 well" id="rightPane"></div>
			</div>
		</div>


		<!-- Modal view for creating new thread -->

		<div id="myModal" class="modal" style="display: none; ">
			<div class="modal-header">
				<!-- <button class="close" data-dismiss="modal">×</button> -->
				<h3>Create new thread</h3>
			</div>
			<div class="modal-body">
				<input type="text" placeholder="Thread title"  maxlength="200">
				<br/>
				<textarea rows="5" placeholder="Post"></textarea>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save Changes</a>
			</div>
		</div>


	</body>
	</html>