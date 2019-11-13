<?php


// DEFAULT MONTH/YEAR = TODAY
// $unix = strtotime("today");
// $monthNow = date("M", $unix);
// $yearNow = date("Y", $unix); 

// the html page creates a botton which redirect the user to the create page; 
// we create the legend with the type of the events (icons) and the urgency of the events (colored rectangles)

$event_urgency = [
	"#4357AD",
	"#e0ba3e",
	"#bc1010"
];

$event_type = [
	"🔓",
	"✖️",
	"✍️",
	"👪",
	"☷"
]


?>
<!DOCTYPE html>
<html>
<head>
	<link href='src/calendar/core/main.css' rel='stylesheet' />
	<link href='src/calendar/daygrid/main.css' rel='stylesheet' />
	<script src='src/calendar/core/main.js'></script>
	<script src='src/calendar/interaction/main.js'></script>
	<script src='src/calendar/daygrid/main.js'></script>
	<script>
	/**
	*  Creates the calendar and shows the inserted events with their title, url, color, start date and end date
	*/
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: [ 'interaction', 'dayGrid' ],
			defaultDate: new Date(),
			editable: false,
						eventLimit: true, // allow "more" link when too many events
						disableDragging: true,
						events: [
						<?php foreach ($events as $event): ?>
							{
								title: "<?php echo $event_type[$event->type-1], " ", $event->name; ?>",
								url: "<?php echo $_SERVER['REQUEST_URI'];?>/?controller=events&action=show&id=<?php echo $event->id; ?>&from=calendar",
								color: "<?php echo $event_urgency[$event->urgency-1]; ?>",
								start: "<?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $event->start_date);  echo $date->format('Y-m-d'); ?>",
								end: "<?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $event->end_date);  echo $date->format('Y-m-d') ?>",
							},
						<?php endforeach; ?>
						]
					});
		calendar.render();
	});
</script>
</head>

<body>
	<div class="col-11" style="text-align: right;">
		<a class="btn btn-primary" href='?controller=events&action=create_page&from=calendar'>&nbsp;Crea nuovo evento&nbsp;</a>
	</div>

	<hr>
	<?php if (count($events) == 0):  ?>
		<h1>Nessun evento in calendario</h1>
		<br>
		<br>
		<br>
		<?php else: ?>
			<div id='calendar'></div>
		<hr>
	<?php endif; ?>
	<p> <b> Legenda tipologia evento: </b></p>
	<div>
		<span>
			<svg width="15" height="15"> 
				<rect width="15" height="15" style="fill:#4357AD;"/> 
			</svg> 
		</span>- Non urgente
		&nbsp; &nbsp; &nbsp;
		<span>
			<svg width="15" height="15">
				<rect width="15" height="15" style="fill:#e0ba3e;"/> 
			</svg> 
		</span>- Urgente
		&nbsp; &nbsp; &nbsp;
		<span> 
			<svg width="15" height="15"> 
				<rect width="15" height="15" style="fill:#bc1010;"/> 
			</svg> 
		</span>- Massima urgenza
		&nbsp; &nbsp; &nbsp;
	</div>
	<p>
		🔓 - Comunicazione Data Breach &nbsp; &nbsp; &nbsp;
		✖️ - Cancellazione dati personali &nbsp; &nbsp; &nbsp;
		✍️ - Rettifica dei dati &nbsp; &nbsp; &nbsp;
		👪 - Meeting/Conferenza &nbsp; &nbsp; &nbsp;
		☷ - Altro
	</p>
</body>
<hr>
<span style="display:block; height: 50px;"></span>
<footer> 
	<div class="row">
		<div class="col-md-6">
			<p style="font-size:12px;" > <b> © EXCELSIOR 2019  </b> </p>
			<p> <img style="width:10%" src="src/cropped-logo-png.png"> </p>
		</div>
		<div class="col-md-6">
			<p style="font-size:10px;"> <b> INFO EXCELSIOR  </b> </p>
			<p style="font-size:10px;">Via delle Scienze, 206 - 33100 UD, Italia</p>
			<p style="font-size:10px;">info@excelsior.com</p>
			<p style="font-size:10px;">tel. 0432 000000</p>
		</div>
		
	</div>
</footer>
<style>
	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}
</style>
</html>