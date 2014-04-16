$(function(){
	var image2_count = $(".image-2-menu .image2-menu-name").length;
	var current_row2 = 1,  max_rows2 = Math.floor(image2_count / 4), columns;
	if ( (image2_count % 4) > 0 ) max_rows2++;

	
	/* Image 2 Menu NAV*/
	$(".post-with-image-2-wrapper .image-2-previous").click(function(){
		if ( current_row2 != 1 ) { 
			$('.image-2-menu').animate({top: "+=35px"}, 0);
			current_row2--;
		}
	});
	
	$(".post-with-image-2-wrapper .image-2-next").click(function(){
		if ( current_row2 != max_rows2 ) {
			$('.image-2-menu').animate({top: "-=35px"}, 0);
			current_row2++;
		}
	});
});