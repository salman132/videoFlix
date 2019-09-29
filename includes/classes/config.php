<?php

class Database{
	public $connection;


	public function __construct(){
		$this->open_db_connection();
	}



	private function open_db_connection(){
		date_default_timezone_set("Asia/Dhaka");

		try{
			$this->connection = new PDO("mysql:dbname=videotube;host=localhost","root","");
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		}
		catch(PDOException $e){
			echo "Connection Failed ". $e->getMessage();
		}
	}

	public function last_insert_id(){
		return last_insert_id($this->connection);
	}


	
}

$db = new Database();








?>