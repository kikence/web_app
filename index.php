<?php
ini_set('display_errors', 'On'); 
error_reporting(0); 
require_once('connection.php');

if (isset($_GET['controller']) && isset($_GET['action'])) {
	$controller = $_GET['controller'];
	$action     = $_GET['action'];
} else {
	$controller = 'pages';
	$action     = 'home';
}

require_once('views/layout.php');
?>