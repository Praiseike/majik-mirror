<?php 
	include 'core/bootstrap.php';
	if(!$userModel->loggedIn()){
		$userModel->redirect('index.php');
	}

	$user = $userModel->userData();
	echo $user->name;