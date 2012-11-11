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
	<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-transition.js"></script>


//	<script src="js/Threads.js"></script>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<link href="css/Threads.css" rel="stylesheet">


	<script type="text/javascript">  
	$(document).ready(function () {  
		$('.dropdown-toggle').dropdown(); 
		$('[rel=tooltip]').tooltip(); 
		});</script>


	</head>
	<body>


		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner" style="padding: 0px 10px;">
				<a class="brand" href="#">Course Disscussion System</a>
				<!-- <ul class="nav">
					<li class="divider-vertical"></li>				
					<li><a  rel="tooltip" data-toggle="modal" href="#myModal" data-original-title="create category" data-placement="bottom"><i class="icon-pencil icon-white"></i></a></li>
					<li class="divider-vertical"></li>				
				</ul> -->



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


				<div class="span2 well well-small"   id="sidebar">
					<!-- Side bar div  -->
				</div>

				<div class="span7" id="contentPane">
					<!--Body content-->
					<table class="table" id="">
						<caption><ul class="breadcrumb pull-left">
							<li><a href="#">Categories</a> <span class="divider">/</span></li>
							<!-- <li><a href="#">Threads</a> <span class="divider">/</span></li> -->
						</ul></caption>
						<tbody>
							<tr class="tableRow" id="ref">
								<table class="inner_table">
									<tbody>
										<tr class="thread_rating_row">
											<td><i class="icon-star-empty"></i></td>
										</tr>
										<tr class="thread_content_row">
											<td class="thread_content_col"><td>
										</tr>
									</tbody>
								</table>
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
				<input type="text" placeholder="category name"  maxlength="200">
				<br/>
				<textarea rows="5" placeholder="description"></textarea>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>


	</body>
	</html>