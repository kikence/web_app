<?php

ini_set('display_startup_errors', true);
error_reporting(E_ALL);
ini_set('display_errors', true);

class Db {
	private static $instance = NULL;
	
	private function __construct() {}
	private function __clone() {}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			try {
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				self::$instance = new PDO('mysql:host=localhost;dbname=mydatabase', 'root', 'passwdkikence', $pdo_options); # CAMBIA QUI LE IMPOSTAZIONI
			} catch (PDOException $e) {
				echo 'Connection failed: ' . $e->getMessage();
			}
		}
		return self::$instance;
	}
}
?>