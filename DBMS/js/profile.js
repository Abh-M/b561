$("document").ready(
	function()
	{
		
		$.ajax({
			type: "POST",
			url: "helpers.php",
			async: false,
			data: {requestType:'getLoggedInUserInfo'},
		}).done(function(response){
		

			
			var userInfo = jQuery.parseJSON(response);
			console.log(userInfo);
			
			if(userInfo==false)
			{
				//force logout
				$(".logoutLink").click();
			}
		});
		
	}
);

