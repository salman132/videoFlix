<?php
class User extends DB_Object{

	protected static $db_table = 'users';
	protected static $db_fields = array('id','name','email','password','image');

	public $id;
	public $name;
	public $email;
	public $password;
	public $image;


	public static function user_exist($email){
		global $db;

		$sql = "SELECT *FROM ".self::$db_table . " WHERE email='{$email}'";

		return  self::find_this_query($sql);


	}



	public static function valid_email($email){
		if(filter_var($email,FILTER_VALIDATE_EMAIL)){
			return true;
		}
		else{
			echo "This is not an Email";
			return false;
		}
	}


	public static function verify_user($email,$password){

		if(!empty($email) && !empty($password) && self::valid_email($email)){

			$sql = "SELECT *FROM ". self::$db_table ." WHERE email="."'".$email."'";
			$sql .= " AND password="."'".$password."'";
			$sql .= " LIMIT 1";
			

			$the_result_array = self::find_this_query($sql);
			
			

			return !empty($the_result_array) ? array_shift($the_result_array) : false;
		}
		else{
			echo "You can not leave Username or Password Empty";

			return false;
		}

	}

	




}

$user = new User();



?>