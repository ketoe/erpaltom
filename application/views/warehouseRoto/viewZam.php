<h3>Zamówienie - <?php echo $name; ?></h3>
<a href="/WarehouseRoto/listZamRoto" class="btn btn-info">Powrót do listy zamówień</a>
<div class="card">
	<table class="table table-sm">
	<thead class="thead-light"><tr>
    <th width="20px">Lp.</th><th width="100px;">SAP</th><th width="200px">Nazwa</th><th width="50px;"> Ilość</th>
    </tr>
</thead>
	<?php 
	$i = 0;
	foreach ($articles as $art) {
		$i++;
		$warehouse = $this->M_warehouseRoto->getCodeArticle($art['article']);
		if (count($warehouse) == 1) {
			echo '<tr><td>'.$i.'.</td><td>  '.$art['article'].'</td><td>'.$warehouse[0]['name'].'</td><td> '.$art['value'].',00</td></tr>';
		}else {
			echo '<tr><Td>'.$i.'.</td><td>  '.$art['article'].'</td><td>'.$art['value'].',00</td></tr>';
		}
	};
	?>	
 	</div>
</div>