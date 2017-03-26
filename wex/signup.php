<?php

	include("functions.php");
	
	//header('Location: index.php');
	// NB the functions.php contains reuseable code, in this case a db connection
	// the header function above redirects to the index.php on completion...
	// ... you mustn't put any HTML before this or it won't work!

	if(isset($_POST['submit'])){

	/* getConnection() function is in the functions.php that is 'included' at the top */
	$mysqli = getConnection();

	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
	$pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

	/* create a prepared statement */
	$stmt =  $mysqli->stmt_init();

	if ($stmt->prepare("SELECT id FROM db_user WHERE email = ?")) {

		$stmt->bind_param("s", $user);

		/* execute query */
		$stmt->execute();
		
		/* bind your result columns to variables, e.g. id column = $post_id */
		$stmt->bind_result($db_uid);
		
		/* store result */
		$stmt->store_result();
		
		if($stmt->num_rows){// are there any results?
			echo 1;	// our self code that means email already exist
		} else {

			$stmt = $mysqli->stmt_init();
			
			$sql = "INSERT INTO db_user (email, password, name) VALUES (?, ?, ?)";

			if ($stmt->prepare($sql)) {
				$hashed_pass = better_crypt($pass);
				
				$stmt->bind_param("sss", $user, $hashed_pass, $name);
				/* execute query */
				$stmt->execute();
				echo 0;
			}
			

		}
	
		/* close statement */
		$stmt->close();
	}

	/* close connection */
	$mysqli->close();
	}



?>