<?php
	session_start(); // start the session 
	
	// check session
	// if no session found, redirect to login page
	if(!isset($_SESSION['username']))
	{
		header('Location: ' . 'login.php'); // redirect to login page
	}
?>