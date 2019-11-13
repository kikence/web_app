<!-- This is the edit page. The user can modify the event.  -->


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
		* the user can choose the start date and end date to modify the event
		*/
		document.addEventListener('DOMContentLoaded', function() {
			$( "#start_date" ).daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				minYear: 2000,
				maxYear: 2022,
				timePicker: true,
				timePicker24Hour: true,
				locale: { format: 'Y-M-DD H:mm' }
			});

			$( "#end_date" ).daterangepicker({
				singleDatePicker: true,
				showDropdowns: true,
				minYear: 2000,
				maxYear: 2022,
				timePicker: true,
				timePicker24Hour: true,
				locale: { format: 'Y-M-DD H:mm' }
			});

		});
	</script>

</head>

<body>
	<?php if ($flash && $flash == true){ ?>

		<!-- if the event is saved then it shows the following alert -->
		<div class="alert alert-success">
			<strong>Operazione eseguita con successo.</strong> <?php echo $message; ?>.
		</div> 
	<?php }; ?>

	<!-- creates a button to return to the previous page -->
	<div class="col-12" style="text-align: right;">
		<a class="btn btn-primary"  href=<?php
		if (isset($_GET["show"])){
			if ($_GET["show"] === "true") {
				?>
				'?controller=events&action=show&id=<?php echo $event->id; ?>&from=<?php if (isset($_GET["from"])){ echo $_GET["from"]; } ?>'
			<?php }
		} else if (isset($_GET["from"]) ){
			if ($_GET["from"] === "calendar") {
				echo "?controller=events&action=calendar";
			} else if ($_GET["from"] === "events"){
				echo "?controller=events&action=index";
			}
		}
		?>>Indietro</a>
	</div>

	<h1 style="text-align: center;">Modifica evento: <?php echo $event->name;?></h1>

	<form id="new_event" class="container form-signin" method="get" autocomplete="off">
		<input type="hidden" name="controller" value="events">
		<input type="hidden" name="action" value="edit_page">
		<input type="hidden" name="id" value="<?php echo $_GET['id']?>">

		<input type="hidden" name="from" value=<?php if (isset($_GET["from"])){ echo $_GET["from"]; } ?>>

		<?php if (isset($_GET["show"])){ ?>
			<input type="hidden" name="show" value=<?php echo $_GET["show"]; ?>>
	    <?php } ?>

	    <!-- creates a form-group where the user can change the type of the event -->
	    <div class="form-group">
	    	<label for="sel1">Tipologia:</label>
			<select class="operatori" id="sel1" name="type" value="<?php echo $event->type;?>">
				<option <?php if($event->type == 1){echo 'selected';};?> value=1>Comunicazione Data Breach</option>
				<option <?php if($event->type == 2){echo 'selected';};?> value=2>Cancellazione dati personali</option>
				<option <?php if($event->type == 3){echo 'selected';};?> value=3>Rettifica dei dati</option>
				<option <?php if($event->type == 4){echo 'selected';};?> value=4>Meeting/Conferenza</option>
				<option <?php if($event->type == 5){echo 'selected';};?> value=5>Altro</option>
			</select>
		</div>

		<!-- creates a form-group where the user can change the start date -->
		<div class="form-group">
			<label>Data ed ora inizio evento</label>
			<input class="form-control " value="<?php echo $event->start_date;?>" type="text" placeholder="Data inizio evento" aria-label="Data inizio evento" name="start_date" id="start_date" required="" onkeydown="return event.key != 'Enter';">
		</div>	

		<!-- creates a form-group where the user can change the end date -->
		<div class="form-group">
			<label>Data ed ora fine evento</label>
			<input class="form-control " value="<?php echo $event->end_date;?>" type="text" placeholder="Data fine evento" aria-label="Data fine evento" name="end_date" id="end_date" required="" onkeydown="return event.key != 'Enter';">
		</div>

		<!-- creates a text area where the user can change the name the event -->
		<div class="form-group">
			<label>Titolo</label>
			<input class="form-control " type="text" placeholder="Titolo" aria-label="titolo" name="name" id="name" required="" value="<?php echo $event->name;?>" onkeydown="return event.key != 'Enter';">
		</div>

		<!-- creates a text area where the user can change the details of the event -->
		<div class="form-group">
			<label>Dettagli</label> 		
			<textarea class="form-control" rows="5" type="text" placeholder="Dettagli" aria-label="Dettagli" name="details" id="details" ><?php echo $event->details;?></textarea>
		</div> 
		
		<!-- creates a form-group where the user can change the urgency of the event -->
		<div class="form-group">
			<label for="sel1">Urgenza:</label>
			<select class="operatori" id="sel1" name="urgency" value="<?php echo $event->urgency;?>">
				<option <?php if($event->urgency == 1){echo 'selected';};?> value=1>Non urgente</option>
				<option <?php if($event->urgency == 2){echo 'selected';};?> value=2>Urgente</option>
				<option <?php if($event->urgency == 3){echo 'selected';};?> value=3>Massima urgenza</option>
			</select>
		</div>

		<!-- creates a check box if the event is completed -->
		<div class="form-group">
			<span class="checkboxtext">Completato</span>
			<input type="checkbox" name="completed" style="width:20px;height:20px;" value=1 <?php if( $event->completed == 1 ){ echo 'checked';};?>>
		</div> 

		<!-- creates a button that submits the modified event -->
		<div class="form-group">
			<button class="btn btn-primary col-md-12 create_product" type="submit">Modifica</button>
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