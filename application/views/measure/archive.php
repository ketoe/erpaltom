<h3>Pomiary Archiwalne</h3>

<form action="/Measure/archive" method="POST">
	<h2>Wyszukiwanie i filtracja</h2>
	<div class="row">
		<div class="col-md-3">
			<select name="year" class="form-control">
				<option value="">Wybierz rok...</option>
				<?php 
					for ($i = 0; $i < count($Years); $i++) {
						echo '<option value="'.$Years[$i].'">'.$Years[$i].'</option>';
					}
				?>
			</select>
		</div>

		<div class="col-md-3">
			<select name="mounth_start" class="form-control">
				<option value="01">Styczeń</option>
				<option value="02">Luty</option>
				<option value="03">Marzec</option>
				<option value="04">Kwiecień</option>
				<option value="05">Maj</option>
				<option value="06">Czerwiec</option>
				<option value="07">Lipiec</option>
				<option value="08">Sierpień</option>
				<option value="09">Wrzesień</option>
				<option value="10">Październik</option>
				<option value="11">Listopad</option>
				<option value="12">Grudzień</option>
			</select>
		</div>

		<div class="col-md-3">
			<select name="mounth_end" class="form-control">
				<option value="01">Styczeń</option>
				<option value="02">Luty</option>
				<option value="03">Marzec</option>
				<option value="04">Kwiecień</option>
				<option value="05">Maj</option>
				<option value="06">Czerwiec</option>
				<option value="07">Lipiec</option>
				<option value="08">Sierpień</option>
				<option value="09">Wrzesień</option>
				<option value="10">Październik</option>
				<option value="11">Listopad</option>
				<option value="12">Grudzień</option>
			</select>
		</div>

		<div class="col-md-3">
			<input type="submit" name="generate" value="Szukaj po dacie" class="form-control btn btn-success" />
		</div>
	</div>
</form>


<h2>Archiwum <?php echo $start.' - '.$end; ?></h2>


<a href="/Measure" class="btn btn-info btn-sm">Pomiary aktualne</a>
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
	foreach ($measureArchive as $mA) {
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
			echo '<a href="/Orders/newOrder/'.$mA['id'].'" class="btn-warning btn-sm" type="button">Utwórz zlecenie</a>';
		}
		echo '<a href="/Measure/printMeasure/'.$mA['id'].'" class="btn-info btn-sm" type="button">Drukuj</a>';
		echo '</div></td></tr>';
	}
	?>
</table>