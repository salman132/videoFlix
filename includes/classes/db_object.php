<?php

class DB_Object{
	protected static $db_table = "users";



	public static function find_all(){
		return static::find_this_query("SELECT *FROM ". static::$db_table ." ");
	}

	public static function findById($id){

		$the_result_array = static::find_this_query("SELECT *FROM ". static::$db_table ." WHERE id='$id'");
		return !empty($the_result_array) ? array_shift($the_result_array) : false;

	}

	protected static function find_this_query($sql){

		global $db;
		$the_object_array = array();

		$result = $db->connection->prepare($sql);
		$result->execute();

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			$the_object_array[] = static::instantation($row);
		}

		return $the_object_array;

	}

	protected static function instantation($row){

		$calling_class = get_called_class();

		$userObj = new $calling_class;


		foreach ($row as $attribute => $value) {
				
				if($userObj->hasTheAttribute($attribute)){

					$userObj->$attribute = $value;
				}
		}



		return $userObj;


	}

	private function hasTheAttribute($attribute){
		$obj_properties = get_object_vars($this);
		

		return array_key_exists($attribute,$obj_properties);


	}

	protected function properties(){
		$properties = array();

		foreach (static::$db_fields as $db_field) {
			
			if(property_exists($this,$db_field )){

				$properties[$db_field] = $this->$db_field;
			}
		}

		return $properties;
	}

	public function create(){
		global $db;
		$properties = $this->properties();

		$sql = "INSERT INTO ".static::$db_table ." (". implode(",", array_keys($properties)) .")";
		$sql .= "VALUES ('".implode("','", array_values($properties)). "')";

	

		$result = $db->connection->prepare($sql);
		return $result->execute();
	}

	public function update(){
		global $db;

		$properties = $this->properties();

		$properties_pair = array();

		foreach ($properties as $key => $value) {
			
			$properties_pair[]= "{$key}='{$value}'";
		}

		$sql = "UPDATE ".static::$db_table." SET ".implode(",", $properties_pair);
		$sql .= " WHERE id='{$this->id}'";
		

		$result = $db->connection->prepare($sql);

		return $result->execute();
	}

	public function delete(){
		global $db;
		
	
		$sql = "DELETE FROM ". static::$db_table  ." WHERE id='{$this->id}'";

		

		$result = $db->connection->prepare($sql);

		return $result->execute();
		
	}














}




















?>