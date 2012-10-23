$("document").ready(function(){

	// $("#usernameAlertView").hide();
	// $("#passwordAlertView").hide();


	$("#loginButton").click(function(event){
		console.log("login button clicked");
		var email = $("#inputEmail").val();
		var pass = $("#inputPassword").val();
		console.log("username :"+email);
		console.log("password :"+pass);
		
		if(email!=null)
		{
			//show alert
			$("#usernameAlertView").hide();
		}
		else
		{
			//hide alert
			$("#usernameAlertView").show();
		}
		event.preventDefault();
	});
	
	$("#forgotPasswordButton").click(function(){

		console.log("forgot password clicked")
	});
	

});