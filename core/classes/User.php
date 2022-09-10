<?php 

	class User{
		public $db,$userID;
		public function __construct(){
			$db = new DB();
			$this->db = $db->connect();
			$this->userID  = $this->getID();
		}

		public function emailExist($email){
			$stmt = $this->db->prepare("SELECT * FROM users WHERE EMAIL = ?");
			$stmt->bind_param('s',$email);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){

				$user =  $result->fetch_assoc();
				$result_user = new StdClass;

				foreach($user as $key=>$value){
					$result_user->{$key} = $value;
				}
				return $result_user;
			}
			return false;
		}

		public function redirect($location){
			header("Location: ".APPLICATION_ROOT.$location);
		}

		public function hash($password){
			return password_hash($password, PASSWORD_DEFAULT);
		}

		public function userData($userID = ''){
			$userID = !empty($userID) ? $userID : $this->userID;
			$stmt = $this->db->prepare("SELECT * FROM users WHERE userID = ?");
			$stmt->bind_param('s',$userID);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){

				$user =  $result->fetch_assoc();
				$result_user = new StdClass;

				foreach($user as $key=>$value){
					$result_user->{$key} = $value;
				}
				return $result_user;
			}
			return false;
		}

		public function loggedIn(){
			return isset($_SESSION['userID']);
		}


		public function logout(){
			$_SESSION = array();
			session_destroy();
			session_regenerate_id();
			$this->redirect('index.php');
		}

		public function getID() {
			if($this->loggedIn())
				return $_SESSION['userID'];
		}
	}