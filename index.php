<?php 

	include 'core/bootstrap.php';
	if($userModel->loggedIn()){
		$userModel->redirect('home.php');
	}
	$error = null;

	if($_SERVER['REQUEST_METHOD'] === "POST"){
		if(isset($_POST)){
			$email = trim(stripcslashes(htmlentities($_POST['email'])));
			$password = $_POST['password'];

			if(!empty($email) && !empty($password)){
				//
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error = "Invalid Email format";
				}else{
					if($user = $userModel->emailExist($email)){
						if(password_verify($password,$user['password'])){
							session_regenerate_id();
							$_SESSION['userID'] = $user['userID'];
							$userModel->redirect('home.php');
						}else{
							$error = "Incorrect Email or Password";
						}
					}else{
						$error = "User does not exist";
					}
				}
			}else{
				$error = "Inputs cannot be empty";
			}

		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Majik mirror</title>
	<!-- <link rel="stylesheet" href="assets/css/bootstrap.css"> -->
	<link rel="stylesheet" href="assets/bootstrap-5.0.2-dist/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
	
	<main class="container">
		<div class="form-container container shadow-sm">
			<div class="mx-auto w-75">
				<img src="assets/images/svg/profile.svg" class="login_profile" alt="">
				<form action="" class="pt-4" method="POST" accept-charset="utf-8">
					<input type="hidden" name="_token" value="felnrtyjFJLIhfUEH&yI(9ro3u23r23">						
					<div class="form-group mb-3">
						<input type="email" class="form-input" placeholder="Email" name="email">
					</div>
					<div class="form-group mb-3">
						<input type="password" class="form-input" placeholder="Password" name="password">
					</div>
					<span class="error">
						<?= $error ?>
					</span>
					<button type="submit" class="btn">submit</button>
				</form>
				<a href="#" class="" title="" style="float:right;">forgot password</a>

				
			</div>
		</div>
		</div>
	</main>


	<script src="assets/js/bootstrap.js"></script>
</body>
</html>