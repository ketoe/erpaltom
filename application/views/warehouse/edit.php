<h3>Edycja - <?php echo $code; ?></h3>

<form action="/Warehouse/save" method="POST">
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="form-group"><label for="name">Nazwa:</label>
		<input type="text" name="name" value="<?php echo $name; ?>" class="form-control" />
	</div>

	<div class="form-group"><label for="code">Oznaczenie:</label>
		<input type="text" name="code" value="<?php echo $code; ?>" class="form-control" />
	</div>

	<div class="form-group"><label for="value">Ilość:</label>
		<input type="text" name="value" value="<?php echo $value; ?>" class="form-control" />
	</div>

	<div class="form-group">
		<input type="submit" name="save" value="Zapisz" class="btn btn-success btn-block" />
	</div>
</form>