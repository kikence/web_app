<!-- This is the create page. The user can create an event -->

<!DOCTYPE html>
<html> 
<head>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<script>
	/**
	* the user can choose the start date and the end date of the event
	*/
	document.addEventListener('DOMContentLoaded', function() {
		$( "#start_date" ).daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 2000,
			maxYear: 2022,
			timePicker: true,
			timePicker24Hour: true,
			locale: { format: 'DD/MM/Y H:mm' }
		});

		$( "#end_date" ).daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			minYear: 2000,
			maxYear: 2022,
			timePicker: true,
			timePicker24Hour: true,
			locale: { format: 'DD/MM/Y H:mm' }
		});

		// Initial setup: today's date
		$('#start_date').on('change',function(e){
			if( $('#sel1').val() == 1 ){
				var selected_start = moment($('#start_date').data('daterangepicker').startDate.format('YYYY-MM-DD'));
				var end_date = selected_start.add(3, 'days').format("DD/MM/YYYY");

				$('#end_date').data('daterangepicker').setStartDate(end_date + " "+$('#start_date').data('daterangepicker').startDate.format('H:mm'));
			}

			if( $('#sel1').val() != 1 ){
				var selected_start = moment($('#start_date').data('daterangepicker').startDate.format('YYYY-MM-DD H:mm'));
				var end_date = selected_start.add(1, 'hours').format("DD/MM/YYYY H:mm");

				$('#end_date').data('daterangepicker').setStartDate(end_date + " "+$('#start_date').data('daterangepicker').startDate.format('H:mm'));
			}
		}) 

		// On change
		$('#sel1').on('change',function(e){
			var optionSelected = $("option:selected", this);
			var valueSelected = this.value;
			console.log(valueSelected);

			/**
			 * Comunicazione data breach
			 * 
			 * if the event's type is Comunicazione data breach then the end date is given by the start date + 3 days
			 * and the urgency changes to "massima urgenza"
			 */
			if( valueSelected == 1 ){
				var selected_start = moment($('#start_date').data('daterangepicker').startDate.format('YYYY-MM-DD'));
				var end_date = selected_start.add(3, 'days').format("DD/MM/YYYY");

				$('#end_date').data('daterangepicker').setStartDate(end_date + " "+$('#start_date').data('daterangepicker').startDate.format('H:mm'));
				$('#urgenza').val(3);
			}

			/**
			 * if the event's type is "Cancellazione dati personali" or "Rettifica dei dati" the urgency changes to "urgente"
			 */
			if( valueSelected == 2 || valueSelected == 3 ){
				var selected_start = moment($('#start_date').data('daterangepicker').startDate.format('YYYY-MM-DD H:mm'));
				var end_date = selected_start.add(1, 'hours').format("DD/MM/YYYY H:mm");

				$('#end_date').data('daterangepicker').setStartDate(end_date + " "+$('#start_date').data('daterangepicker').startDate.format('H:mm'));
				$('#urgenza').val(2);
			}

			/**
			 *  if  the event's type is  "Meeting/Conferenza"or "Altro" the urgency changes to "non urgente"
			 */
			if( valueSelected == 4 || valueSelected == 5 ){
				var selected_start = moment($('#start_date').data('daterangepicker').startDate.format('YYYY-MM-DD H:mm'));
				var end_date = selected_start.add(1, 'hours').format("DD/MM/YYYY H:mm");
				
				$('#end_date').data('daterangepicker').setStartDate(end_date + " "+$('#start_date').data('daterangepicker').startDate.format('DD/MM/YYYY H:mm'));
				$('#urgenza').val(1);
			}
		});
	});
</script>
</head>
<body>

<?php if ($flash == true){ ?>
	<!-- if the event is saved then it shows the following alert -->
	<div class="alert alert-success">
		<strong>Operazione eseguita con successo.</strong> <?php echo $message; ?>.
	</div> 
<?php }; ?>

<!-- creates a button to return to the previous page -->
	<div class="col-12" style="text-align: right;">
		<a class="btn btn-primary"  href=<?php
		if (isset($_GET["from"])){
			if ($_GET["from"] === "calendar") {
				echo "?controller=events&action=calendar";
			} else if ($_GET["from"] === "events"){
				echo "?controller=events&action=index";
			}
		}
		?>>Indietro</a>
	</div>


	<h1 style="text-align: center;">Nuovo Evento</h1>

	<form id="new_event" class="container form-signin" method="get" autocomplete="off">
		<input type="hidden" name="controller" value="events">
		<input type="hidden" name="action" value="create_page">

		<input type="hidden" name="from" value=<?php if (isset($_GET["from"])){ echo $_GET["from"]; } ?>>

		
        <!-- creates a form-group where the user can select the type of the event -->
		<div class="form-group">
			<label for="sel1">Tipologia:</label>
			<select class="operatori" id="sel1" name="type" required="">
				<option disabled selected value>--</option>
				<option value="1">Comunicazione Data Breach</option>
				<option value="2">Cancellazione dati personali</option>
				<option value="3">Rettifica dei dati</option>
				<option value="4">Meeting/Conferenza</option>
				<option value="5">Altro</option>
			</select>
		</div>

		<!-- creates a form-group where the user can select the start_date of the event -->
		<div class="form-group">
			<label>Data ed ora inizio evento</label>
			<input class="form-control " value="<?php echo date("d/m/Y H:i");?>" type="text" placeholder="Data inizio evento" aria-label="Data inizio evento" name="start_date" id="start_date" required="" onkeydown="return event.key != 'Enter';">
		</div>		
		
		<!-- creates a form-group where the user can select the end_date of the event -->
		<div class="form-group">
			<label>Data ed ora fine evento</label>
			<input class="form-control " value="<?php echo date("d/m/Y H:i");?>" type="text" placeholder="Data fine evento" aria-label="Data fine evento" name="end_date" id="end_date" required="" onkeydown="return event.key != 'Enter';">
		</div>
		
        <!-- creates a text area where the user can name the event -->
		<div class="form-group">
			<label>Titolo</label>
			<input class="form-control " type="text" placeholder="Titolo" aria-label="titolo" name="name" id="name" required="" onkeydown="return event.key != 'Enter';">
		</div>
	
		<!-- creates a text area where the user can write details for the event -->
		<div class="form-group">
			<label>Dettagli</label> 		
			<textarea class="form-control " rows="5" type="text" placeholder="Dettagli" aria-label="Dettagli" name="details" id="details" ></textarea>
		</div> 
		 
		
		<!-- creates a form-group where the user can select the urgency of the event -->
		<div class="form-group">
			<label for="urgenza">Urgenza:</label>
			<select class="operatori" id="urgenza" name="urgency">
				<option value=1>Non urgente</option>
				<option value=2>Urgente</option>
				<option value=3>Massima urgenza</option>
			</select>
		</div>
		
		<!-- creates a button for the creation of the event -->
		<div class="form-group">
			<button class="btn btn-primary col-md-12 " type="submit" >Crea</button>
		</div>
	</form>

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