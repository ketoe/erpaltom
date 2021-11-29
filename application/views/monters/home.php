
<?php
			$value = $dd;
			if ($startDateGet == false) {
				$center = date("Y-m-d");
				$explode = explode ('-',$center);
				$ttStart = mktime(0, 0, 0, $explode[1], $explode[2], $explode[0])-(($value/2)*60*60*24);
				$startTime = $ttStart;
				$endTime = $ttStart+$value/2*60*60*24;
			}else {
				$data_explode = explode ('-', $startDateGet);
				$startTime = mktime(0, 0, 0, $data_explode[1], $data_explode[2], $data_explode[0]);
				$endTime = $startTime+$value*60*60*24;
			}
?>


<h3>Ekipy montażowe</h3>
<a href="/Monters/allMonters" class="btn btn-info">Lista montażystów</a><br /><br />

	<?php
		echo '<a href="/Monters/index/'.date("Y-m-d",$startTime-60*60*24).'" class="btn btn-success"><<<</a>';
		echo '<a href="/Monters/index/'.date("Y-m-d",$startTime+60*60*24).'" class="btn btn-success" style="float: right;">>>></a>';
	?>
	<?php foreach ($monters as $m) { ?>
		<table class="table table-sm table-striped tableMonter">
		<Center><h1><b><?php echo $m['name']; ?></b></h1></Center>
		<thead class="thead-light"><tr><th>
		<?php
				for ($i = 1; $i <= $value; $i++) {
					$tt = $startTime+(60*60*24*$i)-(60*60*24);
					$day = date("j.m",$tt);
					echo '<div style="width: '.(100/$value).'%; float: left; border-left: 1px solid black; border-right: 1px solid black; font-size: 10px"><center>'.$day.'</center></div>';	
				}
					

			echo '</th>';
			$startDate = date("Y-m-d",$startTime);
			$endDate = date("Y-m-d",$endTime);
			$startDay = date("j",$startTime);
			$endDay = date("j",$endTime);
		?>
	</tr>
	</thead>
	<tbody>
			<?php 
			$order = $this->M_monters->getIdMonterOrder($startDate, $m['id']);
			echo '<td style="width: 100%;">';
			foreach ($order as $o) {
				$data_explode_start = explode ('-', $o['start']);
				$data_explode_end = explode ('-', $o['end']);
				$timeStartMonter = mktime(0, 0, 0, $data_explode_start[1], $data_explode_start[2], $data_explode_start[0]);
				$timeEndMonter = mktime(0, 0, 0, $data_explode_end[1], $data_explode_end[2], $data_explode_end[0]);
				$valueDay = ($timeEndMonter-$timeStartMonter)/60/60/24;
				if ($timeStartMonter <= $startTime && $timeEndMonter >= $endTime) { //start przed linią; koniec za linią
					$marginLeft = 0;
					$width = 100;
				}elseif ($timeStartMonter <= $startTime && $timeEndMonter < $endTime) { //start przed linią; koniec w środku
					$valueDay = ($timeEndMonter-$startTime)/60/60/24;
					$marginLeft = 0;
					$width = $valueDay*(100/$value)+(100/$value);
				}elseif ($timeStartMonter > $startTime && $timeEndMonter >= $endTime) { //start w środku; koniec za linią
					$marginLeft = (($timeStartMonter-$startTime)/60/60/24)*(100/$value);
					$width = 100-$marginLeft;
				}elseif ($timeStartMonter > $startTime && $timeEndMonter < $endTime) { //start w środku; koniec przed linią
					$marginLeft = (($timeStartMonter-$startTime)/60/60/24)*(100/$value);
					$width = $valueDay*(100/$value)+(100/$value);
				};
			echo '<div class="borderTimetableMonter" style="margin-left: '.$marginLeft.'%; width: '.$width.'%; min-width: '.(100/$value).'%"><a href="/Orders/view/'.$o['orderId'].'">'.$o['orderName'].'</a></div>';
			}
			echo '</td>
			</tr>';
		}
		?>
</table>