<h3>Wygenerowane zamówienie do Aluprof S.A - <?php echo $name; ?></h3>
<div class="alert alert-primary" role="alert">Skopiuj poniższy tekst zamówienia do pliku tekstowego i wyślij do dostawcy</div>
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
	foreach ($article->Vendor[0]->Materials[0]->Material as $art) {
		echo '<tr><Td>'.$art->NrGmSys.'</td><td>'.$art->JM.'</td><td>'.$art->CountAll.'</td><td>'.$art->CountPack1.'</td></tr>';
	};
	?>
	</tbody>
	</table>	
 	</div>
</div>