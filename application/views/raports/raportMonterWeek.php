<h3>Raport czasowy realizacji</h3>

<div class="card">
	<div class="card-header">Raport tygodniowy montaży</div>
	<div class="card-text">
		<a href="/Raports/generateRaportWeekOrders/<?php echo $year; ?>/<?php echo $start_week; ?>/<?php echo $end_week; ?>"><div class="printButton"></div></a>
		<b>Rok: </b><?php echo $year; ?><br />
		<b>Okres czasu (tygodnie): </b><?php echo $start_week; ?> - <?php echo $end_week; ?><br />
	</div>
</div>
		
	<table class="table table-sm table-striped">
	<thead class="thead-light">		
		<tr><Th>Numer zlecenia</Th><th>Klient</th><th>Montaż</th><th>Data montażu</th><th>Tydzień Realizacji</th>
		<th>Zakres</th></tr>
	</thead>
		<?php 
			foreach ($list_orders as $o) {
				if ($o['pcv_white'] == 1) { $pcv_white = '/pcv białe/'; }else { $pcv_white = null;};
				if ($o['pcv_color'] == 1) { $pcv_color = '/pcv kolor/'; }else { $pcv_color = null;};
				if ($o['aluminium'] == 1) { $aluminium = '/Aluminium/'; }else { $aluminium = null;};
				if ($o['parapets'] == 1) { $parapets = '/parapety/'; }else { $parapets = null;};
				if ($o['rolets'] == 1) { $rolets = '/rolety/'; }else { $rolets = null;};
				if ($o['glass'] == 1) { $glass = '/szkło/'; }else { $glass = null;};
				if ($o['orderMonter'] == 1) { $monter = 'z montażem'; }else { $monter = 'bez montażu'; };
				if ($o['orderMonter'] == 1) { $dateMonter = $o['dateMonter']; }else { $dateMonter = '-'; };
				if ($o['orderMonter'] == 1) { $endDateMonter = $o['endMonter']; }else { $endDateMonter = '-'; };

				echo '<Tr><td><b>'.$o['orderName'].'</b></td><td>'.$o['clientName'].'</td><td>'.$monter.'</td><td>'.$dateMonter.' - '.$endDateMonter.'<td>'.$o['week'].'</td><td>'.
				$pcv_white.''.$pcv_color.''.$aluminium.''.$parapets.''.$rolets.''.$glass.'</td>';

				echo '<tr><Td colspan="6"><b>Opis:</b><Br /><i>'.$o['description'].'</i></td></tr>';
			}
		?>
	</table>
	