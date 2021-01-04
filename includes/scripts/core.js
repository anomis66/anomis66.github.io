/* ---- CORE FUNCTIONS --- */

$( document ).ready(function() {
    console.log( "$(document).ready!!" );



/* DISPLAY IMAGE TITLE AS CAPTION
–––––––––––––––––––––––––––––––––––––––––––––––––– */
$(".gallery p img").each(
	function(){
		var title = $(this).attr('title');
		var text = '<span class="caption">' + title + '</span>';
		$(this).parent().append(text);
	}
);





/* ----- ----- ----- *
 * jQuery .filter() Search
 * https://stackoverflow.com/questions/7051800/how-to-build-a-simple-table-filter-with-jquery
 * ----- ----- ----- */
$("#quicksearch").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$("#table .record").filter(function() {
		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
});





/* LOAD JSON NAVBAR
–––––––––––––––––––––––––––––––––––––––––––––––––– */
fetch('/includes/nav.json')
.then(function (response) {
	return response.json();
})
.then(function (data) {
	appendData(data);
})
.catch(function (err) {
	console.log(err);
});


function appendData(data) {
	console.log('Records: ' + data.length);
	for (var i = 0; i < data.length; i++) {
		var myList = document.createElement("li");
		myList.innerHTML = '<a href="' + data[i].url + '">' + data[i].title + '</a> <small>('+data[i].date+')</small>';
		// console.log(myList);
		document.getElementById("navbar").appendChild(myList);
	}
}





});
