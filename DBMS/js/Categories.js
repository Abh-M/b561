$("document").ready(
	function()
	{
		
		for(var i=0;i<50;i++)
 		$("#ref").before('<tr class="tableRow" id="ref"><td>Category'+ (i+1) +'</td></tr>');
	  
		
	}
	);