$("document").ready(
	function()
	{
		// $("#example1").popover();  

		var cell = $("#ref").clone();
		var cc = cell[0];
		console.log(cell[0]);


		for(var i=0;i<20;i++)
		{
			cell = $("#ref").clone();
			cc = cell[0];
			$(cc).insertAfter('#ref');
		
		}

		// for(var i=0;i<20;i++)
		// 	$(cell).insertAfter('#ref');

		$("#searchFilter").click(function(event){
			console.log("Opening search filter");
			$('#example').popover();
		});


	}
);