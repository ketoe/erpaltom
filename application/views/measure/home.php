<h3>Pomiary Aktualne</h3>

<a href="/Measure/archive" class="btn btn-info btn-sm">Archiwum pomiarów</a>
<a href="/Measure/newMeasure" class="btn btn-success btn-sm">Nowy pomiar</a>
<table class="table table-sm table-striped">
	<thead class="thead-light"><tr>
		<th>Data pomiaru</th>
		<th>Adres pomiaru</th>
		<th>Numer tel.</th>
		<th>Email</th>
		<th>Klient</th>
		<th>Opis</th>
		<th>Autor</th>
		<th>Data utworzenia</th>
		<th>Edycja</th>
	</tr>
	</thead>

	<?php
	foreach ($measureActual as $mA) {
		echo '<tr>';
		echo 
		'<td>'.$mA['date_measure'].'</td>
		<td>'.$mA['address'].'</td>
		<td>'.$mA['contact'].'</td>
		<td>'.$mA['mail'].'</td>
		<td>'.$mA['clientName'].'</td>
		<td>'.$mA['description'].'</td>
		<td>'.$mA['autorName'].' '.$mA['autorSurname'].'</td>
		<td>'.$mA['date_create'].'</td>
		<td><div class="btn-group">
		<a href="/Measure/delete/'.$mA['id'].'" class="btn-danger btn-sm" type="button">Usuń</a>';
		if ($mA['order'] == 0) {
			echo '<a href="/Orders/newOrder/'.$mA['id'].'" class="btn-warning btn-sm" type="button">Utwórz zlecenie</a>
				<a href="/Measure/printMeasure/'.$mA['id'].'" class="btn-info btn-sm" type="button">Drukuj</a>';
		}else {
			echo '<a href="/Measure/printMeasure/'.$mA['id'].'" class="btn-info btn-sm" type="button">Drukuj</a>';
		}
		echo '</div></td></tr>';
	}
	?>
</table>