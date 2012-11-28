$("document").ready(
	function()
	{
		
		
		//Get logged in userinfo
		$.ajax({
			type: "POST",
			url: "helpers.php",
			async: false,
			data: {requestType: 'getLoggedInUserInfo'},
		}).done(function(response){

			
			var userInfo = jQuery.parseJSON(response);
			console.log(userInfo);
			if(userInfo)
			{
				//set username
				$("#loggedUser").html(userInfo.username);
				$("#loggedUser").attr('userType',userInfo.userType);
				$("#loggedUser").attr('userid',userInfo.userid);
				$("#loggedUser").attr('username',userInfo.username);
				
				
			}
			
		});
		
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
		console.log(components);
		var param_name1 = components[0].slice(1);
		var param_val1 = components[1].slice(0,components[1].indexOf('&'));
		var param_name2 = components[1].slice(components[1].indexOf('&')+1);
		var param_val2 = components[2];
		console.log(param_val1+" <> "+param_name1+" <> "+param_val2+" <> "+param_name2);
		
		$.ajax({
			type: "POST",
			url: "threadsRepository.php",
			async: false,
			data: { requestType: "getParentCategoryInfo", catId: String(param_val2) },
		}).done(function(response){
				var json = jQuery.parseJSON(response);
				console.log(json);
				$("#CategoryName").html(String(json.Category));
				$("#CategoryName").attr("catId",String(json.categoryid));
		});
		
		$.ajax({
			type: "POST",
			url: "postsRepository.php",
			async: false,
			data: { requestType: "getParentThreadInfo", threadId: String(param_val1) },
		}).done(function(response){
				var json = jQuery.parseJSON(response);
				console.log("thread is "+json);
				$("#ThreadName").html(String(json.title));
				$("#ThreadName").attr("threadId",String(json.threadid));
		 });
		
		
		//get posts for thread
		$.ajax({
			type: "POST",
			url: "postsRepository.php",
			async: false,
			data: { requestType: "getPostsForThread", threadId: String(param_val1) },
		}).done(function(response){
			var list = jQuery.parseJSON(response);
			jQuery.each(list, function() {
				var cell = $("#ref").clone();
				$(cell).removeAttr('id');
				$(cell).attr('postId',String(this.postid));
				var x=$(cell).find(".mybadge").html(this.votes);
				console.log("mybadge:::"+x);
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
				$(cell).find('.post_content_div').attr("value",this.text);
				if(this.text.indexOf('[Post]') > -1) {
					this.text = convertPostToTable(this.text,1);
				}
				$(cell).find('.post_content_div').html(this.text);
				$(cell).insertAfter("#ref");
				
			});
			$("#ref").hide();
		});
		function convertPostToTable(text,counter) {
			// Based on counter providing a different color for the reply post text.
			if(counter%2===0)
				text = text.replace('[Post]', '<table class="well table"><tbody><tr><td>');
			else
				text = text.replace('[Post]', '<table class="alert alert-info table"><tbody><tr><td>');
			text = text.replace('[lineBreak]', '<br>');
			text = text.replace('[endPost]', '</td></tr></tbody></table>');
			if(text.indexOf('[Post]')>-1)
				text = convertPostToTable(text, counter+1);
			return text;
		}
		
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
			// Read the parent post and add it to the reply to store it in the DB.
			// This is done to improve performance and to avoid recursive DB calls.
			var $parentPostRow = $(this).closest('.inner_table');
			parentPostText = $parentPostRow.find('.post_content_div').val();
			parentPostByUser = $parentPostRow.find('.posted_by_val').html();
			parentPostDate = $parentPostRow.find('.posted_date_val').html();
			parentPost = '[Post]'+parentPostByUser+' on '+parentPostDate+' wrote :[lineBreak]'+parentPostText+'[endPost]';
			reply = parentPost + $(this).parent().find("#replyPostContent").val();
			//get the post id for the post to which you are replying
			var parentPostId  = $(this).closest('.tableRow').attr('postId');
			$.ajax({
				type: "POST",
				url: "postsRepository.php",
				async: false,
				data: { requestType: "createReplyPost", replyText: String(reply),
					postId: String(parentPostId), threadId:String(param_val1) },
			}).done(function(data){
					var response = jQuery.parseJSON(data);
					if(response!=true) {
						alert("There was an error posting the reply!\nPlease check the console logs for more details");
					}
					console.log(response);
					window.location = 'posts.php?threadId='+param_val1+'&catId='+param_val2;
				});
		});
		
		
		$('#replyPostCancelButton').live('click',function(event){
			event.preventDefault();
			$(this).parent().parent().html("<a href=\"\" class=\"btn replyLink\" >Reply</a>");
		});
		
		//Create new post
		
		$("#newPostSaveButton").click(function(event){
			// get category id
			// get post description
			
			var desc = $("#newPostDesc").val();
			var threadId = $("#ThreadName").attr('threadId');
			//create new post and get updated list of posts
			console.log("Creating new post : "+ desc + "for thread "+threadId);
			$.ajax({
				type: "POST",
				url: "postsRepository.php",
				async: false,
				data: { requestType: "createNewPost", postText: String(desc), threadId:String(threadId) },
			}).done(function(data){
				var response = jQuery.parseJSON(data);
				if(response!=true) {
					alert("There was an error creating a new post!\nPlease check the console logs for more details");
				}
				console.log(response);
				$("#newPostCloseButton").click();
				window.location = 'posts.php?threadId='+threadid+'&catId='+param_val2;
			});
			
		});
		
		
		
		//delete posts
		$(".deleteLink").live('click',function(event){
			event.preventDefault();
			
			//get the post id
			var postId  = $(this).closest('.tableRow').attr('postId');
			$.ajax({
				type: "POST",
				url: "postsRepository.php",
				async: false,
				data: { requestType: "deletePostInThread", postId: String(postId)},
			}).done(function(data){
					var response = jQuery.parseJSON(data);
					console.log(response);
					if(response!=true) {
						alert("Permission denied to delete the post");
					}
					window.location = 'posts.php?threadId='+param_val1+'&catId='+param_val2;
				});
			
		});

		$('.catLink').live('click',function(event){
			event.preventDefault();
			//get the cat id, for the link which is clicked
			var catId  = $(this).attr('catId');
			console.log("Clicked thread : "+catId);
			window.location = 'threads.php?catId='+catId;
		});
		
		$('.homeLink').live('click',function(event){
			event.preventDefault();
			//get the thread id, for the link which is clicked
			console.log("Clicked home : ");
			window.location = 'categories.php';
		});
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
		/* increment vote for posts*/
		$(".plus_button").live('click',function(event){
			//increment vote
			$(this).removeAttr('href');
			event.preventDefault();
			var postId  = $(this).closest('.tableRow').attr('postId');
			
			//var postId  = $(this).parentsUntil('.tableRow').parent().attr('postId');
			console.log("Incrementing vote for .."+postId);
			var prev_count = parseInt($(this).siblings(".mybadge").html());
			$(this).siblings(".mybadge").html(String(prev_count+1));
			//update database
		
			$.post('postsRepository.php',{requestType: 'incrementVoteForPosts',postId: postId},function(response){
				console.log("Done");
				var status = jQuery.parseJSON(response);
				console.log(status);
				if(status == true)
				{
				}
				
			});

			
			$(this).attr('href','');
			return false;

		});
		
		
		/* decrement vote for posts*/
		$(".minus_button").live('click',function(event){
			//increment vote
			event.preventDefault();
			var postId  = $(this).closest('.tableRow').attr('postId');
			//var threadId = $(this).parentsUntil('.tableRow').parent().attr('threadid');
			console.log("Decrementing vote for .."+postId);
			var prev_count = parseInt($(this).siblings(".mybadge").html());
			$(this).siblings(".mybadge").html(String(prev_count-1));
			//store in the database 

			$.post('postsRepository.php',{requestType: 'decrementVoteForPosts',postId: postId},function(response){
				console.log("Done");
				var status = jQuery.parseJSON(response);
				console.log(status);
				if(status == true)
				{
				}
				
			});
			
			
			
			return false;
			//deactivate the button
		});

		}
	);