	$(document).ready(function(){
		 if (jQuery(window).width() < 980 || jQuery(window).height() < 480) {
		$('.widget ul').hide();
	  $(".widget>h3").click(function(){
	     $(this).next().toggle();
	     $(this).toggleClass('show');
	     $(this).next().slideToggle("fast");
	  });
	}
	});