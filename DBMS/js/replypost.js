$("document").ready(
	function()
	{
		
		
		
		//onload get post content
		
		$(".replyButton").live('click',function(){
			
			console.log($(this));
			$.post("replypost.php", { eventType: "getParentPostContent" },
			function(data) {
				console.log(data);
				var content = jQuery.parseJSON(data);
				console.log(content);
				if(content)
				{
					//set username
					$("#ParentPostContent").html(String(content.text));
				}
			});
			
		})
		$(".replyButton").click(function(event){
			console.log($(this));
		});
		
		

		

	}
);