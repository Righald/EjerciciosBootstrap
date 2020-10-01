<?php 
$conn = new mysqli("localhost", "root", '', "clasenet");
 
function conn()
{
	if($conn)
	{
		return $conn;
	}
	else
	{
		$conn->connect_errno;
		printf("Falló la conexión: %s\n", $mysqli->connect_error);
		return null;
	}
}

?>