<?php 
	define("MODEL_TYPE_MYSQL",1);
	define("MODEL_TYPE_PDO",2);


	class DB{

		private $objType;

		public function __construct($objType = MODEL_TYPE_MYSQL){
			$this->objType = $objType;
		}

		public function connect(){
			if($this->objType == MODEL_TYPE_MYSQL)
				return $this->connectMysql();
			else
				return $this->connectPDO();
		}
		private function connectPDO() {
			$db = new \PDO("mysql:host=localhost; dbname=majik_mirror","root","");
			return $db;
		}

		private function connectMysql(){
			$db = new \Mysqli("localhost","root","","majik_mirror");
			if($db->connect_error){
				die($db->connect_error);
			}
			return $db;
		}
	}