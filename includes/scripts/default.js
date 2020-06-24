/* --- DEFAULT SCRIPTS ----- */



$('[data-fancybox]').fancybox({
	protect: true
})



/* -- Change Icon On Menu Drop-Down----- */
$(document).ready(function() { 
	$("#nav #menu").change(function() {
		if($(this).is(':checked')) {
			$("#nav label i").removeClass('la-caret-square-down').addClass('la-times-circle');
		} 
		if(!$(this).is(':checked')) {
			$("#nav label i").removeClass('la-times-circle').addClass('la-caret-square-down');
		}
		
	});
});



/* -- On-Scroll Update ----- *
 * When the user scrolls down 100px from the 
 * top of the document, trigger a reaction. 
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
