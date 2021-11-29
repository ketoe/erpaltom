<h3>Montażyści - Edycja</h3>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="/Monters/saveMonter" method="POST">
					<input type="hidden" name="id" value="<?php echo $Monter[0]['id']; ?>" />
				<div class="form-group"><input type="text" name="name" value="<?php echo $Monter[0]['name']; ?>" placeholder="Nazwa..." class="form-control" /></div>
				<div class="form-group"><input type="text" name="contact" value="<?php echo $Monter[0]['contact']; ?>" placeholder="Kontakt..." class="form-control" /></div>
				<div class="form-group"><input type="text" name="mail" value="<?php echo $Monter[0]['mail']; ?>" placeholder="Mail..." class="form-control" /></div>
				<div class="form-group"><input type="submit" name="saveMonter" value="Zapisz" class="btn btn-success btn-block" /></div></form>
			</div>
		</div>
	</div>
</div>