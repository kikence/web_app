<?php

/**
 *  We define the class Event with 9 public attributes that represents the model event.
 */

class Event {
	/**
	 * 
	 * $name 
	 * @var string
	 * 
	 * $id 
	 * @var integer
	 * 
	 * $type
	 * @var integer
	 * 
	 * $timestamp
	 * @var integer
	 * 
	 * $details 
	 * @var string
	 * 
	 * $urgency
	 * @var integer
	 * 
	 * $start_date
	 * @var integer
	 * 
	 * $end_date
	 * @var integer
	 * 
	 * $completed 
	 * @var integer
	 * 
	 */
	public $name; 
	public $id;
	public $type;
	public $timestamp;
	public $details;
	public $urgency;
	public $start_date;
	public $end_date;
	public $completed;

	/**
	 * 
	 * Constructor of the event
	 *
	 * @param string $name
	 * @param integer $id
	 * @param integer $type
	 * @param integer $timestamp
	 * @param string $details
	 * @param integer $urgency
	 * @param integer $start_date
	 * @param integer $end_date
	 * @param integer $completed
	 */

	public function __construct($name, $id, $type, $timestamp, $details, $urgency, $start_date, $end_date, $completed) {
		$this->name = $name;
		$this->id      = $id;
		$this->type = $type;
		$this->timestamp = $timestamp;
		$this->details = $details;
		$this->urgency = $urgency;
		$this->start_date = $start_date;
		$this->end_date = $end_date;
		$this->completed = $completed;
	}

	/**
	 * we select all the events from the database
	 *
	 * @return array $list
	 */
	public static function all() {

		$list = [];
		$db = Db::getInstance();
		$req = $db->query('SELECT * FROM events');

		// we create a list of Event objects from the database results
		foreach($req->fetchAll() as $event) {

			$list[] = new Event($event['name'], $event['id'], $event['type'],
				$event['timestamp'], $event['details'],	$event['urgency'], 
				$event['start_date'], $event['end_date'],  $event['completed']);

		}

		return $list;

	}

	/**
	 * We select all the uncompleted events with valid end date
	 *
	 * @return array $list
	 */

	public static function all_open() {

		$list = [];
		$db = Db::getInstance();
		$req = $db->query('SELECT * FROM events WHERE end_date > CURRENT_TIMESTAMP AND completed = 0');

		// we create a list of Event objects from the database results
		foreach($req->fetchAll() as $event) {

			$list[] = new Event($event['name'], $event['id'], $event['type'],  
				$event['timestamp'], $event['details'], $event['urgency'], 
				$event['start_date'], $event['end_date'],  $event['completed']);

		}

		return $list;
	}

	   
	/**
	 * We select all the uncompleted events after the end date
	 *
	 * @return array $list
	 */

	public static function all_open_passed() {

		$list = [];
		$db = Db::getInstance();
		$req = $db->query('SELECT * FROM events WHERE end_date < CURRENT_TIMESTAMP AND completed = 0');

		// we create a list of Event objects from the database results
		foreach($req->fetchAll() as $event) {

			$list[] = new Event($event['name'], $event['id'], $event['type'],  
				$event['timestamp'], $event['details'], $event['urgency'], 
				$event['start_date'], $event['end_date'],  $event['completed']);

		}

		return $list;

	}
	 
	/**
	 * We delete an event from the database
	 *
	 * @param integer $id
	 * @return void
	 */

	public static function delete($id) {

		$db = Db::getInstance();
		// we make sure $id is an integer
		$id = intval($id);
		$req = $db->prepare('DELETE FROM events WHERE id = :id');
		// the query was prepared, now we replace :id with our actual $id value
		$req->execute(array('id' => $id));

	}

	/**
	 * We select the event with the given $id 
	 *
	 * @param [type] $id
	 * @return void
	 */
	public static function find($id) {

		$db = Db::getInstance();
		// we make sure $id is an integer
		$id = intval($id);
		$req = $db->prepare('SELECT * FROM events WHERE id = :id');
		// the query was prepared, now we replace :id with our actual $id value
		$req->execute(array('id' => $id));
		$event = $req->fetch();

		return new Event($event['name'], $event['id'], $event['type'],  
			$event['timestamp'], $event['details'], $event['urgency'], 
			$event['start_date'],  $event['end_date'], $event['completed']);

	    }

	/**
	 * We create the event and insert into the database
	 *
	 * @param string $name
	 * @param integer $type
	 * @param string $details
	 * @param integer $urgency
	 * @param integer $start_date
	 * @param integer $end_date
	 * @return void
	 */

	public static function create($name, $type, $details, $urgency, $start_date, $end_date) {

		$db = Db::getInstance();
		// we make sure $id is an integer
		$req = $db->prepare('INSERT INTO events (name, id, type, timestamp, details, urgency, start_date,  end_date)
			VALUES (:name, NUll, :type, CURRENT_TIMESTAMP, :details, :urgency, :start_date,  :end_date)');

		$req->execute(array('name' => $name, 'type' => $type,
			'details' => $details, 'urgency' => $urgency, 
			'start_date' => $start_date,  'end_date' => $end_date));      
	}

	/**
	 * We modify the event and insert the modified version into the database
	 *
	 * @param integer $id
	 * @param string $name
	 * @param integer $type
	 * @param string $details
	 * @param integer $urgency
	 * @param integer $start_date
	 * @param integer $end_date
	 * @param integer $completed
	 * @return void
	 */

	public static function edit($id, $name, $type, $details, $urgency, $start_date, $end_date, $completed) {

		$db = Db::getInstance();
		// we make sure $id is an integer
		$id = intval($id);

		$req = $db->prepare("UPDATE events SET name=:name, 
												type=:type, 
												details=:details, 
												urgency=:urgency, 
												start_date=:start_date, 
												end_date=:end_date,
												completed=:completed WHERE id=:id");
		$req->execute(array('name' => $name, 
							'type' => $type, 
							'details' => $details, 
							'urgency' => $urgency, 
							'start_date' => $start_date, 
							'end_date' => $end_date,
							'id' => $id,
							'completed'=> $completed));
							
	}
} 

?>