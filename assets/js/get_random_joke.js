import $ from 'jquery';

$(function()
{

	$("#categories-menu ul li").on("click", function(e){
		$("#joke-text").css("opacity", "0.4");

		$.ajax({
			url: "/jokes/" + $(this).attr("value"),
			method: "GET",
		})
		.done(function( data, textStatus, jqXHR )
		{
			$("#joke-text").text(data.joke_text);
			$("#joke-text").css("opacity", "1.0");

			if($("#jokes-list").css("visibility") == "visible")
			{
				$("#show-session-jokes").trigger("click");
			}
		});
	});

});