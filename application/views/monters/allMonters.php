<h3>Montażyści</h3>
<Div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
		<div class="panel-body">
				<table class="table table-sm table-striped">
					<thead>
						<tr>
							<th>Nazwa</th><th>Kontakt</th><th>Mail</th><th></th>
						</tr>
					</thead>
						
		<?php
		foreach ($Monters as $m) {
			echo '<tr><td>'.$m['name'].'</td><td>'.$m['contact'].'</td><td>'.$m['mail'].'</td>
			<td><a href="/Monters/view/'.$m['id'].'" class="btn btn-info btn-sm">Podgląd</a></td>
			</tr>';
		}
		?>

		</table>
		</div>
		</div>
	</div>
</div>
