<h3>Raporty</h3>


<div class="card">
	<div class="card-header">Zestawienie roczne sprzedaży</div>
	<div class="card-text">
		<center><?php echo $year; ?></center>
			<?php 
				foreach ($statistics as $stat) {
					echo '<b>'.$stat['mounth']. '</b> - '.number_format($stat['sumMoney'], 2, '.', ' ').'[PLN]<br />';
				};
			?>
	</div>
</div>

