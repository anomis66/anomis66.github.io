<script src="https://www.simonarthur.co.uk/includes/scripts/md-page.js"></script>

[![Logo](https://www.simonarthur.co.uk/includes/images/anomis66_jack.png "Keep It Simple, Simon")][home]






A listing of my DVD and Blu-ray collection
==========================================

Updated: 5 December 2020

This started life as a [PostgreSQL](https://www.postgresql.org/) learning exercise. Soon it became something using [OMDb API](https://www.omdbapi.com/) and a learning tool more useful to me. Here's [what I've been watching recently](https://m.imdb.com/user/ur90560186/checkins?sort=list_order%2Cdesc&view=grid).

<form action="#" class="hidden-print">
<p><input type="text" name="quicksearch" id="quicksearch" autofocus /><input type="reset" class="btn" /></p>
</form>

<div id="csv-count" class="center">
	<div id="loading"><img src="../../includes/images/loading-gray.gif" alt="Loading ... " title="Loading ... please wait" /></div>
</div>

<div id="csv-list" class="movie">&nbsp;</div>

<script>

/* LOAD TSV OF MOVIES
------------------------------ */

document.getElementById("loading").style.display = ""; // show the loading image

if (window.XMLHttpRequest) {
	// ---- Code for IE7+, Firefox, Chrome, Opera, Safari -----
	xhttp=new XMLHttpRequest();
} 
else {  
	// ----- Code for IE6, IE5 -----
	xhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("loading").style.display = "none"; // hide the loading image
		doStuff(this.responseText); // if successful do stuff with it.
	}
};
var rnd = (Math.random() * (1000-0+1) ) << 0; // random() cache buster;
xhttp.open("GET", "myfilms.tsv?" + rnd, true);
xhttp.send();



// FUNCTION TO DO STUFF WITH AJAX RESPONSE
function doStuff(file) {
	// Add SPACE after commas.
	file = file.replace(/(?:\,)/g, ', ');				
	// replace DELIMITER with next record code
	file = file.replace(/(?:\|)/g, '] [');
	// replace EOL with next record code
	file = file.replace(/(?:\r\n|\r|\n)/g, ']</div><div class="record">[');  
	// replace \N with space
	file = file.replace(/(?:\\N)/g, '&nbsp;');
	// top & tail the output to ensure valid html
	document.getElementById("csv-list").innerHTML = '<div id="table"><div class="record">[' + file + '</div></div>';
}

</script>






------

<ul id="myNavbar" class="columns"></ul>
<script src="https://www.simonarthur.co.uk/includes/scripts/navigation.main.js"></script>

------

&copy; 2021 [Simon Arthur][home].  All rights reserved. | [Legal Stuff][legal]

[home]: <https://www.simonarthur.co.uk/> "Keep It Simple, Simon"
[legal]: <https://www.simonarthur.co.uk/legal.html> "Legal Stuff"