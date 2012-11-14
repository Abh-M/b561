$("document").ready(
	function()
	{
		
		
		//Get logged in userinfo
		$.post("categoriesRepository.php",{eventType: 'getUserInfo'},function(response){
			var userInfo = jQuery.parseJSON(response);
			console.log(userInfo);
			if(userInfo)
			{
				//set username
				$("#loggedUser").html(String(userInfo));
			}
		});
		
		
		$(".delLink").css('opacity',0);
		$(".delLink").removeAttr('href');
		
		$('.cellSkeleton').live('mouseover mouseout', function(event) {
			if (event.type == 'mouseover') 
			{
				$(this).find('.delLink').css('opacity',1);
				$(this).find('.delLink').attr('href',"");
				
			} 
			else 
			{
				$(this).find(".delLink").css('opacity',0);
				$(this).find(".delLink").removeAttr('href');

			}
		});
		
		

		
		// Delete category
		$(".delLink").live('click',function(event){
			event.preventDefault();
			console.log($(this).parent().siblings('td[categoryid]'));
			var catId = $(this).parent().siblings('td[categoryid]').attr('categoryid');
			console.log(catId);
			
			$.post("categoriesRepository.php",{eventType: "deleteCategory", categoryId: catId},function(response){
				
				
				$("#ref").show();
				$("#ref").siblings().detach();
				var categories = jQuery.parseJSON(response);
				console.log(categories);
				for(var index in categories)
				{
					console.log(cat);
					var cat = categories[index];
					console.log(cat.Category);
					console.log(cat.categoryid);
					console.log(cat.creator);
				
					var cell = $("#ref").clone();
					var cc = cell[0];
					console.log(cc);
					console.log($(cc).find(".catName").children().html());
					$(cc).find(".catName").children().html(cat.Category);
					$(cc).find(".catName").attr('categoryId',String(cat.categoryid));
					$(cc).insertAfter('#ref');
				
				
				}
				$("#ref").hide();
				
				
				
			});
			
			
			
		});
		
		
		//onload get all categories
		$.post("categoriesRepository.php", { eventType: "getAllCategories" },
		function(data) {
			//console.log(data);
			var categories = jQuery.parseJSON(data);
			//console.log(categories);
			for(var index in categories)
			{
				console.log(cat);
				var cat = categories[index];
				console.log(cat.Category);
				console.log(cat.categoryid);
				console.log(cat.creator);
				
				var cell = $("#ref").clone();
				var cc = cell[0];
				$(cc).removeAttr('id');
				console.log($(cc).find(".catName").children().html());
				$(cc).find(".catName").children().html(cat.Category);
				$(cc).find(".catName").attr('categoryId',String(cat.categoryid));
				$(cc).find(".delLink").attr('href','#');
				$(cc).insertAfter('#ref');
				
				
			}
			$("#ref").hide();
		});
		
		$('.dropdown-toggle').dropdown(); 
		$('[rel=tooltip]').tooltip(); 
		$("#blob").popover({ html : true}); 


		
		
		
		//Logout
		$("#logoutLink").click(function(event){
			console.log("Done");
			$.ajax({
				type: "POST",
				url: "logout.php",
			}).done(function(data){
				window.location = "index.php";
			});
		});
		

		$("#searchFilter").click(function(event){
			console.log("Opening search filter");
			$('#example').popover();
		});
		
		
		
		// Create new category
		$("#newCatSave").click(function(){
			var catName = $("#catName").val();
			
			$.post("categoriesRepository.php",{eventType: 'createNewCategory', kName: String(catName)},function(response){
				$("#ref").show();
				$("#ref").siblings().detach();
				var categories = jQuery.parseJSON(response);
				console.log(categories);
				for(var index in categories)
				{
					console.log(cat);
					var cat = categories[index];
					console.log(cat.Category);
					console.log(cat.categoryid);
					console.log(cat.creator);
				
					var cell = $("#ref").clone();
					var cc = cell[0];
					console.log(cc);
					console.log($(cc).find(".catName").children().html());
					$(cc).find(".catName").children().html(cat.Category);
					$(cc).find(".catName").attr('categoryId',String(cat.categoryid));
					$(cc).insertAfter('#ref');
				
				
				}
				$("#ref").hide();
				
				
			});
			$("#cancelNewCat").click();
		});
		
		
		
		//When user clicks on a category
		$('.catLink').live('click',function(event){
			event.preventDefault();
			//get the category id, for the link which is click
			var catid  = $(this).parent().attr('categoryId');
			console.log("Clicked category : "+catid);
			window.location = 'threads.php?catId='+catid;
		});	
		

	}
);