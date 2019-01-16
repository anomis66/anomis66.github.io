<?php

// ----- ASSIGN API KEY -----
$apikey = "301eb1fd";

// ----- FIND BY SEARCH ----- 
$find = $_GET['f'];
$type = $_GET['type'];
$plot = $_GET['plot'];
$page = $_GET['page'];

// ----- CLEAN SEARCH TERM -----
$query = $_GET['q'];
$query = urlencode(clean_input($query));

// ----- CONSTRUCT URL -----
$url = "http://www.omdbapi.com/?apikey=" . $apikey; 

if ( $_GET['f'] == 's' ) { // GENERAL SEARCH
	$url .= "&s=" . $query;
}
else if ( $_GET['f'] == 't' ) { // TITLE SEARCH
	$url .= "&t=" . $query;
}
else if ( $_GET['f'] == 'i' ) { // IMDB REF SEARCH
	$url .= "&i=" . $query;
}
if ( !empty ( $_GET['page'] ) ) {
	$url .= "&page=" . $page;
} 
else { 
	$page = 1; 
}
if ( !empty ( $_GET['plot'] ) ) {
	$url .= "&plot=" . $plot;
}
if ( !empty ( $_GET['type'] ) ) {
	$url .= "&type=" . $type;
}
// echo ($url);



// ----- CONFIGURE CURL REQUEST -----
$curl = CURL_INIT();

CURL_SETOPT_ARRAY($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $url,
	CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:55.0) Gecko/20100101 Firefox/55.0',
	CURLOPT_FAILONERROR => false
));

$results = CURL_EXEC( $curl );
// ----- DISPLAY ERROR IF SOMETHING GOES WRONG -----
if ( !CURL_EXEC( $curl ) ){
	exit( 'Error: ' . CURL_ERROR( $curl ) . ' - Code: ' . CURL_ERRNO( $curl ) );
}	
// ----- CLOSE REQUEST TO CLEAR UP SOME RESOURCES -----
CURL_CLOSE( $curl );

	
	
// ----- PARSE RESULTS INTO ARRAY() ----- 
$parsed_json = json_decode( $results, true );

// ----- OUTPUT PARSED ARRAY() -----
// print_r($parsed_json);


if (!isset ( $parsed_json['Title'] ) ) {
	echo '<h3 class="error">' . $parsed_json['Error'] . '</h3>';
}


// ----- COUNT RESULTS -----
if ( $_GET['type'] == 'series' ) {
	echo ('<h3 class="info">' . $parsed_json['totalSeasons'] . ' seasons found.</h3>');
}

if (!empty ($parsed_json['totalResults']) ) { 
	$count = $parsed_json['totalResults'];
	echo ('<h3 class="info">' . $count . ' results found.</h3>');
}

// OUTPUT HERE

if (isset ( $parsed_json['Search'] ) ) {
	
	echo ("\n<ol>");
	foreach ($parsed_json['Search'] as $row) {
		$parsed = parse_url($url);
		if (!empty ($parsed['query']) ) {
			$query = $parsed['query'];		
			parse_str($query, $params); 		// Parse the $query into key=>value pairs
			unset($params['f']); 				// Unset search type
			unset($params['s']); 				// Unset search type
			unset($params['page']); 			// Unset search type
			unset($params['apikey']); 			// Unset search type
			$url = http_build_query($params); 	// Rebuild $query without $offset
		}

		echo ("\n	<li>\n");
		if ($row['Poster'] == 'N/A') {
			echo ('		<img src="../../includes/images/no-image.png" alt="No image available" title="No image available" class="poster-small">');
		} else {
			echo ('		<img src="' . $row['Poster'] . '" alt="' . $row['Title'] . '" title="' . $row['Title'] . '" class="poster-small">');
		}
		echo ('		<a href="?f=i&amp;q='. $row['imdbID'] . '">' . $row['Title'] . '</a> (' . $row['Year'] . ") \n");
		echo ('		<a href="//www.imdb.com/title/' . $row['imdbID'] . '" title="View on ' . $row['Title'] . ' on IMDb"><i class="fas fa-link"></i></a>');
		echo ("\n	</li>");
	}
	
	echo ("\n</ol>\n");
}


// ----- PAJINATION -----
if (!empty ($parsed_json['totalResults']) ) { 

	$offset = 10;  // ITEMS PER PAGE

	// ----- GET CURRENT URL -----
	$url = $_SERVER['REQUEST_URI']; 
	
	// ----- PARSE THE URL INTO ARRAY ($URL, $QUERY) -----
	$parsed = parse_url($url);
	
	if (!empty ($parsed['query']) ) {
		$query = $parsed['query'];		
		parse_str($query, $params); 		// Parse the $query into key=>value pairs
		unset($params['page']); 			// Unset $page
		$url = http_build_query($params); 	// Rebuild $query without $offset
	}

	// ----- WORK OUT REMAINING RESULTS -----
	$remain = $count - ($page * $offset);
	
	$pages = ceil($count / $offset);

	// echo (" remain: " . $remain);
	// echo (" pages: " . $pages);

	echo ("\n<h3>");
	if ( $page == 1 && $remain < $offset ) {
		echo ('page ' . $page . ' of ' . $pages); // PAJINATION NOT NEEDED
	} 
	else if ( $page == 1 && $remain > $offset ) {
		echo ('page ' . $page . ' of ' . $pages);
		$page = $page + 1;
		echo (' | <a href="?' .$url. '&page=' .$page. '">Next &raquo;</a>');
	} 
	else if ( $page > 0 && $remain >= 0) {
		$prev = $page - 1;
		echo ('<a href="?' .$url. '&page=' .$prev. '">&laquo; Prev</a> | ');
		echo ('page ' . $page . ' of ' . $pages);
		$page = $page + 1;
		echo ' | <a href="?' .$url. '&page=' .$page. '">Next &raquo;</a>';
	} else 
	if ( $remain <= $offset ) {
		$prev = $page - 1;
		echo '<a href="?' .$url. '&page=' .$prev. '">&laquo; Prev</a> | ';
		echo ('page ' . $page . ' of ' . $pages);
	}
	echo ("</h3>\n");
} 
// ----- END: PAJINATION -----

// exit('Good till ' . __LINE__ );	
	
	

	

if ( ( $_GET['f'] == 'i' ) || ( $_GET['f'] == 't' ) ) {

?>

<form method="post" action="_update.php">

	<h2><?php echo $parsed_json['Title']; ?> <small>(<?php echo $parsed_json['Year']; ?>) [<?php echo $parsed_json['Rated']; ?>]</small></h2>

	<fieldset>
	
	<input type="hidden" name="Title" value="<?php echo $parsed_json['Title']; ?>">
	<input type="hidden" name="Year" value="<?php echo $parsed_json['Year']; ?>">
	<input type="hidden" name="Rated" value="<?php echo $parsed_json['Rated']; ?>">
	<input type="hidden" name="Released" value="<?php echo $parsed_json['Released']; ?>">
	<input type="hidden" name="Runtime" value="<?php echo $parsed_json['Runtime']; ?>">
	<input type="hidden" name="Genre" value="<?php echo $parsed_json['Genre']; ?>">
	<input type="hidden" name="Director" value="<?php echo $parsed_json['Director']; ?>">
	<input type="hidden" name="Writer" value="<?php echo $parsed_json['Writer']; ?>">
	<input type="hidden" name="Actors" value="<?php echo $parsed_json['Actors']; ?>">
	<input type="hidden" name="Plot" value="<?php echo $parsed_json['Plot']; ?>">
	<input type="hidden" name="Language" value="<?php echo $parsed_json['Language']; ?>">
	<input type="hidden" name="Country" value="<?php echo $parsed_json['Country']; ?>">
	<input type="hidden" name="Awards" value="<?php echo $parsed_json['Awards']; ?>">
	<input type="hidden" name="Poster" value="<?php echo $parsed_json['Poster']; ?>">

	<input type="hidden" name="RottenTomatoes" value="<?php echo $parsed_json['Ratings'][1]['Value']; ?>">
	<input type="hidden" name="Metascore" value="<?php echo $parsed_json['Metascore']; ?>">

	<input type="hidden" name="imdbRating" value="<?php echo $parsed_json['imdbRating']; ?>">
	<input type="hidden" name="imdbVotes" value="<?php echo $parsed_json['imdbVotes']; ?>">
	<input type="hidden" name="imdbID" value="<?php echo $parsed_json['imdbID']; ?>">

	<input type="hidden" name="Production" value="<?php echo $parsed_json['Production']; ?>">
	<input type="hidden" name="Website" value="<?php echo $parsed_json['Website']; ?>">

<?php
	if ($parsed_json['Poster'] == 'N/A') {
		echo ('<img src="../../includes/images/no-image.png" alt="No Image Resource Found" id="poster">');
	} else {
?>
		<img src="<?php echo $parsed_json['Poster']; ?>" 
			alt="Poster for <?php echo $parsed_json['Title']; ?>"
			title="'<?php echo $parsed_json['Title']; ?>' on IMDb"
			id="poster">
<?php
	}
?>

	<h3>Starring: <em><?php echo $parsed_json['Actors']; ?></em></h3>
	<p>Directed by: <b><?php echo $parsed_json['Director']; ?></b></p>
	
	<p>
		<a href="//www.imdb.com/title/<?php echo $parsed_json['imdbID']; ?>" title="Check '<?php echo $parsed_json['Title']; ?>' on IMDb"><img src="../../includes/images/imdb-logo-2.png" alt="IMDb logo"></a>
	</p>
	
	<p>
		<label>Format</label>
		<select name="Format">
			<option>DVD</option>
			<option>Bluray</option>
			<option>4K HDR</option>
		</select>
	</p>

<?php 
	if (!empty ($parsed_json['totalSeasons']) ) {
		$seasons = $parsed_json['totalSeasons'];
?>
	<p>
		<label for="Season">Season</label>
		<select name="Season">
<?php
	$x = 1;
	do {
		echo('<option value="' . $x . '">Season ' . $x . '</option>');
		$x++;
	} while ( $x <= $seasons );	
?>
		</select>
	</p>
<?php 
	}
?>

	<p>
		<label for="boxSet">Box Set</label>
		<input type="checkbox" name="boxSet" id="boxSet" value=1>
	</p>

	<p>
		<label for="extended">Extended Version / Director's Cut</label>
		<input type="checkbox" name="extended" id="extended" value=1>
	</p>

	<p>
		<input type="submit" name="Submit" value="I Own This">
	</p>
	
	</fieldset>

</form>

<?php 
}
?>