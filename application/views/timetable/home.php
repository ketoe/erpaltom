
<?php if ($selectYear == true) { ?>
<h3>Charmonogram archiwalny - <?php echo $archivalYear; ?></h3>
<?php }else { ?>
<h3>Charmonogram aktualny - <?php echo date("Y"); ?></h3>
<?php }; ?>

<select name="year" class="form-control form-control-sm selectYear" onChange="location.href='/Timetable/index/'+this.value">
	<option value="">Wybierz rok by wyświetlić wszystkie tygodnie...</option>
	<?php 
		for ($i = 0; $i < count($years); $i++) {
			echo '<option value="'.$years[$i].'"  >'.$years[$i].'</option>';
		}
	?>
</select>

<table class="table table-bordered tableWeek">
	<tbody>
	<?php 
		if ($selectYear == false) {
			$iStart = $actualWeek-6;
			$iEnd = $actualWeek+6;
		}else {
			$iStart = 1;
			$iEnd = 52;
		}
			for ($i = $iStart; $i <= $iEnd; $i++) {

			($i == $actualWeek) ? $now = "true" : $now = "false";
			if ($i > 0 && $i < 53) {
				echo '<tr actualWeek="'.$now.'" align="Center" valign="middle"><td style="width: 50px;">'.$i.'</td>
					<td>';
					foreach ($listOrders[$i] as $order) {
						
						$id = $order['id'];
						$monter = $order['orderMonter']; //czy zlecenie jest z montażem
						($lacks[$id] == true) ? $lack = 1 : $lack = 0; //sprawdzanie czy jest karta braków aktywna
				
							echo '<a href="/Orders/view/'.$order['id'].'"  class="linkOrder">
							<div class="weekBorder" archive="'.$order['archive'].'" lack="'.$lack.'" monter="'.$monter.'">'.$order['name'].'</div></a>';
						
					};

					echo '</td></tr>';
			}
		}
	?>
	</tbody>
</table>

<table>
