<?php
include_once('connection.php');

class userController
{
	function get()
	{
		$mysqli = conn();
		
		if(!$mysqli->connect_error)
		{
			$response = array();

			$query = "SELECT * FROM USUARIO";

			$prepared_query = $mysqli->prepare($query);

			$prepared_query->execute();
			$result = $prepared_query->get_result();

			$result_array = $result->fetch_all(MYSQLI_ASSOC);

			$prepared_query->close();

			return $response;
		}
		else
		{
			return array();
		}
	}
}

?>