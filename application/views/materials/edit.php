<h3>Edycja zamówień</h3>

<div class="card">
	<div class="card-body">
		<form action="/Materials/save" method="POST">
			<input type="submit" name="save" value="Zapisz" class="btn btn-success" />
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="hidden" name="order" value="<?php echo $order; ?>" />
			<div class="form-group">
				<input type="text" name="name" value="<?php echo $name; ?>" class="form-control" />
			</div>
			<div class="form-group">
				<textarea name="description" class="form-control"><?php echo $description; ?></textarea>
			</div>
		</form>
	</div>
</div>