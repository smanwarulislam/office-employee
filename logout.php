<?php
	// start the session
	session_start();
	
	if(session_destroy()) // destroying all sessions
	{
		header('Location: ' . 'login.php'); // redirect to login page
	}
?>