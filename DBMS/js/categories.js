$("document").ready(
	function()
	{
		
		 $("#ref").hide();
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
				if(userType != 0)
				{
					$("#ref").find(".delLink").hide();
					$("#create-category-link").hide();
				}
				else
				{
					$("#ref").find(".delLink").show();
					$("#create-category-link").show();
				}
				
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
			
			$.ajax({
				type: "POST",
				url: "categoriesRepository.php",
				async: false,
				data: {eventType: "deleteCategory", categoryId: catId},
			}).done(function(response){
				$("#ref").siblings().detach();
				var result = jQuery.parseJSON(response);
				var delRsesult = result.deleteResult;
				var categories = result.list;
				console.log(categories);
				
				if(delRsesult<1)
				{
					//delete failed
					$(".alert").hide();
					$("#errorAlert").html("<i class=' icon-ok'></i> &nbsp; Error in deletion");
					$("#errorAlert").fadeIn('fast');
					$("#errorAlert").fadeOut(4000);
					
				}
				else
				{
					if(categories==null || categories.length<1)
					{
						//all categories deleted
						$(".alert").hide();
						$("#infoAlert").html("<i class=' icon-ok'></i> &nbsp; All categories added");
						$("#infoAlert").fadeIn('fast');
						$("#infoAlert").fadeOut(4000);
						
					}
					else if(categories.length>0)
					{
						//some cateogries are there
						$(".alert").hide();
						$("#successAlert").html("<i class=' icon-ok'></i> &nbsp; Category deleted");
						$("#successAlert").fadeIn('fast');
						$("#successAlert").fadeOut(4000);
						
						
					}
				}
				
				if(categories!=null && categories.length>0)
				{
					$("#ref").siblings().detach();
					
					layoutRows(categories);
				}
			});
		});
		
		
		//onload get all categories
		$.ajax({
			type: "POST",
			url: "categoriesRepository.php",
			async: false,
			data: { eventType: "getAllCategories" },
		}).done(function(data){
			var categories = jQuery.parseJSON(data);
			layoutRows(categories);
		});
		
		$('.dropdown-toggle').dropdown(); 
		$('[rel=tooltip]').tooltip(); 
		$("#blob").popover({ html : true}); 

		

		$("#searchFilter").click(function(event){
			console.log("Opening search filter");
			$('#example').popover();
		});
		
		
		
		// Create new category
		$("#newCatSave").click(function(){
			var catName = $("#catName").val();
			var user = $("#loggedUser").attr('userid');
			$("#cancelNewCat").click();
			
			$.ajax({
				type: "POST",
				url: "categoriesRepository.php",
				async: false,
				data: {eventType: 'createNewCategory',kName: String(catName), userid:user },
			}).done(function(response){
				// $("#ref").show();
				$("#ref").siblings().detach();
				$(".alert").hide();
				$("#successAlert").html("<i class=' icon-ok'></i> &nbsp; Category added");
				$("#successAlert").fadeIn('fast');
				$("#successAlert").fadeOut(4000);
				var categories = jQuery.parseJSON(response);
				console.log(categories);
				layoutRows(categories);
				
			});
		});
		
		
		
		//When user clicks on a category
		$('.catLink').live('click',function(event){
			event.preventDefault();
			//get the category id, for the link which is click
			var catid  = $(this).parent().attr('categoryId');
			console.log("Clicked category : "+catid);
			window.location = 'threads.php?catId='+catid;
		});
		
		
		
		function layoutRows(categories)	
		{
			
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
				$(cc).find(".delLink").attr('href','');
				$(cc).find('.catThreadsCount').html(cat.num+(parseInt(cat.num>1)?" threads":" thread"));
				$(cc).find('.createdBySpan').html(cat.creator.username);
				$(cc).show();
				$(cc).insertAfter('#ref');
				
				
			}
			 // $("#ref").hide();
			
			
		}
		

	}
);