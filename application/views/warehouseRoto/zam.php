<h3>Wygenerowane zamówienie do Roto - <?php echo $name; ?></h3>
<div class="alert alert-primary" role="alert">Skopiuj poniższy tekst zamówienia do pliku tekstowego i wyślij do dostawcy</div>
<div class="card">
 	<div class="card-body" style="font-size: 8px;">
    	<table class="table table-sm table-striped">
	<thead class="thead-light">		
		<tr>
			<th>Lp</th>
			<th>Artykuł</th>
			<th>Nazwa</th>
			<th>Sztuki</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	/*foreach ($article->Vendor[0]->Materials[0]->Material as $art) {
		echo '<tr><Td>'.$art->NrGmSys.'</td><td>'.$art->JM.'</td><td>'.$art->CountAll.'</td><td>'.$art->CountPack1.'</td></tr>';
	};*/
	?>
	</tbody>
	</table>	
 	</div>
</div>