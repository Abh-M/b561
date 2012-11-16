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

		$(".delete_button_cell").click(function(){
			//			$(this).parent(".tableRow").hide();			
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
		
		//get Parent category info
		 $.post("threadsRepository.php",{requestType: 'getParentCategoryInfo', catId: String(param_val)},
		 function(response){
			var json = jQuery.parseJSON(response);
			console.log(json);
			$("#CategoryName").html(String(json.Category));
			$("#CategoryName").attr("catId",String(json.categoryid));
		});
		
		
		//get threads in the category
		$.post('threadsRepository.php',{requestType: 'getThreadsForCategory',catId: String(param_val)},function(response){
			var list = jQuery.parseJSON(response);
			
			console.log(list);
			for(var i=0; i<list.length; i++)
			{
				var thread = list[i];
				var cell = $("#ref").clone();
				var cc = cell[0];
				$(cell).removeAttr('id');
				$(cell).attr('threadid',String(thread.threadid));
				
				var thread_Col = $(cell).find('.thread_title_div');
				var thread_desc = $(cell).find('.thread_content_div');
				
					  
				var createdDate = new Date(thread.datecreated);
				var formattedDate = createdDate.getMonth()+1+"/"+createdDate.getDate()+"/"+createdDate.getFullYear()+"    "+createdDate.toLocaleTimeString();
				
				//var formattedDate = createdDate.format();
				
				$(cell).find('.created_by_val').html(thread.owner.username);
				$(cell).find('.date_creted_val').html(formattedDate);
				$(cell).find(".mybadge").html(thread.votes);
				$(cell).find('.thread_title_div').children().html(thread.title);
				$(cc).find(".thread_title_div").attr('threadId',String(thread.threadid));
				$(cell).find('.thread_content_div').html(thread.description);
				
				
				
				if(thread.tags.length>0)
				{
					for(var j=0 ; j<thread.tags.length; j++)
					{
						var tag  =thread.tags[j];
						v = $(cell).find("#reftag").clone();
						$(cell).find("#reftag").hide();
						$(v).removeAttr('id');
						$(v).show();
						$(v).html(tag);
						$(cell).find('.tagContainer').append(v);
					}
						
						
				}
				else
				{
					$(cell).find('.tagsRow').hide();
				}
				
				
				$(cell).insertAfter("#ref");
				
				
				
			}
			$("#reftag").hide();
			$("#ref").hide();
			
		});
		
		
		
		
		//Create new thread
		
		$("#newThreadSaveButton").click(function(event){
			// get category id
			// get thread title
			// get thread description
			
			var title = $("#newThreadTitle").val();
			var desc = $("#newThreadDesc").val();
			var catId = $("#CategoryName").attr('catId');
			var tagsList = $('#tagsList').val();
			var allTags =tagsList.split(','); 
			var jsonTags = JSON.stringify(allTags);
			console.log(jsonTags);
			
			
			console.log("Creating new thread title "+ title + " desc: "+ desc + "for cat "+catId);
			
			//create new thread and get updated list of threads
			$.post("threadsRepository.php",{requestType: 'createNewThreadForCategory',tags: jsonTags, catId: String(catId), title: String(title), desc: String(desc)},
			function(response){
				
				$("#ref").siblings().detach();
				
				var list = jQuery.parseJSON(response);
				console.log(list);
				for(var i=0; i<list.length; i++)
				{
					$(".alert").hide();
					$("#successAlert").html("<i class=' icon-ok'></i> Thread inserted");
					$("#successAlert").fadeIn('fast');
					$("#successAlert").fadeOut(5000);
					//$("#ref").show();
					
					
					
					
					var thread = list[i];
				
					var cell = $("#ref").clone();
					var cc = cell[0];
					$(cell).removeAttr('id');
					$(cell).attr('threadid',String(thread.threadid));
				
					var thread_Col = $(cell).find('.thread_title_div');
					var thread_desc = $(cell).find('.thread_content_div');
					
					$(cell).find('.created_by_val').html(thread.owner.username);
					
					var createdDate = new Date(thread.datecreated);
					var formattedDate = createdDate.getMonth()+1+"/"+createdDate.getDate()+"/"+createdDate.getFullYear()+"    "+createdDate.toLocaleTimeString();
					
				
					$(cell).find('.date_creted_val').html(formattedDate);
					$(cell).find(".mybadge").html(thread.votes);
					
				
					$(cell).find('.thread_title_div').html(thread.title);
					$(cell).find('.thread_content_div').html(thread.description);
					$(cell).show();
					$(cell).insertAfter("#ref");
					
					if(thread.tags.length>0)
					{
						for(var j=0 ; j<thread.tags.length; j++)
						{
							var tag  =thread.tags[j];
							v = $(cell).find("#reftag").clone();
							$(cell).find("#reftag").hide();
							$(v).removeAttr('id');
							$(v).show();
							$(v).html(tag);
							$(cell).find('.tagContainer').append(v);
						}
						
						
					}
					else
					{
						$(cell).find('.tagsRow').hide();
					}
					
				
				
				}
				$("#ref").hide();
				
				
			});
			
			
			$("#newThreadCloseButton").click();
			
		});
		
		
		
		//delete threads
		$(".deleteLink").live('click',function(event){
			event.preventDefault();
			
			//get the thread id and category id of the thread
			var threadId = $(this).parentsUntil('.tableRow').parent().attr('threadid');
			var catId = $("#CategoryName").attr('catId');
			
			//make this sync
			
			
			
			$.post('threadsRepository.php',{requestType: 'deleteThreadInCategory',catId: String(catId) ,threadId: String(threadId)},function(response){
				
				
				var result = jQuery.parseJSON(response);
				
				if(result == false)
				{
					$(".alert").hide();
					$("#errorAlert").html("<i class=' icon-warning-sign'></i> Error in deletion");
					$("#errorAlert").fadeIn('fast');
					$("#errorAlert").fadeOut(5000);
					
				}
				else
				{
					var deleteResult = result.deleteResult;
					var list = result.threads;
				
					if(deleteResult == 0)
					{
						//delete failed
						$(".alert").hide();
						$("#errorAlert").html("<i class=' icon-warning-sign'></i> Error in deletion");
						$("#errorAlert").fadeIn('fast');
						$("#errorAlert").fadeOut(5000);
					
					
					}
				
					if(deleteResult>0 && list.length == 0)
					{
					
						//delete successful and all rows deleted
						$(".alert").hide();
						$("#infoAlert").html("<i class=' icon-warning-sign'></i> All threads deleted");
						$("#infoAlert").fadeIn('fast');
						$("#infoAlert").fadeOut(5000);
						$("#ref").siblings().detach();
					
					
					
					}
				
				
					if(list.length > 0 && deleteResult>0)
					{
						$(".alert").hide();
						$("#successAlert").html("<i class=' icon-ok'></i> Thread deleted");
						$("#successAlert").fadeIn('fast');
						$("#successAlert").fadeOut(5000);
					
					
						//remove old list
						//$("#ref").show();
						$("#ref").siblings().detach();
					
						console.log(list);
						for(var i=0; i<list.length; i++)
						{
							var thread = list[i];
				
							var cell = $("#ref").clone();
							var cc = cell[0];
							$(cell).removeAttr('id');
							$(cell).attr('threadid',String(thread.threadid));
				
							var thread_Col = $(cell).find('.thread_title_div');
							var thread_desc = $(cell).find('.thread_content_div');
					
					
							$(cell).find('.created_by_val').html(thread.owner.username);

							var createdDate = new Date(thread.datecreated);
							var formattedDate = createdDate.getMonth()+1+"/"+createdDate.getDate()+"/"+createdDate.getFullYear()+"    "+createdDate.toLocaleTimeString();
					
							$(cell).find('.date_creted_val').html(formattedDate);
							$(cell).find(".mybadge").html(thread.votes);
					
					
				
							$(cell).find('.thread_title_div').html(thread.title);
							$(cell).find('.thread_content_div').html(thread.description);
							$(cell).show();
							$(cell).insertAfter("#ref");
					
					
							if(thread.tags.length>0)
							{
								for(var j=0 ; j<thread.tags.length; j++)
								{
									var tag  =thread.tags[j];
									v = $(cell).find("#reftag").clone();
									$(cell).find("#reftag").hide();
									$(v).removeAttr('id');
									$(v).show();
									$(v).html(tag);
									$(cell).find('.tagContainer').append(v);
								}
						
						
							}
							else
							{
								$(cell).find('.tagsRow').hide();
							}
					
					
					
				
				
						}
						$("#ref").hide();
					
					}
					
					
				}
				
				
				
				
			});
			
		});
		
		$(".plus_button").live('click',function(event){
			//increment vote
			$(this).removeAttr('href');
			event.preventDefault();
			var threadId = $(this).parentsUntil('.tableRow').parent().attr('threadid');
			console.log("Incrementing vote for .."+threadId);
			var prev_count = parseInt($(this).siblings(".mybadge").html());
			$(this).siblings(".mybadge").html(String(prev_count+1));
			//update database
			$.post('threadsRepository.php',{requestType: 'incrementVoteForThread',threadId: threadId},function(response){
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
		
		$(".minus_button").live('click',function(event){
			//increment vote
			event.preventDefault();
			var threadId = $(this).parentsUntil('.tableRow').parent().attr('threadid');
			console.log("Incrementing vote for .."+threadId);
			var prev_count = parseInt($(this).siblings(".mybadge").html());
			$(this).siblings(".mybadge").html(String(prev_count-1));
			//store in the database 
			$.post('threadsRepository.php',{requestType: 'decrementVoteForThread',threadId: threadId},function(response){
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
		
		//When user clicks on a particular thread
		$('.threadLink').live('click',function(event){
			event.preventDefault();
			//get the thread id, for the link which is clicked
			var threadid  = $(this).parent().attr('threadId');
			console.log("Clicked thread : "+threadid);
			window.location = 'posts.php?threadId='+threadid;
		});
		
		
		//Logout
		$("#logoutLink").live('click',function(event){

			console.log("Done");
			$.ajax({
				type: "POST",
				url: "logout.php",
			}).done(function(data){
				window.location = "index.php";
			});
		});
			


		}
	);
