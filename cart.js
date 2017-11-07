var $overlay = $('<div id="overlay"></div>');
var $image = $(".cartbtn").attr("href");

$overlay.append($image);
$("body").append($overlay);

$(".cartbtn").click(function(event){
	event.preventDefault();
	var imageLocation = $(this).attr("href");
	$image.attr("src",imageLocation);
	$overlay.show();
	});

$overlay.click(function(){
	$overlay.hide();
});






