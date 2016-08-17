<?php
	
	 /**
	 * check_login : Asserts whether the current user is logged in, if not
	 * redirects them to the login page. If the redirect fails, PHP execution
	 * is halted.
	 */
	function check_login(){
		// check that the user is logged in
		if( strcmp( $_SESSION[ 'logged-in' ], LOGIN_TOKEN ) != 0 ){
			// user is not logged in or there is something wrong
			// with the user's session ... kick them out
			header( 'Location: login.php' );
			exit( '<h1>nope!</h1>' );
		}
	}
	
	/**
	 * login : Accepts a login form submission and compares it to the user data in the
	 * users table.  A successful match will result in the user being logged in, otherwise
	 * error messages are returned.
	 * @param resource $db MySQL database link resource
	 * @return array Error messages generated on an unsuccessful login attempt
	 */
	function login( $db ){
		
		// array to store error messages
		$errors = array();
		
		if( isset( $_POST[ 'email' ] ) ){
			// form has been submitted
	
			// clean up form data
			$email 		= mysqli_real_escape_string( $db, trim( $_POST[ 'email' ] ) );
			$password 	= sha1( $_POST[ 'password' ] );
			
			// query the database for a user with the entered email
			$query = "SELECT email, password FROM address_book_users
							WHERE email = '$email' LIMIT 1";
			
			// execute the query on the MySQL server
			$result = mysqli_query( $db, $query ) 
				or die( mysqli_error( $db ) );
			
			// check if we got at least one row from the database
			if( mysqli_num_rows( $result ) >= 1 ){
				// user exists in the database
				$row = mysqli_fetch_assoc( $result );
				
				/* echo 'Password from the database: ' . $row[ 'password' ];
				echo '<br> Password entered: ' . $_POST[ 'password' ];
				echo '<br> Password entered (encrypted): ' . $password; */
				
				// compare password from database to entered password
				if( strcmp( $password, $row[ 'password' ] ) == 0 ){
				
					// if passwords match - go ahead and log user in
					$_SESSION[ 'logged-in' ] = LOGIN_TOKEN;
					
					// send the user to the index page, since they are allowed to see it
					header( 'Location: index.php' );
				} else { // passwords in strcmp() did not match
					
					// if not show an error message
					$errors[ 'password' ] = '<p class="error">The password you entered was incorrect.</p>';
				}
				
			} else { // if no rows come from the database ( mysqli_num_rows( $result ) returns 0 ) 
				// user does not exist in the database
				// show an error message
				$errors[ 'email' ] = '<p class="error">The email you entered does not exist in the database.</p>';
			}
		}
		
		return $errors;
	}