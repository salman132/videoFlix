<?php

class Category extends DB_Object{
	protected static $db_table = 'categories';
	protected static $db_fields = array('id','name');

	public $id;
	public $name;
}

?>