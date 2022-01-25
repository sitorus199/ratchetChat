<?php 
/**
 * 
 */
class UserChat
{
	
	function __construct(argument)
	{
		require_once("Database_connection.php");

		$database_object = new Database_connection;

		$this->connect = $database_object->connect();
	}
}

 ?>