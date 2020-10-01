<?php 
$mysqli = new mysqli("localhost", "root", '', "clasenet");

if ($mysqli->connect_errno) 
{
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
}
else
{
		$response = array();

		$query = "SELECT * FROM USUARIO";

		$prepared_query = $mysqli->prepare($query);

		$prepared_query->execute();
		$result = $prepared_query->get_result();

		$result_array = $result->fetch_all(MYSQLI_ASSOC);

		if(count($result_array)>0)
		{
			$response = ($result_array);
		}

		$prepared_query->close();

		echo json_encode($response);
}

$mysqli->close();

?>