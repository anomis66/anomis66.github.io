/* LOAD MAIN NAVIGATION
------------------------------ */

fetch('https://www.simonarthur.co.uk/items/news.json')
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
		document.getElementById("myNavbar").appendChild(myList);
	}
}
