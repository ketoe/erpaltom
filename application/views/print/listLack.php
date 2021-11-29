<div class="kontener">

<div class="top">
	<div class="logo"><img src="/media/img/logo.jpg"></div>
	<h3>karty braków</h3>
</div>

<table>
	<thead><tr>
		<th>Numer karty</th>
		<th>Zlecenie</th>
		<th>Opis</th>
		<th>Data utworzenia</th>
		<th>autor</th>
		<th>typ</th>
		<th>Stan</th>
	</tr>
	</thead>
				
<?php
foreach ($Lack as $l) {
	($l['inside'] == 1) ? $typ = 'Niezgodność wewnętrzna' : $typ = 'Reklamacja'; 
	($l['active'] == 1) ? $stan = 'Aktywne' : $stan = 'nieaktywne';
	echo '<tr activeLack="'.$l['active'].'"><td>'.$l['name'].'</td>
		<td>'.$l['orderName'].'</td>
		<td>'.$l['description'].'</td>
		<td>'.$l['date'].'</td>
		<td>'.$l['autorName']. ' '.$l['autorSurname'].'</td>
		<td>'.$typ.'</td>
		<td>'.$stan.'</td></tr>';
}
?>

</table>

</div>