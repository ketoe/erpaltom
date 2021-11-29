<h3>Ustawienia Systemu</h3>
<div class="col-md-12">
	<?php if ($permission != 0) { ?>
	<div class="row">
		<a href="/Admin/getFactory" class="btn btn-info btn-block">Ustawienia dostawców</a>
	</div>
	<?php }; ?>
	
	<?php if ($permission == 2 || $permission == 3) { ?>
	<div class="row">
		<a href="/Admin/getUsers" class="btn btn-info btn-block">Ustawienia pracowników</a>
	</div>
	<?php }; ?>

	<?php if ($permission != 0) { ?>
	<div class="row">
		<a href="/Monters/getMonters" class="btn btn-info btn-block">Ekipy montażowe</a>
	</div>
	<?php } ?>

	<?php if ($permission == 2 || $permission == 3) { ?>
	<div class="row">
		<a href="/Admin/system" class="btn btn-info btn-block">Ustawienia systemowe</a>
	</div>
	<?php } ?>
</div>
