<div class="kontener">

<div class="top">
	<div class="logo"><img src="/media/img/logo.jpg"></div>
	<h3>Raport realizacji</h3>
</div>

<div class="text">
	<?php 
	echo 'Rok: '.$year. ' | Tydzień: '.$start_week. ' '.$end_week;
	?>
</div>

<div class="line"></div>

<table>
	<thead>		
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

</div>