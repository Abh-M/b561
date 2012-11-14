$("document").ready(
	function()
	{
		//$(".delete_button_cell").children().hide();
		
		$(".deleteLink").removeAttr('href');
		$(".deleteLink").css('opacity',0);
		
		
		
		$('.inner_table').live('mouseover mouseout', function(event) {
			if (event.type == 'mouseover') 
			{
				$(this).find(".deleteLink").attr('href',"");
				$(this).find(".deleteLink").css('opacity',1);
				
			} 
			else 
			{
				$(".deleteLink").removeAttr('href');
				$(".deleteLink").css('opacity',0);

			}
		});
		
		
		
		
		
		
		// $(".inner_table").mouseenter
		// (
		// 	function()
		// 	{
		// 		$(this).find(".delete_button_cell").children().show();
		// 	}
		// );
		// 
		// 
		// $(".inner_table").mouseleave(
		// 	function()
		// 	{
		// 		$(this).find(".delete_button_cell").children().hide();
		// 	}
		// );

		$('.dropdown-toggle').dropdown(); 
		$('[rel   = tooltip]').tooltip(); 

		$(".star_link").click(function(){
			$(this).children().toggleClass('icon-star icon-star-empty');
		});

		$(".delete_button_cell").click(function(){
			//			$(this).parent(".tableRow").hide();			
			$(this).parentsUntil(".tableRow").hide();			
		});


		// var cell = $("#ref").clone();
		// var cc = cell[0];
		// console.log(cell[0]);
		// 
		// 
		// for(var i=0;i<20;i++)
		// {
		// 	cell = $("#ref").clone();
		// 	cc = cell[0];
		// 	$(cc).insertAfter('#ref');
		// 
		// }


		$("#searchFilter").click(function(event){
			console.log("Opening search filter");
			$('#example').popover();
		});
		
		
		
		//get get url components
		var params = location.search;
		console.log(params);
		var components = String(params).split("=");
		var param_name = components[0].slice(1);
		var param_val = components[1];
		console.log(param_val+" <> "+param_name);
		
		//get Parent category info
		 $.post("PostsCon.php",{requestType: 'getParentCategoryInfo', catId: String(param_val)},
		 function(response){
			var json = jQuery.parseJSON(response);
			console.log(json);
			$("#CategoryName").html(String(json.Category));
			$("#CategoryName").attr("catId",String(json.categoryid));
		});
		
		
		//get posts in the category
		$.post('PostsCon.php',{requestType: 'getPostsForThread',catId: String(param_val)},function(response){
			var list = jQuery.parseJSON(response);
			console.log(list);
			for(var i=0; i<list.length; i++)
			{
				var post = list[i];
				
				var cell = $("#ref").clone();
				var cc = cell[0];
				$(cell).removeAttr('id');
				$(cell).attr('postid',String(post.postid));
				
				var post_Col = $(cell).find('.post_title_div');
				console.log(post_Col);
				var post_desc = $(cell).find('.post_content_div');
				console.log(post_desc);
				
				$(cell).find('.post_title_div').html(post.title);
				$(cell).find('.post_content_div').html(post.description);
				$(cell).insertAfter("#ref");
				
				
			}
			$("#ref").hide();
		});
		
		
		
		
		//Create new post
		
		$("#newPostSaveButton").click(function(event){
			// get category id
			// get post title
			// get post description
			
			var title = $("#newPostTitle").val();
			var desc = $("#newPostDesc").val();
			var catId = $("#CategoryName").attr('catId');
			
			console.log("Creating new post title "+ title + " desc: "+ desc + "for cat "+catId);
			
			//create new post and get updated list of posts
			$.post("PostsCon.php",{requestType: 'createNewPostForCategory', catId: String(catId), title: String(title), desc: String(desc)},
			function(response){
				
				//remove old list
				$("#ref").show();
				$("#ref").siblings().detach();
				
				var list = jQuery.parseJSON(response);
				console.log(list);
				for(var i=0; i<list.length; i++)
				{
					var post = list[i];
				
					var cell = $("#ref").clone();
					var cc = cell[0];
					$(cell).removeAttr('id');
					$(cell).attr('postid',String(post.postid));
				
					var post_Col = $(cell).find('.post_title_div');
					console.log(post_Col);
					var post_desc = $(cell).find('.post_content_div');
					console.log(post_desc);
				
					$(cell).find('.post_title_div').html(post.title);
					$(cell).find('.post_content_div').html(post.description);
					$(cell).insertAfter("#ref");
				
				
				}
				$("#ref").hide();
				
				
			});
			
			
			$("#newPostCloseButton").click();
			
		});
		
		
		
		//delete posts
		$(".deleteLink").live('click',function(event){
			event.preventDefault();
			
			//get the post id and category id of the post
			var postId = $(this).parentsUntil('.tableRow').parent().attr('postid');
			var catId = $("#CategoryName").attr('catId');
			
			
			$.post('PostsCon.php',{requestType: 'deletePostInCategory',catId: String(catId) ,postId: String(postId)},function(response){
				
				//remove old list
				$("#ref").show();
				$("#ref").siblings().detach();
				
				var list = jQuery.parseJSON(response);
				console.log(list);
				for(var i=0; i<list.length; i++)
				{
					var post = list[i];
				
					var cell = $("#ref").clone();
					var cc = cell[0];
					$(cell).removeAttr('id');
					$(cell).attr('postid',String(post.postid));
				
					var post_Col = $(cell).find('.post_title_div');
					console.log(post_Col);
					var post_desc = $(cell).find('.post_content_div');
					console.log(post_desc);
				
					$(cell).find('.post_title_div').html(post.title);
					$(cell).find('.post_content_div').html(post.description);
					$(cell).insertAfter("#ref");
				
				
				}
				$("#ref").hide();
				
				
				
			});
			
		});


		}
	);