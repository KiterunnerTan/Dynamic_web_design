<?php

	include("functions.php");
	
	//header('Location: index.php');
	// NB the functions.php contains reuseable code, in this case a db connection
	// the header function above redirects to the index.php on completion...
	// ... you mustn't put any HTML before this or it won't work!

	if(isset($_POST['submit'])){

	/* getConnection() function is in the functions.php that is 'included' at the top */
	$mysqli = getConnection();

	$user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
	$pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

	/* create a prepared statement */
	$stmt =  $mysqli->stmt_init();

	if ($stmt->prepare("SELECT id, password, name FROM db_user WHERE email = ?")) {

		$stmt->bind_param("s", $user);

		/* execute query */
		$stmt->execute();
		
		/* bind your result columns to variables, e.g. id column = $post_id */
		$stmt->bind_result($db_uid, $db_hashed_pass, $db_uname);
		
		/* store result */
		$stmt->store_result();
		
		if($stmt->num_rows){// are there any results?
		
			/* fetch the result of the query & loop round the results */
			$stmt->fetch();
				
				//if (password_verify($pass, $db_hashed_pass)) { // not supported by PHP on server
				if(crypt($pass, $db_hashed_pass) == $db_hashed_pass) {
					$_SESSION['userid'] = $db_uid;
					$_SESSION['username'] = $db_uname;
					echo 0;	// our self code that means user verified (email and password match)
				} else {
					echo 2;	// our self code that means incorrect password
				}
			
		} else {
			echo 1;	// our self code that means no email found
		}
	
		/* close statement */
		$stmt->close();
	}

	/* close connection */
	$mysqli->close();
	}



?>