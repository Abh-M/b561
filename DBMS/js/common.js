//Logout
$(".logoutLink").live('click', function(event) {

	console.log("Done");
	$.ajax({
		type : "POST",
		url : "logout.php",
	}).done(function(data) {
		window.location = "index.php";
	});
});