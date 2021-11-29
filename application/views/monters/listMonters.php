<h3>Montażyści</h3>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="/Monters/addMonter" method="POST">
				<div class="form-group"><input type="text" name="name" placeholder="Nazwa..." class="form-control" /></div>
				<div class="form-group"><input type="text" name="contact" placeholder="Kontakt..." class="form-control" /></div>
				<div class="form-group"><input type="text" name="mail" placeholder="Mail..." class="form-control" /></div>
				<div class="form-group"><input type="submit" name="addMonter" value="Dodaj" class="btn btn-success btn-block" /></div></form>
			</div>
		</div>
	</div>
</div>

<Div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
		<div class="panel-body">
				<table class="table table-sm table-striped">
					<thead>
						<tr>
							<th>Nazwa</th><th>Kontakt</th><th>Mail</th><th>Edycja</th>
						</tr>
					</thead>
						
		<?php
		foreach ($Monters as $m) {
			echo '<tr><td>'.$m['name'].'</td><td>'.$m['contact'].'</td><td>'.$m['mail'].'</td>
			<td><a href="/Monters/deleteMonter/'.$m['id'].'" class="btn-danger btn-xs">Usuń</a>
			<a href="/Monters/editMonter/'.$m['id'].'" class="btn-info btn-xs">Edytuj</a></td>
			</tr>';
		}
		?>

		</table>
		</div>
		</div>
	</div>
</div>
