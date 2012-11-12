$("document").ready(
	function()
	{

		//onload get all categories
		$.post("CategoriesCon.php", { eventType: "getAllCategories" },
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
					console.log($(cc).find(".catName").children().html());
					$(cc).find(".catName").children().html(cat.Category);
					$(cc).find(".catName").attr('categoryId',String(cat.categoryid));
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
		
		
		$("#newCatSave").click(function(){
			var catName = $("#catName").val();
			
			$.post("CategoriesCon.php",{eventType: 'createNewCategory', kName: String(catName)},function(response){
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
					console.log($(cc).find(".catName").children().html());
					$(cc).find(".catName").children().html(cat.Category);
					$(cc).find(".catName").attr('categoryId',String(cat.categoryid));
					$(cc).insertAfter('#ref');
				
				
				}
				$("#ref").hide();
				
				
			});
			$("#cancelNewCat").click();
		});
		
		

	}
);