<?php if ($flash && $flash == true){ ?>
	<body onload="documentdocument.location.reload(true);">
		<!-- shows a message if the event is deleted  -->
		<div class="alert alert-success">
			<strong>Operazione eseguita con successo.</strong> <?php echo $message; ?>.
		</div>
<?php }; ?>

<div class="row">
	<div class="col-12">
		<h1>Eventi</h1>
	</div>
	<div class="col-12" style="text-align: right;">
		<a class="btn btn-primary" href='?controller=events&action=create_page&from=events'>Crea nuovo evento</a>
	</div>
</div>

<!-- creates a table of the events with the following attributes: name, type, urgency, completed -->
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th style="text-align: center;">Titolo</th>
				<th style="text-align: center;">Tipologia</th>
				<th style="text-align: center;">Urgenza</th>
				<th style="text-align: center;">Completato</th>
				<th style="text-align: center;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Azioni</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach($events as $event) { ?>
				<tr>
					<td style="text-align: center;"><?php echo $event->name; ?></td>
					<td style="text-align: center;">
						<?php if ( $event->type == 1 ){ echo "Comunicazione Data Breach";} ; ?>
						<?php if ( $event->type == 2 ){ echo "Cancellazione dei dati";} ; ?>
						<?php if ( $event->type == 3 ){ echo "Rettifica dei dati";} ; ?>
						<?php if ( $event->type == 4 ){ echo "Meeting/Conferenza";} ; ?>
						<?php if ( $event->type == 5 ){ echo "Altro";} ; ?>
					</td>

					<td style="text-align: center;"><?php if ( $event->urgency == 1 ){ echo "Non urgente";} ; ?>
						<?php if ( $event->urgency == 2 ){ echo "Urgente";} ; ?>
						<?php if ( $event->urgency == 3 ){ echo "Massima urgenza";} ; ?>	
					</td>

					<td style="text-align: center;">
						<?php if ( $event->completed == 0 ){ echo "<img src=src/red.png" ;};?>
						<?php if ( $event->completed == 1 ){ echo "<img src=src/green.png";};?>
					</td>

					<td>
						<div style="text-align: right;">
							<!-- creates buttons to visualise and edit -->
							<a class="btn btn-md" href='?controller=events&action=show&id=<?php echo $event->id; ?>&from=events'>Visualizza</a>
							<a class="btn btn-md" href='?controller=events&action=edit_page&id=<?php echo $event->id; ?>&from=events'>Modifica</a>
						</div>
					</td>

					<td>
						<!-- shows an alert to confirm the deletion of the event -->
						<form onsubmit="return confirm('Conferma eliminazione evento?');" method="get">
							<input type="hidden" name="id" value=<?php echo $event->id; ?>>
								<input type="hidden" name="controller" value="events">
								<input type="hidden" name="action" value="index">  
								<input type="hidden" name="remove_id" value="<?php echo $event->id; ?>"> 
								<!-- creates a button -->
								<input type="submit" name="Elimina" value="Elimina" class="btn btn-danger">
							</form> 	
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<hr>
<span style="display:block; height: 100px;"></span>

<hr>
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
