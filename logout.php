<?php

	// start the browser session
	session_start();
	
	// delete the login token value
	$_SESSION[ 'logged-in' ] = NULL;
	// delete the logged-in key in the $_SESSION array
	unset( $_SESSION[ 'logged-in' ] );
	
	// delete all the session data associated with this used
	session_destroy();
	
	// send them back to the login page
	header( 'Location: login.php' );