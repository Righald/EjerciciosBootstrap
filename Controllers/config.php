<?php 
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if(!isset($_SESSION))
	{
		session_start();
	}
	
	//Borrar si se usan rutas de forma relativa, útil para rutas absolutas
	if(!defined('BASE_PATH'))
	{
		define('BASE_PATH', "localhost/Bootstrap/public/");
	}

?>