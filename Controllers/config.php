<?php 

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if (!isset($_SESSION)) {
		session_start();
	}

	if (!defined('BASE_PATH')) {
		define('BASE_PATH',"http://localhost:8888/programacion_avanzada_en_internet_canvas/");
	}

?>