<h3>Raport finasowy</h3>


<div class="card">
	<div class="card-header">Raport sprzedaży - informacje</div>
	<div class="card-text">
		<a href="/"><div class="printButton"></div></a>
		<b>Pracownik: </b><?php echo $user; ?><br />
		<b>Okres: </b><?php echo $data; ?><br />
		<b>Suma sprzedażowa: </b><?php echo round($sum_money,2); ?>zł<Br />
		<b>Największa wartość podpisanej umowy: </b><?php echo round($max_money,2); ?>zł<br />
		<b>Najmnniejsza wartość podpisanej umowy: </b><?php echo round($min_money,2); ?>zł<br />
		<b>Liczba podpisanych umów: </b><?php echo $v_orders; ?><br /><br />
	</div>
</div>

		<table class="table table-sm table-striped">
			<thead class="thead-light">
				<tr><Th>Numer zlecenia</Th><th>Klient</th><th>Rok realizacji</th><th>Tydzień Realizacji</th><th>Wartość umowy</th></tr>
			</thead>
			<?php 
				foreach ($list_orders as $o) {
					echo '<Tr><td>'.$o['orderName'].'</td><td>'.$o['clientName'].'</td><td>'.$o['year'].'</td><td>'.$o['week'].'</td><td>'.$o['money'].'zł</td></tr>';
				}
			?>
		</table>

