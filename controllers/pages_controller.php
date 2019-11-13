<?php
class PagesController {

	public function home() {
		require_once('views/pages/home.php');
	}

	public function error() {
		require_once('views/pages/error.php');
	}

	public function manual() {
		require_once('views/pages/manual.php');
	}

	public function calendar_index() {
		require_once('views/pages/calendar_index.php');
	}
	
}
?>