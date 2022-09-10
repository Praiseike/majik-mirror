<?php 
	include "core/bootstrap.php";

	if(!$userModel->loggedIn){
		$userModel->redirect('index.php');
	}

	$userModel->logout();