<?php

	define( 'DB_HOST', 		'localhost' );
	define( 'DB_NAME', 		'azmatzub_main' );
	define( 'DB_USER', 		'azmatzub_main' );
	define( 'DB_PASSWORD', 	'Or8=,2~!aZW2' );
	
	$db = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME )
	or die( mysqli_error( $db ) );

?>