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


	<script type = "text/javascript">  
	$(document).ready(function () 
	{  

		$(".delete_button_cell").children().hide();
		$(".inner_table").mouseenter
		(
			function()
			{
				$(this).find(".delete_button_cell").children().show();
			}
		);

		$(".inner_table").mouseleave(
		function(){
		$(this).find(".delete_button_cell").children().hide();
		});

		$('.dropdown-toggle').dropdown(); 
		$('[rel   = tooltip]').tooltip(); 
		
		$(".star_link").click(function(){
			$(this).children().toggleClass('icon-star icon-star-empty');
		});
		
		$(".delete_button_cell").click(function(){
//			$(this).parent(".tableRow").hide();			
						$(this).parentsUntil(".tableRow").hide();			
		});
		
	});
	</script>


	</head>
	<body>


		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner" style="padding: 0px 10px;">
				<a class="brand" href="#">Course Disscussion System</a>
				<ul class="nav">
					<li class="divider-vertical"></li>				
					<li><a  rel="tooltip" data-toggle="modal" href="#myModal" data-original-title="new post" data-placement="bottom"><i class="icon-pencil icon-white"></i></a></li>
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


				<div class="span2 well well-small"   id="sidebar">
					<!-- Side bar div  -->
				</div>

				<div class="span7" id="contentPane">
					<!--Body content-->
					<table class="table outer_table">
						<thead><caption><ul class="breadcrumb pull-left">
							<li><a href="#">Categories</a> <span class="divider">/</span></li>
							<!-- <li><a href="#">Threads</a> <span class="divider">/</span></li> -->
						</ul></caption>
						</thead>
						<tbody>
							<tr class="tableRow" id="ref">
								<td><table class="inner_table table">
									<tbody>
										<tr class="thread_rating_row">
											<td class="rating_col">
												<a href="#" class="star_link"><i class="icon-star-empty" id="star1"></i></a>
												<a href="#" class="star_link"><i class="icon-star-empty" id="star2"></i></a>
												<a href="#" class="star_link"><i class="icon-star-empty" id="star3"></i></a>
												<a href="#" class="star_link"><i class="icon-star-empty" id="star4"></i></a>
												<a href="#" class="star_link"><i class="icon-star-empty" id="star5"></i></a>
											</td>
											<td class="modified_col">
												<p>Date Modfied:</p>
											</td>
											<td class="created_col">
												<p>Date Created:</p>
											</td>
											<td class="delete_button_cell" ><a href="#eded"><i class="icon-remove"></i></td>
										</tr>
											
										<tr class="thread_content_row">
											<td class="thread_content_col" colspan="4">
												<div class="thread_content_div">
														Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam scelerisque mattis dui et blandit. Etiam a orci et purus fringilla pulvinar posuere eget massa. Nam at velit ante. In hac habitasse platea dictumst. Phasellus in mauris erat, vitae scelerisque ligula. Suspendisse potenti. Cras mauris sem, cursus ut molestie mollis, tincidunt ut nibh. Quisque eleifend libero dui. Proin sagittis adipiscing diam sit amet elementum. Fusce pellentesque vulputate massa cursus cursus. Nulla facilisi. Nam rhoncus ligula ut nisl sodales in cursus elit viverra. Vestibulum volutpat, velit in hendrerit tempor, risus erat ultricies lectus, sed tincidunt dolor ligula sed quam. Morbi congue tempus nibh, eget imperdiet nulla placerat facilisis.
												</div>
											</td>
										</tr>
									</tbody>
								</table></td>
							</tr>
						</tbody>
						</table>
						
						
						<div  class="new_post_div">
							
						</div>
				</div>


				<div class="span3 well" id="rightPane"></div>
			</div>
		</div>


		<!-- Modal view for creating new category -->

		<div id="myModal" class="modal" style="display: none; ">
			<div class="modal-header">
				<!-- <button class="close" data-dismiss="modal">×</button> -->
				<h3>New Post</h3>
			</div>
			<div class="modal-body">
				<!-- <input type="text" placeholder="category name"  maxlength="200">
				<br/> -->
				<textarea rows="5" placeholder="description"></textarea>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>


	</body>
	</html>