$(document).ready(function () {
/* ----- ----- ----- *
* jQuery .filter() Search
* https://stackoverflow.com/questions/7051800/how-to-build-a-simple-table-filter-with-jquery
* ----- ----- ----- */
	$("#quicksearch").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("table tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

});