<h3>Karty Braków</h3>

<form action="/Lack/index" method="POST">
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


<h2>Karty Braków <?php echo $start.' - '.$end; ?></h2>

<a href="Lack/printLacks/<?php echo $start; ?>/<?php echo $end; ?>"><div class="printButton"></div></a>
<table class="table table-sm table-striped">
	<thead class="thead-light"><tr>
		<th>Numer karty</th>
		<th>Zlecenie</th>
		<th>Opis</th>
		<th>Data utworzenia</th>
		<th>autor</th>
		<th>typ</th>
		<th>Stan</th>
		<th>Edycja</th>
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
		<td>'.$stan.'</td>
		<td>
		<div class="btn-group">
		<a href="/Lack/deleteLack/'.$l['id'].'" class="btn btn-danger btn-sm" type="button">Usuń</a>';
		if ($l['active'] == 1) {
	    	echo '<a href="/Lack/unActive/'.$l['id'].'" class="btn btn-success btn-sm" type="button">Dezaktywuj</a>';
	    }else{
	    	echo '<a href="/Lack/addActive/'.$l['id'].'" class="btn btn-success btn-sm" type="button">Aktywuj</a>';
		};
		echo '<a href="/Lack/edit/'.$l['id'].'" class="btn btn-info btn-sm" type="button">Edytuj</a> ';
	    echo '<a href="/Lack/printIdLack/'.$l['id'].'" class="btn btn-primary btn-sm" type="button">Drukuj</a></div></td></tr>';
}
?>

</table>
