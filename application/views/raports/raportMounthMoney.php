<h3>Zestawienie sprzedaży miesięcznej</h3>


<div class="card">
	<div class="card-header">Informacje</div>
	<div class="card-text">
		<b>Rok:</b> <?php echo $year; ?><Br />
		<b>Miesiąc:</b> <?php echo $mounth; ?><br />
		<b>Ilość podpisanych zleceń:</b> <?php echo count($orders); ?><br />
		<b>Wartość umów:</b><?php echo round($sum,2); ?>zł<br />
	</div>
</div>

<br />

<div class="card">
	<div class="card-header">Zestawienie według pracowników</div>
	<div class="card-text">
		<?php 
			foreach ($users as $u) {
				$i = 0; //wartość umów
				echo '<b>'.$u['name'].' '.$u['surname'].'</b><br />';
				echo '<Table class="table table-sm table-striped">
				<thead class="thead-light">	
					<tr>
					<th>Numer zlecenia</th>
					<th>Wartość umowy</th>
					<th>Tydzień realizacji</th>
					</tr>
				</thead>';
				foreach ($orders as $order) {
					if ($order['autor'] == $u['id']) {
						echo '<tr><td>'.$order['name'].'</td><td>'.$order['money'].'zł</td><td>'.$order['week'].'</td></tr>';
						$i = $i+$order['money'];
					};
				};
				echo '<tr class="summary"><Td colspan="3"><b>Wartość umów: </b>'.$i.'zł</td></tr>';
				echo '<tr class="summary"><td colspan="3"><b>Udział w miesięcznym zestawieniu: </b>'.round($i/$sum*100).'%</td></tr>';
				echo '</table>';
			}
		?>
	</div>
</div>
