$("#signup").click(function()
	{
		$(".login").slideUp("slow",function(){
			$(".register").slideDown("slow");
		});
		
	}
	)
$("#signin").click(function()
	{
		$(".register").slideUp("slow",function()
			{
				$(".login").slideDown("slow");
			});
		
	}
	)