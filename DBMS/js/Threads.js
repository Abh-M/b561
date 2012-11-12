$("document").ready(
	function()
	{
		//$(".delete_button_cell").children().hide();
		
		
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
		 $.post("ThreadsCon.php",{requestType: 'getParentCategoryInfo', catId: String(param_val)},
		 function(response){
			var json = jQuery.parseJSON(response);
			console.log(json);
			$("#CategoryName").html(String(json.Category));
			$("#CategoryName").attr("catId",String(json.categoryid));
		});
		
		
		//get threads in the category
		$.post('ThreadsCon.php',{requestType: 'getThreadsForCategory',catId: String(param_val)},function(response){
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
				console.log(thread_Col);
				var thread_desc = $(cell).find('.thread_content_div');
				console.log(thread_desc);
				
				$(cell).find('.thread_title_div').html(thread.title);
				$(cell).find('.thread_content_div').html(thread.description);
				$(cell).insertAfter("#ref");
				
				
			}
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
			
			console.log("Creating new thread title "+ title + " desc: "+ desc + "for cat "+catId);
			
			//create new thread and get updated list of threads
			$.post("ThreadsCon.php",{requestType: 'createNewThreadForCategory', catId: String(catId), title: String(title), desc: String(desc)},
			function(response){
				
				//remove old list
				$("#ref").show();
				$("#ref").siblings().detach();
				
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
					console.log(thread_Col);
					var thread_desc = $(cell).find('.thread_content_div');
					console.log(thread_desc);
				
					$(cell).find('.thread_title_div').html(thread.title);
					$(cell).find('.thread_content_div').html(thread.description);
					$(cell).insertAfter("#ref");
				
				
				}
				$("#ref").hide();
				
				
			});
			
			
			$("#newThreadCloseButton").click();
			
		});
		
		


		}
	);