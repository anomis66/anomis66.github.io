<?php

$data_pdo = 'pgsql'; // pgsql, mysql, (MS)sqlsrv, (ORACLE) oci, odbc

/* --- Test --- */
$data_server = 'localhost';
$data_port = '5432';
$data_db = 'arthur';
$data_schema = 'imdb';
$data_user = 'postgres';
$data_pass = 'postgres';
/* --- Test --- */


// Test database connection ($pdo)
try {
	$pdo = new PDO($data_pdo.":host=".$data_server.";port=".$data_port.";dbname=".$data_db,$data_user,$data_pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	$api_array_null = array(
		'Provider' => $provider, 
		'Description' => $description,
		'Support' => $support, 	
		'Status' => $e->getMessage(),
	);
	header('Content-type: text/javascript');
	header('Access-Control-Allow-Origin: *');  
	echo json_encode($api_array_null, JSON_PRETTY_PRINT);			
	exit();
}
?>