<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<!-- The above meta tags *must* come first in the head; any other head content must come *after* these tags -->

<meta content='yes' name='apple-mobile-web-app-capable'>
<meta content='black' name='apple-mobile-web-app-status-bar-style'>

<!-- For IE 9 and below. ICO should be 32x32 pixels in size -->
<!--[if IE]><link rel="shortcut icon" href="//www.simonarthur.co.uk/includes/images/favicon.ico"><![endif]-->

<!-- Touch Icons - iOS and Android 2.1+ 180x180 pixels in size. --> 
<link rel="apple-touch-icon-precomposed" href="//www.simonarthur.co.uk/includes/images/anomis66_jack_180s.png">

<!-- Firefox, Chrome, Safari, IE 11+ and Opera. 196x196 pixels in size. -->
<link rel="icon" href="./includes/images/anomis66_jack_196s.png">


<title>simonarthur.co.uk</title>
<meta name="author" content="Simon Arthur (@anomis66)">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" 
	integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" 
	crossorigin="anonymous">

<link rel="stylesheet" href="./../../includes/css/sanitize.css?v8.0.0">
<link rel="stylesheet" href="./../../includes/css/diagnostic.css?v1.0">
<link rel="stylesheet" href="./../../includes/css/default.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" 
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" 
	crossorigin="anonymous"></script>

</head>

<body>



<article>

	<h1>Movie Collection</h1>

	<form method="get">
	
		<fieldset>

		<p>
			Find by:
			<label><input type="radio" name="f" value="s" checked> Search </label>
			<label><input type="radio" name="f" value="t"> Title </label>
			<label><input type="radio" name="f" value="i"> Ref </label>
		</p>

		<p>
			<label for="q">Search for:</label>
			<input type="text" id="q" name="q" placeholder="Search term" autofocus>
		</p>

		<p>
			Type
			<label><input type="radio" name="type" value="movie"> Movie </label>
			<label><input type="radio" name="type" value="series"> TV Series </label>
		</p>

		<p>
			<label for="plot">Plot:</label>
			<select name="plot">
				<option value="">Short</option>
				<option value="full" selected>Full</option>
			</select>
		</p>

		<p>
			<input type="submit">
		</p>

	</fieldset>
	
	</form>

</article>



<aside>

<?php
	
/* ----- ADD PDO CONNECTION ----- */
include_once ('_pdo_cnxn.php');
	
/* ----- FUNCTION TO CLEAN ANY INPUT ----- */	
function clean_input( $data ) {
	$data = trim( $data );
	$data = stripslashes( $data );
	$data = htmlspecialchars( $data );
	return $data;
}
	
	
if (isset ($_GET) ) {

	if (isset ($_GET['f']) && ($_GET['f'] == 's') ) {
		echo "<h2>Find by Search</h2>";
		include_once('_search.php');
	}
	if (isset ($_GET['f']) && ($_GET['f'] == 't') ) {
		echo "<h2>Find by Title</h2>";
		include_once('_search.php');
	}
	if (isset ($_GET['f']) && ($_GET['f'] == 'i') ) {
		include_once('_search.php');
		}

}
	
?>

</aside>



<footer class="hidden-print">
	<hr>
	<p class="hidden-print">Go To <a href="/">Home Page</a><br>
	&copy; Simon Arthur 2018.  All rights reserved.</p>
	<hr>
	<div id="qrcode"></div>
</footer>



<script type="text/javascript">
	//<![CDATA[
	function qrcode(url){
		var code = ('<img src="https://chart.googleapis.com/chart?chs=100x100&amp;cht=qr&amp;choe=UTF-8&amp;chl='+url+'" alt="QR code">');
		document.getElementById("qrcode").innerHTML = code;
	}
	qrcode(location.href);
	//]]>
</script>

</body>

</html>

<?php 
	// exit( '<p>We got as far as line ' . __LINE__ . '".</p>'); 
?>