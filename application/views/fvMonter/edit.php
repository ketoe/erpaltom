<h3>Edycja faktur montażowych</h3>

<div class="card">
	<div class="card-body">
		<form action="/fvMonter/save" method="POST">
			<input type="submit" name="save" value="Zapisz" class="btn btn-success" />
			<input type="hidden" name="id" value="<?php echo $id; ?>" />
			<input type="hidden" name="order" value="<?php echo $order; ?>" />
			<div class="form-group">
				<input type="text" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="nazwa..."/>
			</div>
			<div class="form-group">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
    				<span class="input-group-text" id="basic-addon1">PLN 0.00</span>
  				</div>
				<input type="text" name="money" placeholder="wartość..." value="<?php echo $money; ?>" class="form-control" aria-describedby="basic-addon1"/>
			</div>
			</div>
			<div class="form-group">
				<textarea name="description" placeholder="opis..." class="form-control"><?php echo $description; ?></textarea>
			</div>
		</form>
	</div>
</div>