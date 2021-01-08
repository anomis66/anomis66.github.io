<script src="https://www.simonarthur.co.uk/includes/scripts/md-page.js"></script>

[![Logo](https://www.simonarthur.co.uk/includes/images/anomis66_jack.png "Keep It Simple, Simon")][home]







<div style="float: right">

![#SpeakHisName](https://www.simonarthur.co.uk/includes/images/bumble-bee_150s.png "Bumble Bee")

</div>

A listing of my Terry Pratchett collection
==========================================

<blockquote id="quotes"></blockquote>
<script src="https://www.simonarthur.co.uk/includes/scripts/random.quotes.pratchett.js"></script>

<form action="#">
	<p><input type="text" name="quicksearch" id="quicksearch" autofocus /><input type="reset" /></p>
</form>

<div id="loading">
	<img src="https://www.simonarthur.co.uk/includes/images/loading-gray.gif" alt="Loading ... " width="100" />
</div>

<div id="csv-list">&nbsp;</div>

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
xhttp.open("GET", "mybooks.tsv?" + rnd, true);
xhttp.send();

/* FUNCTION TO DO STUFF WITH AJAX RESPONSE
------------------------------ */
function doStuff(file) {
	// Add SPACE after commas.
	file = file.replace(/(?:\,)/g, ', ');				
	// replace DELIMITER with next record code
	file = file.replace(/(?:\|)/g, '</td><td>');
	// replace EOL with next record code
	file = file.replace(/(?:\r\n|\r|\n)/g, '</tr><tr><td>');  
	// replace \N with space
	file = file.replace(/(?:\\N)/g, '&nbsp;');
	// top & tail the output to ensure valid html
	document.getElementById("csv-list").innerHTML = '<table><tr><td>' + file + '</tr></table>';
}
</script>

<script src="https://www.simonarthur.co.uk/includes/scripts/jquery-3.5.1.min.js"></script>
<script src="https://www.simonarthur.co.uk/includes/scripts/quick-filter.js"></script>





------

<ul id="myNavbar" class="columns"></ul>
<script src="https://www.simonarthur.co.uk/includes/scripts/navigation.main.js"></script>

------

&copy; 2021 [Simon Arthur][home].  All rights reserved. | [Legal Stuff][legal]

[home]: <https://www.simonarthur.co.uk/> "Keep It Simple, Simon"
[legal]: <https://www.simonarthur.co.uk/legal.html> "Legal Stuff"