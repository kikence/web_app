<?php


class EventsController {

	/**
	 * A message is shown after the deletion of an event
	 *
	 * @return void
	 */

	public function index() {

		$flash = false;    
		if (isset($_GET['remove_id'])){

			$event = Event::delete($_GET['remove_id']);
			$flash = true;
			$message = 'Evento eliminato correttamente';

		} 

		$events = Event::all(); 
		require_once('views/events/index.php'); 

	}  

	/**
	 * Shows all the events saved on the calendar
	 *
	 * @return void
	 */

	public function calendar() {

		$flash = false;
		$events = Event::all(); 
		require_once('views/events/calendar.php'); // redirects the user to the calendar page

	}  
	  
	/**
	 * Shows the details of the event
	 *
	 * @return void
	 */

	public function show() {

		$flash = false;

		// without an id we just redirect to the error page as we need the event id to find it in the database
		if (!isset($_GET['id']))
			return call('pages', 'error');

			// we use the given id to get the right event
		$event = Event::find($_GET['id']);
		require_once('views/events/show.php'); // redirects the user to the show page

	}

	/**
	 * A message is shown after the creation of an event
	 *
	 * @return void
	 */

	public function create_page() {

		$flash = false;

		if ( isset($_GET['name']) && isset($_GET['type']) && isset($_GET['details']) 
	    	&& isset($_GET['urgency']) && isset($_GET['start_date']) && isset($_GET['end_date'])) {
	    	
			$event = Event::create($_GET['name'], $_GET['type'], $_GET['details'], $_GET['urgency'],
				DateTime::createFromFormat('d/m/Y H:i', $_GET['start_date'])->format('Y-m-d H:i'),  
				DateTime::createFromFormat('d/m/Y H:i', $_GET['end_date'])->format('Y-m-d H:i'));
			$flash = true;
			$message = 'Evento creato correttamente';

		}

		require_once('views/events/create_page.php'); // redirects the user to the create page

	}

	/**
	 * A message is shown after the modification of an event
	 *
	 * @return void
	 */

	public function edit_page() {

		$flash = false;
		if (!isset($_GET['id'])){

			return call('pages', 'error');

		}

		// we use the given id to get the right event
		$event = Event::find($_GET['id']);
		if ( isset($_GET['name'])  && isset($_GET['type']) && isset($_GET['details'])
			&& isset($_GET['urgency']) && isset($_GET['start_date']) && isset($_GET['end_date'])) {

			if( isset($_GET['completed']) ){

				$completed = $_GET['completed'];

			} else {

				$completed = 0;
			}

			$event = Event::edit($_GET['id'], $_GET['name'], $_GET['type'], $_GET['details'],  
				$_GET['urgency'], $_GET['start_date'], $_GET['end_date'], $completed);

			$flash = true;
			$message = 'Evento modificato correttamente';
			unset($_GET['name']);
			unset($_GET['type']);
			unset($_GET['details']);
			unset($_GET['urgency']);
			unset($_GET['start_date']);

		}  
		
		$event = Event::find($_GET['id']);
		require_once('views/events/edit_page.php'); // redirects the user to the edit page
	}
}

?>