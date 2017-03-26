<?php

	include("functions.php");
	header('Location: index.php');

	$_SESSION = array(); // recasting the session to remove existing variables

	// Finally, destroy the session.
	session_destroy();

?>