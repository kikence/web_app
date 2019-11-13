<?php
ini_set('display_startup_errors', true);
error_reporting(E_ALL);
ini_set('display_errors', true);

function call($controller, $action) {
	require_once('controllers/' . $controller . '_controller.php');

	switch($controller) {
		case 'pages':
			$controller = new PagesController();
			break;
		case 'events':
			require_once('models/event.php');
			$controller = new EventsController();
			break;
	}

	$controller->{ $action }();
}

$controllers = array('pages' => ['home', 'error', 'manual'],

'events' => ['index', 'show', 'create_page', 'calendar', 'edit_page']);

if (array_key_exists($controller, $controllers)) {
	if (in_array($action, $controllers[$controller])) {
		call($controller, $action);
	} else {
		call('pages', 'error');
	}
} else {
	call('pages', 'error');
}
?>