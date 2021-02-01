import $ from 'jquery';

$(function()
{

	$("#categories-menu ul li").on("click", function(e){
		$("#joke-text").css("opacity", "0.4");

		$.ajax({
			url: "/jokes/" + $(this).attr("value"),
			method: "POST",
		})
		.done(function( data, textStatus, jqXHR )
		{
			$("#joke-text").text(data.joke_text);
			$("#joke-text").css("opacity", "1.0");
		});
	});

});