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
