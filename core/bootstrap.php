<?php 

	session_start();
	require 'classes/DB.php';
	require 'classes/User.php';

	define('APPLICATION_ROOT','http://localhost/webrtc/');
	

	// user object
	$userModel = new User;