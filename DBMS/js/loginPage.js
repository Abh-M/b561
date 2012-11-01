$("document").ready(function(){

	 $("#usernameAlertView").hide();
	 $("#passwordAlertView").hide();


	$("#loginButton").click(function(event){
		console.log("login button clicked");
		var email = $("#inputEmail").val();
		var pass = $("#inputPassword").val();
		console.log("username :"+email + email.length);
		console.log("password :"+pass  + pass.length);
		
		if(email.length<1)
		  $("#usernameAlertView").show();
		else
		 $("#usernameAlertView").hide();
		
		
		if(pass.length<1)
		  $("#passwordAlertView").show();
		else 
		 $("#passwordAlertView").hide();
		
		
		event.preventDefault();
	});
	
	$("#forgotPasswordButton").click(function(){

		console.log("forgot password clicked")
	});
	

});