<h3>Nowy klient</h3>


<form role="form" action="/Clients/addClient" method="POST" class="card">
	<div class="card-text">
			<input type="submit" name="save" value="Zapisz" class="btn btn-success" />
		<div class="form-group row">
			<label for="name" class="col-md-1 col-form-label">Nazwa: </label>
			<input type="text" name="name" id="name" placeholder="nazwa..." class="form-control col-md-4 form-control-sm"/>
		</div>

		<div class="form-group row">
			<label for="address" class="col-md-1 col-form-label">Adres: </label>
			<input type="text" name="address" id="address" placeholder="adres..." class="form-control col-md-4 form-control-sm"/>
		</div>

		<div class="form-group row">
			<label for="mail" class="col-md-1 col-form-label">Mail: </label>
			<input type="text" name="mail" id="mail" placeholder="mail..." class="form-control col-md-4 form-control-sm"/>
		</div>

		<div class="form-group row">
			<label for="phone" class="col-md-1 col-form-label">Kontakt: </label>
			<input type="text" name="phone" id="contact" placeholder="kontakt..." class="form-control col-md-4 form-control-sm"/>
		</div>

		<div class="form-group row">
			<label for="nip" class="col-md-1 col-form-label">NIP: </label>
			<input type="text" name="nip" id="nip" placeholder="nip..." class="form-control col-md-4 form-control-sm"/>
		</div>

	</div>
</form>


