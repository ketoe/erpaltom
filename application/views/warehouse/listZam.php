<h3>Lista zamówień</h3>
<div class="card">
 	<div class="card-body" style="font-size: 8px;">
    	<table class="table table-sm table-striped">
	<thead class="thead-light">		
		<tr>
			<th>Zamówienie</th>
			<th>data</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	foreach ($zam as $z) {
		echo '<tr><Td><a href="/Warehouse/viewZam/'.$z['id'].'">'.$z['name'].'</a></td><td>'.$z['date'].'</td></tr>';
	};
	?>
	</tbody>
	</table>	
 	</div>
</div>