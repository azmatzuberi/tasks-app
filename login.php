<?php
	// begins the browser session - makes the $_SESSION array available
	session_start();
	
	// connect to the database server
	include( 'includes/connect.inc.php' );
	
	// load all the needed functions into memory
	include( 'includes/functions.inc.php' );
	
	// attempt a login if the user submits the form
	$errors = login( $db );
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login - fan-Task-tic</title>
		<!-- Stylesheet Link -->
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<header>
			<section>
				<h1>fan-<span>Task</span>-tic</h1>
			</section>
		</header>
		<!-- Sign-In Form -->
		<div id="sign-in">
			<!-- Login Error Checking -->
			<h2>Login</h2>
			<?php echo $errors[ 'email' ]; ?>
			<?php echo $errors[ 'password' ]; ?>
			<form action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>" method="post">
				<!-- Login Credentials Input -->
				<ol>
					<li><input type="text" placeholder="joe@hotmail.com" name="email" size="40" /></li>
					<li><input type="password" placeholder="password" name="password" size="40" /></li>
					<!-- Submit Button -->
					<li><input id="submit-btn" type="submit" value="Sign In" /></li>
				</ol>
			</form>	
		</div>
	</body>
</html>