/*
# JavaScript and jQuery 
*/



$('[data-fancybox]').fancybox({
	protect: true
})



/* -- On-Scroll Update ----- *
 * When the user scrolls down 100px from the top of the document, trigger a reaction. 
 */
window.onscroll = function() {
	scrollFunction()
};

function scrollFunction() {
	if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
		$('#header').addClass("narrow").removeClass("broad");
		$('#button-top').addClass("inline").removeClass("hidden");
	} else {
		$('#header').addClass("broad").removeClass("narrow");
		$('#button-top').addClass("hidden").removeClass("inline");
	}
}

$(document).ready(function() {
/*
	$('.standard').hover(
		function(){
			$(this).find('.caption').show();
		},
		function(){
			$(this).find('.caption').hide();
		}
	);
	$('.fade').hover(
		function(){
			$(this).find('.caption').fadeIn(250);
		},
		function(){
			$(this).find('.caption').fadeOut(250);
		}
	);
*/
	$('figure').hover(
		function(){
			$(this).find('figcaption').slideDown(250);
		},
		function(){
			$(this).find('figcaption').slideUp(250);
		}
	);
});

/*
$('figure img').hover(function(){
	var $caption = $("figcaption");
	if ($caption.is('hidden')){
		$caption.slideDown('slow');
	} else {
		$caption.slideUp('slow');
	}
});

/*
$('figure a img').hover(function() {
	if ($("figcaption").is('hidden')) {
		$(this).show('slideUp', 'slow');
		$(this).hide('slideDown', 'slow');
	};
});
*/