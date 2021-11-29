<h3>Ustawienia dostawców</h3>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="/Admin/addFactory" method="POST">
				<div class="form-group"><input type="text" name="name" placeholder="Nazwa..." class="form-control" /></div>
				<div class="form-group"><input type="submit" name="addFactory" value="Dodaj" class="btn btn-success btn-block" /></div></form>
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
							<th>Nazwa dostawcy</th>
						</tr>
					</thead>
						
		<?php
		foreach ($Factory as $factory) {
			echo '<tr><td>'.$factory['name'].'</td></tr>';
		}
		?>

		</table>
		</div>
		</div>
	</div>
</div>
