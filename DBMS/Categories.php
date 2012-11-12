<!DOCTYPE html>
<html>
<head>
	<title>Categories</title>
	<!-- Bootstrap -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-popover.js"></script>  
	<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-transition.js"></script>
	<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-popover.js"></script>  
	


	<script src="js/Categories.js"></script>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	


	<link href="css/Categories.css" rel="stylesheet">
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
					<li><a  rel="tooltip" data-toggle="modal" href="#myModal" data-original-title="create category" data-placement="bottom"><i class="icon-pencil icon-white"></i></a></li>
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
								<a href="#" tabindex="-1" id="logoutLink">logout</a>
							</li>

						</ul>
					</li>
					<li class="divider-vertical"></li>				
				</ul>




				<form class="navbar-search">
					<div class="input-append">
						<input class="span3" id="appendedInputButtons" type="text">
						<a class="btn" href="#"><i class="icon-search"></i></a>
						<a  rel="tooltip" data-toggle="modal" href="#filtersModal" data-original-title="create category" data-placement="bottom" class="btn">Advance Search</i></a>
						<!-- <a href="#" id="blob" class="btn" rel="popover inner" data-placement="bottom" data-content="Works" data-original-title="Filters">Advance Search</a> -->
						
					</div>
				</form>
			</div>
		</div>


		<div class="container-fluid" id="content_container">
			<div class="row-fluid" id="row1"class="margin: 0px;">


				<div class="span2 well well-small"   id="sidebar">
					<!-- Side bar div  -->
				</div>

				<div  class="span7" id="contentPane">
					<!--Body content-->
					<table class="table">
						<caption><ul class="breadcrumb pull-left">
							<li><a href="#">Categories</a> <span class="divider">/</span></li>
						</ul></caption>
						<thead>
						</thead>
						<tbody>
							<tr class="tableRow" id="ref">
								<td>
									<table class="cellSkeleton">
										<tbody>
											<tr class="rowSkeleton">
												<td class="skeletonCol catName"><a href="">&lt;Category Name&gt;</a></td>
												<td class="skeletonCol catCreated"><!-- &lt;Date Created&gt; -->Date created: </td>
												<td class="skeletonCol catDelButton"><a href="javascript:void(0)" class="delLink"><i class="icon-remove"></i></a></td>
											</tr>
											<tr class="rowSkeleton">
												<td class="skeletonCol catThreadsCount"><!-- &lt;Total Threads&gt; -->50 threads</td>
												<td class="skeletonCol catModified"><!-- &lt;Last Modified&gt; -->Last Modified: </td>											
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>


				<div class="span3 well" id="rightPane"></div>
			</div>
		</div>


		<!-- Modal view for creating new category -->

		<div id="myModal" class="modal" style="display: none; ">
			<div class="modal-header">
				<!-- <button class="close" data-dismiss="modal">×</button> -->
				<h3>Create new category</h3>
			</div>
			<div class="modal-body">
				<input type="text" placeholder="category name"  maxlength="200" id="catName">
				<br/>
				<textarea rows="5" placeholder="description"></textarea>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal" id="cancelNewCat">Close</a>
				<a href="#" class="btn btn-primary" id="newCatSave">Save changes</a>
			</div>
		</div>
		
		
		
		<!-- Modal view for search filters -->
		
		<div id="filtersModal" class="modal" style="display: none; ">
			<div class="modal-header">
				<!-- <button class="close" data-dismiss="modal">×</button> -->
				<h6>Filters</h6>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
				  
				<div class="control-group">
				    <label class="control-label" for="inputEmail">Search by keyword</label>
				    <div class="controls">
				      <input type="text" id="keyword_filter" placeholder="keyword">
				    </div>
				 </div>
				
				<div class="control-group">
				    <label class="control-label" for="inputEmail">Search by User</label>
				    <div class="controls">
				      <input type="text" id="user_filter" placeholder="user">
				    </div>
				 </div>

				<div class="control-group">
				    <label class="control-label" for="inputEmail">Search by Tag</label>
				    <div class="controls">
				      <input type="text" id="tag_filter" placeholder="tag">
				    </div>
				 </div>
				
				
				
				</form>
				
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cancel</a>
				<a href="#" class="btn btn-primary">Search</a>
			</div>
		</div>



	</body>
	</html>