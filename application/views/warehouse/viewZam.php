<h3>Zamówienie - <?php echo $name; ?></h3>
<div class="card">
 	<div class="card-body" style="font-size: 8px;">
    	<table class="table table-sm table-striped">
	<thead class="thead-light">		
		<tr>
			<th>Artykuł</th>
			<th>jm</th>
			<th>Sztuki</th>
			<th>Paczki 1</th>	
		</tr>
	</thead>
	<tbody>
	<?php 
	foreach ($articles as $art) {
		echo '<tr><Td>'.$art['article'].'</td><td>'.$art['jm'].'</td><td>'.$art['value'].'</td><td>'.$art['pack'].'</td></tr>';
	};
	?>
	</tbody>
	</table>	
 	</div>
</div>