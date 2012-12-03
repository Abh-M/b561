$("document").ready(function(){

	 $("#usernameAlertView").hide();
	 $("#firstnameAlertView").hide();
	 $("#lastnameAlertView").hide();
	 $("#emailAlertView").hide();
	 $("#passwordAlertView").hide();
	 $("#repasswordAlertView").hide();


	$("#addButton").click(function(event){
		console.log("add button clicked");
		var username = $("#username").val();
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		var email = $("#email").val();
		var pass = $("#password").val();
		var repass = $("#repassword").val();
		
		console.log("username :"+usename + username.length);
		console.log("password :"+pass  + pass.length);
		
		
		var isUsernameValid = false;
		var isFirstnameValid = false;
		var isLastnameValid = false;
		var isEmailValid = false;
		var isPasswordValid = false;
		var isRePasswordValid = false;
		
		if(username.length<1)
		{
			$("#usernameAlertView").show();
		}  
		else
		{
			$("#usernameAlertView").hide();
			isUsernameValid = true;
		}
		 
		 if(firstname.length<1)
		{
			$("#firstnameAlertView").show();
		}  
		else
		{
			$("#firstnameAlertView").hide();
			isFirstnameValid = true;
		}
		
		if(lastname.length<1)
		{
			$("#lastnameAlertView").show();
		}  
		else
		{
			$("#lastnameAlertView").hide();
			isLastnameValid = true;
		}
		
		if(email.length<1)
		{
			$("#emailAlertView").show();
		}  
		else
		{
			$("#emailAlertView").hide();
			isEmailValid = true;
		}
		
		
		if(pass.length<1)
		{
			$("#passwordAlertView").show();
			
		}  
		else 
		{
			$("#passwordAlertView").hide();
			isPasswordValid = true;
			
		}
		
		if(repass.length<1)
		{
			$("#repasswordAlertView").show();
			
		}  
		else 
		{
			$("#repasswordAlertView").hide();
			isRePasswordValid = true;
			
		}
		
		
		/*if(!isPasswordValid || !isUsernameValid)
		{
			event.preventDefault();
			return false;
		}*/

		 
		
		
	});
	
	$("#forgotPasswordButton").click(function(){

		console.log("forgot password clicked");
	});
	

});