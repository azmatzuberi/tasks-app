<?php
	
	session_start();

	// connect to the database server
	include('includes/connect.inc.php');

	// load all the needed functions into memory
	include('includes/functions.inc.php');

	// secure the page
	check_login();
	
	
	// check if new contact form has been submitted
	if( isset( $_POST[ 'task_description' ] ) ){
		
		$task_description = mysqli_real_escape_string( $db, strip_tags( $_POST[ 'task_description' ] ) );
				
		$query = "INSERT INTO 
						task(task_description)
						VALUES('$task_description')";
					
		$result = mysqli_query( $db, $query ) 
			or die( mysqli_error( $db ) );	
	}

	// define a SELECT query for retrieving information
	$query = 'SELECT * FROM task ORDER BY id ASC';
	
	// send the query to the MySQL server, and store
	// the result set in memory
	$result = mysqli_query( $db, $query ) 
		or die( mysqli_error( $db ) );
	
	// create an empty array to store the data from the database
	$tasks_data = array();
	
	// loop through all of the results from the database
	// while converting each row into an associative array
	while( $row = mysqli_fetch_assoc( $result ) ){
		
		// stick the current row into the end of the $address_book array
		array_push( $tasks_data, $row );
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>fan-Task-tic</title>

		<!-- Stylesheet Link -->
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<header>
			<section>
				<h1>fan-<span>Task</span>-tic</h1>
				<!-- Log Out Button -->
				<h3><a href="logout.php">Logout</a></h3>
			</section>
		</header>
			<!-- Paper Background Start -->
			<article class="paper">
				<dl>

					<!-- Cycle Through Stored Tasks -->
					<?php foreach( $tasks_data as $entry ): ?>
					
					<!-- Text Output With ID Number and Task Name -->
					<dt><?php echo $entry[ 'id' ]; ?>. <?php echo $entry[ 'task_description' ]; ?>
					</dt>			
					<?php endforeach; ?>
				</dl>

				<!-- Form Start -->
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<fieldset>
						<legend>Add a New Task</legend>
						<dl>
							<dt>

								<!-- Task Input -->
								<input type="text" placeholder="Task Name" name="task_description" value="" size="75" maxlength="100" />
							</dt>
						</dl>
						<input type="submit" value="Save" />
					</fieldset>
				</form>
			</article>
		</section>
	</body>
</html>
