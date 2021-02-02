import $ from 'jquery';

$(function()
{

	$("#show-session-jokes").on("click", function(e){
		$.ajax({
			url: "/jokes/session",
			method: "GET",
		})
		.done(function( data, textStatus, jqXHR )
		{
			$("#jokes-list").html("");

			if(data.jokes.length > 0)
			{
				$("#jokes-list").css("visibility", "visible");
			

				for(let joke of data.jokes)
				{
					$("#jokes-list").append("<p>" + joke + "</p>");
				}
			} else
			{
				$("#jokes-list").append("<p>There are no jokes to show.</p>");
			}
		});
	});

	$("#delete-session-jokes").on("click", function(e){
		$.ajax({
			url: "/jokes/session",
			method: "DELETE"
		});

		$("#jokes-list").css("visibility", "hidden");
		$("#joke-text").text("Click on a category to show a random joke...");
	});

});