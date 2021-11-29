<h3>Edycja danych klienta</h3>


<form role="form" action="/Clients/saveClient" method="POST" class="card">
	<div class="card-text">
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="submit" name="save" value="Zapisz" class="btn btn-success" />
		<div class="form-group row">
			<label for="name" class="col-md-1 col-form-label">Nazwa: </label>
			<input type="text" name="name" id="name" value="<?php echo $name; ?>" class="form-control col-md-4 form-control-sm"/>
		</div>

		<div class="form-group row">
			<label for="address" class="col-md-1 col-form-label">Adres: </label>
			<input type="text" name="address" id="address" value="<?php echo $address; ?>" class="form-control col-md-4 form-control-sm"/>
		</div>

		<div class="form-group row">
			<label for="mail" class="col-md-1 col-form-label">Mail: </label>
			<input type="text" name="mail" id="mail" value="<?php echo $mail; ?>" class="form-control col-md-4 form-control-sm"/>
		</div>

		<div class="form-group row">
			<label for="phone" class="col-md-1 col-form-label">Kontakt: </label>
			<input type="text" name="phone" id="contact" value="<?php echo $phone; ?>" class="form-control col-md-4 form-control-sm"/>
		</div>

		<div class="form-group row">
			<label for="nip" class="col-md-1 col-form-label">NIP: </label>
			<input type="text" name="nip" id="nip" value="<?php echo $nip; ?>" class="form-control col-md-4 form-control-sm"/>
		</div>

	</div>
</form>


