<?php
	
include('./_pdo_cnxn.php');
	
/* 
##### ##### ##### ##### ##### ###### ##### ##### ##### ###### ##### 
##### FUNCTION TO CLEAN ANY INPUT
##### ##### ##### ##### ##### ###### ##### ##### ##### ###### ##### 
*/	
function clean_input( $data ) {
	$data = trim( $data );
	$data = stripslashes( $data );
	$data = htmlspecialchars( $data );
	return $data;
}


	if (isset ($_POST) ) {
	echo('<pre>');
	print_r($_POST);
	echo('</pre>');
}

if (isset ( $_POST['Submit'] ) && !empty ($_POST['imdbID']) ) {
	
	// CHECK IF IT'S ALREADY IN THERE
	$imdbid = $_POST['imdbID'];

	$sql  = "
		SELECT * 
		FROM imdb.myfilms 
		WHERE imdbid = :imdbid ";

	// CHECK FOR EXISTING FORMAT
	if (isset ($_POST['Format']) ) {
		$format = $_POST['Format'];
		$sql .= "AND format = :format ";
	}
	
	// CHECK FOR EXISTING SEASON
	if (isset ($_POST['Season']) ) {
		$season = $_POST['Season'];
		$sql .= "AND season = :season ";
	}
	
	// CHECK FOR EXISTING BOXSET
	if (isset ($_POST['boxSet']) ) { 
		$boxset = 'Yes';
	} else {
		$boxset = 'No';
	}
	$sql .= "AND boxset = :boxset ";

	// CHECK FOR EXISTING VERSION
	if (isset ($_POST['extended']) ) { 
		$extended = 'Yes';
	} else {
		$extended = 'No';
	}
	$sql .= "AND extended = :extended ";

	$stmt = $pdo->prepare($sql);
	
	$stmt->bindParam(':imdbid', $imdbid); 

	if (isset ($_POST['Format']) ) {
		$stmt->bindParam(':format', $format); 
	}
	if (isset ($_POST['Season']) ) {
		$stmt->bindParam(':season', $season); 
	}
	$stmt->bindParam(':boxset', $boxset); 
	$stmt->bindParam(':extended', $extended); 
	
	$stmt->execute();

	$check = $stmt->fetchAll();
	
	$count = count($check);

}



if ($count > 0) {
	$title = $check[0]['title'];
	echo("<h2>The title '$title' is already registered in the database.</h2>");
}
else {

	if (isset ( $_POST['Submit'] ) ) {
		
		$title = $_POST['Title'];
		
		$re = "/^(The )/gi";
		if ( strpos( $re, $title ) !== false ) {
			// if 'the is found a t the front of the string move it to the back with a comma
			// i.e. 'The Beatles' becomes 'Beatles, The'
			$words = explode(" ", $title);
			$count = count($words);
			$i = 1;
			while( $i <= $count ) {
				$titled .= $word[$i];
			}
			$titled .= ', ' . $word[0];
		}
		
		$year = $_POST['Year'];
		$rated = $_POST['Rated'];
		$released = $_POST['Released'];
		$runtime = $_POST['Runtime'];
		$genre = $_POST['Genre'];
		$director = $_POST['Director'];
		$writer = $_POST['Writer'];
		$actors = $_POST['Actors'];
		$plot = $_POST['Plot'];
		$language = $_POST['Language'];
		$country = $_POST['Country'];
		$awards = $_POST['Awards'];
		$poster = clean_input($_POST['Poster']);

		$rottentomatoes = clean_input($_POST['RottenTomatoes']);
		$metascore = $_POST['Metascore'];
		$imdbrating = $_POST['imdbRating'];
		$imdbvotes = $_POST['imdbVotes'];

		$imdbid = $_POST['imdbID'];
		$production = $_POST['Production'];
		$website = $_POST['Website'];

		$format = $_POST['Format'];

		if (!empty ($_POST['boxSet']) ) { 
			$boxset = 'Yes';
		} else {
			$boxset = 'No';
		}
		if (!empty ($_POST['Season']) ) {
			$season = $_POST['Season'];
		}
		if (!empty ($_POST['extended']) ) {
			$extended = 'Yes';
		} else {
			$extended = 'No';
		}

	/*
	INSERT INTO table_name (column1, column2, column3, ...)
	VALUES (value1, value2, value3, ...);
	*/
		$sql  = "INSERT INTO imdb.myfilms (
			title, year, rated, released, runtime, genre, 
			director, writer, actors, plot,
			language, country, awards, poster,
			rottentomatoes, metascore, imdbrating, imdbvotes, imdbid, 
			production, website,
			format, boxset, season, extended
		)";
		$sql .= "VALUES (
			:title, :year, :rated, :released, :runtime, :genre, 
			:director, :writer, :actors, :plot,
			:language, :country, :awards, :poster,
			:rottentomatoes, :metascore, :imdbrating, :imdbvotes, :imdbid, 
			:production, :website,
			:format, :boxset, :season, :extended
		)";

		$insert = $pdo->prepare($sql);
		$insert->execute( array(
			':title'=>$title,
			':year'=>$year,
			':rated'=>$rated,
			':released'=>$released,
			':runtime'=>$runtime,
			':genre'=>$genre,
			
			':director'=>$director,
			':writer'=>$writer,
			':actors'=>$actors,
			':plot'=>$plot,
			
			':language'=>$language,
			':country'=>$country,
			':awards'=>$awards,
			':poster'=>$poster,
			
			':rottentomatoes'=>$rottentomatoes, 
			':metascore'=>$metascore, 
			':imdbrating'=>$imdbrating, 
			':imdbvotes'=>$imdbvotes, 
			':imdbid'=>$imdbid, 

			':production'=>$production,
			':website'=>$website,
			
			':format'=>$format,
			':boxset'=>$boxset,
			':season'=>$season,
			':extended'=>$extended
		) );

		echo '<h1 class="success">"' . ucwords($title) . '" inserted successfully</h1>';

	} // $_POST

} // CHECK

echo '<p><a href="./add">Add</a> |';
echo '| <a href="./index.htm">View ?</a></p>';

?>