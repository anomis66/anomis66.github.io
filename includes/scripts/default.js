/* --- DEFAULT SCRIPTS ----- */



$('[data-fancybox]').fancybox({
	protect: true
})



/* --- change icon on menu ----- ----- */
$("input#menu").change(function() {
	if(this.checked) {
		$("input#menu .las").removeClass('la-bars').addClass('la-caret-down');
	}
});



$('input#menu').mousedown(function() {
    if (!$(this).is(':checked')) {
		$("input#menu .las").removeClass('la-bars').addClass('la-caret-down');
    }
});



// When the user scrolls down 50px from the top of the document, resize the header's font size
window.onscroll = function() {
	scrollFunction()
};

function scrollFunction() {
	
	if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
		$('#header').addClass("narrow").removeClass("broad");
		$('#header h1').addClass("hidden").removeClass("inline");
		$('#button-top').addClass("inline").removeClass("hidden");
	} else {
		$('#header').addClass("broad").removeClass("narrow");
		$('#header h1').addClass("inline").removeClass("hidden");
		$('#button-top').addClass("hidden").removeClass("inline");
	}
	
}
