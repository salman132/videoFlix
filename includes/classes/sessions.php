<?php

class Session{
	public $user_id;
	public $msg;
	public $login = false;

	public function __construct(){
		session_start();
		$this->check_the_login();
		$this->checkFlush();
	}

	public function is_signed_in(){
		return $this->login;
	}


	public function login($user){
		if($user){
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->login = true;
		}
	}

	public function logout($user){
		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->login = false;
	}


	private function check_the_login(){
		if(isset($_SESSION['user_id'])){
			$this->login = true;
		}
		else{
			;
			unset($this->user_id);
			$this->login= false;
		}
	}
	public static function flush($msg){
		if(!empty($msg)){
			$_SESSION['message']= $msg;
		}
		else{
			return $this->message;
		}
	}
	private function checkFlush(){
		if(isset($_SESSION['message'])){
			$this->msg = $_SESSION['message'];
			unset($_SESSION['message']);
		}
		else{
			$this->msg = "";
		}
	}





}




$session = new Session();



?>