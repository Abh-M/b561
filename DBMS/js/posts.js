$("document").ready(
	function()
	{
		
		
		//Get logged in userinfo
		$.post("helpers.php",{requestType:'getLoggedInUserInfo'},function(response){

			
			var userInfo = jQuery.parseJSON(response);
			console.log(userInfo);
			if(userInfo)
			{
				//set username
				$("#loggedUser").html(userInfo.username);
				$("#loggedUser").attr('userType',userInfo.userType);
				$("#loggedUser").attr('userid',userInfo.userid);
				$("#loggedUser").attr('username',userInfo.username);
				
				
				//depending on usertype show/hide create and delete category button
				var userType =parseInt(userInfo.userType);
				if(userType != 0 && userType!= 1)
				{
					 $(".deleteLink").hide();
					 $("#new-thread-link").hide();
				}
				else
				{
					 $(".deleteLink").show();
					 $("#new-thread-link").show();
				}
				
			}
			
		});
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
		

		$('.dropdown-toggle').dropdown(); 
		$('[rel   = tooltip]').tooltip(); 

		$(".star_link").click(function(){
			$(this).children().toggleClass('icon-star icon-star-empty');
		});

		$(".delete_button_cell").click(function(){
			$(this).parentsUntil(".tableRow").hide();			
		});

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
		 

		 $.post("postsRepository.php",{requestType: 'getParentThreadInfo', threadId: String(param_val)},
		 function(response){
				var json = jQuery.parseJSON(response);
				console.log("thread is "+json);
				$("#ThreadName").html(String(json.title));
				$("#ThreadName").attr("threadId",String(json.threadid));
		 });
		
		
		//get posts for thread
		$.post('postsRepository.php',{requestType: 'getPostsForThread',threadId: String(param_val)},
		function(response){
			var list = jQuery.parseJSON(response);
			jQuery.each(list, function() {
				var cell = $("#ref").clone();
				$(cell).removeAttr('id');
				$(cell).attr('postId',String(this.postid));
				$(cell).find('.posted_date_val').html(this.dateposted);
				if(this.createdby != $("#loggedUser").attr('userid')) {
					$.post('helpers.php',{requestType: 'getUserInfoFromUserId',userId: String(this.createdby)},
					function(response){
						var user = jQuery.parseJSON(response);
						console.log(user);
						$(cell).find('.posted_by_val').html(user.username);
					});
				} else {
					$(cell).find('.posted_by_val').html($("#loggedUser").attr('username'));
				}
				$(cell).find('.post_content_div').html(this.text);
				$(cell).insertAfter("#ref");
				
			});
			$("#ref").hide();
		});
		
		
		//When user clicks on a reply to a post
		$('.replyLink').live('click',function(event){
			event.preventDefault();
			$(this).parent().attr('colspan',4);
			$(this).parent().html("<div class=\"replyToPost well\">" +
					"<textarea class=\"span10\" rows=\"3\" placeholder=\"Your Reply\" id=\"replyPostContent\" data-spy=\"scroll\"></textarea>" +
					"<br>" +
					"<a href=\"\" id=\"replyPostSaveButton\" class=\"btn pull-right\"><i class=\"icon-ok\"></i></a>" +
					"<a href=\"\" id=\"replyPostCancelButton\" class=\"btn pull-right\"><i class=\"icon-remove\"></i></a>" +
					"</div>");
		});
		
		$('#replyPostSaveButton').live('click',function(event){
			event.preventDefault();
			//get the post id for the post to which you are replying
			var $parentPostRow = $(this).closest('.inner_table');
			parentPostText = $parentPostRow.find('.post_content_div').html();
			parentPostByUser = $parentPostRow.find('.posted_by_val').html();
			parentPostDate = $parentPostRow.find('.posted_date_val').html();
			parentPost = '[Post]'+parentPostByUser+'+'+parentPostDate+'+'+parentPostText+'[endPost]';
			reply = parentPost + $(this).parent().find("#replyPostContent").val();
			var parentPostId  = $(this).closest('.tableRow').attr('postId');
			$.post("postsRepository.php", { requestType: "createReplyPost", replyText: String(reply),
				postId: String(parentPostId), threadId:String(param_val)},
				function(data) {
					var response = jQuery.parseJSON(data);
					if(response!=true)
					{
						alert("There was an error posting the reply!\nPlease check the console logs for more details");
					}
					console.log(response);
					window.location = 'posts.php?threadId='+param_val;
				});
		});
		
		
		$('#replyPostCancelButton').live('click',function(event){
			event.preventDefault();
			$(this).parent().parent().html("<a href=\"\" class=\"btn replyLink\" >Reply</a>");
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
			$.post("postsRepository.php",{requestType: 'createNewPostForCategory', catId: String(catId), title: String(title), desc: String(desc)},
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
					$(cell).removeAttr('id');
					$(cell).attr('postId',String(post.postid));
				
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
			var postId = $(this).parentsUntil('.tableRow').parent().attr('postId');
			var catId = $("#CategoryName").attr('catId');
			
			
			$.post('postsRepository.php',{requestType: 'deletePostInCategory',catId: String(catId) ,postId: String(postId)},function(response){
				
				//remove old list
				$("#ref").show();
				$("#ref").siblings().detach();
				
				var list = jQuery.parseJSON(response);
				console.log(list);
				for(var i=0; i<list.length; i++)
				{
					var post = list[i];
				
					var cell = $("#ref").clone();
					$(cell).removeAttr('id');
					$(cell).attr('postId',String(post.postid));
				
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

		$('.threadLink').live('click',function(event){
			event.preventDefault();
			//get the thread id, for the link which is clicked
			var threadid  = $(this).attr('threadId');
			console.log("Clicked thread : "+threadid);
			window.location = 'threads.php';
		});	

		}
	);