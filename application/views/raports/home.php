<h3>Raporty</h3>

<div class="card">
	<div class="card-header">Moja sprzedaż miesięczna</div>
	<div class="card-text">
    	<form action="/Raports/generateRaportUserLog" method="POST">
    	<div class="row">
			<div class="col-md-4">
				<select name="mounth" class="form-control">
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

			<div class="col-md-4">
				<select name="year" class="form-control">
					<?php 
						for ($i = 0; $i < count($years); $i++) {
							echo '<option value="'.$years[$i].'">'.$years[$i].'</option>';
						}
					?>
				</select>
			</div>

			<div class="col-md-4">
				<input type="submit" name="generate" value="Generuj Raport" class="btn btn-success form-control" />
			</div>
		</div>
		</form>
    </div>
</div>

<br />
			
<div class="card">
	<div class="card-header">Okresowe zestawienia realizacji (tygodniowe)</div>
	<div class="card-text">
		<form action="/Raports/generateRaportWeekOrders" method="POST">
			<div class="row">
				<div class="col-md-2">
					<select name="start_week" id="start_week" class="form-control">
						<option value="">Od..</option>
						<?php
							for ($i = 1; $i <= 52; $i++) {
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
					</select>
				</div>

				<div class="col-md-2">
					<select name="end_week" id="end_week" class="form-control">
						<option value="">Do..</option>
						<?php
							for ($i = 1; $i <= 52; $i++) {
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
					</select>
				</div>
					
				<div class="col-md-3">
					<select name="year" class="form-control">
						<?php 
							for ($i = 0; $i < count($years); $i++) {
								echo '<option value="'.$years[$i].'">'.$years[$i].'</option>';
							}
						?>
					</select>
				</div>

				<div class="col-md-5">
					<input type="submit" name="generate" value="Generuj zestawienie" class="btn btn-success form-control" />
				</div>
			</div>
		</form>
	</div>
</div>

<br />


<div class="card">
	<div class="card-header">Roczna wielkość sprzedaży</div>
	<div class="card-text">
		<form action="/Raports/raportMoneyYear" method="POST">
			<div class="row">
			<div class="col-md-3">
				<select name="year" class="form-control">
					<?php 
						for ($i = 0; $i < count($years); $i++) {
							echo '<option value="'.$years[$i].'">'.$years[$i].'</option>';
						}
					?>
				</select>
			</div>

			<div class="col-md-9">
				<input type="submit" name="generate" value="Generuj Raport" class="btn btn-success form-control" />
			</div>
			</div>
		</form>
	</div>
</div>


<div class="card">
	<div class="card-header">Zestawienie sprzedaży miesięcznej</div>
	<div class="card-text">
		<form action="/Raports/raportMounthMoney" method="POST">
			<div class="row">
			<div class="col-md-4">
				<select name="mounth" class="form-control">
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

			<div class="col-md-4">
				<select name="year" class="form-control">
					<?php 
						for ($i = 0; $i < count($years); $i++) {
							echo '<option value="'.$years[$i].'">'.$years[$i].'</option>';
						}
					?>
				</select>
			</div>

			<div class="col-md-4">
				<input type="submit" name="generate" value="Generuj Raport" class="btn btn-success form-control" />
			</div>
		</div>
		</form>
	</div>
</div>


