<h3>Widok Zlecenia</h3>
<?php ($lacksActive > 0) ? $backgroundGeneral = '#ff6f6f' : $backgroundGeneral = ''; ?>

<!-- NAZWA ZLECENIA -->
<div class="card text-white bg-secondary">
    <center><h4>
    	<?php echo $nameOrder; ?>
    	<?php if ($archive == 1) { ?>
    	<br /><br />ZLECENIE W ARCHIWUM
    	<?php }; ?>
    	
    </h4></center>
</div>

<br />

<div class="card" archive="<?php echo $archive; ?>" style="background: <?php echo $backgroundGeneral; ?>">
	<div class="card-header">
   		<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
      		<li class="nav-item">
        		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Informacja podstawowe</a>
     		</li>
      		<li class="nav-item">
       			<a class="nav-link" id="fv-tab" data-toggle="tab" href="#fv" role="tab" aria-controls="fv" aria-selected="false">Faktury/zamówienia</a>
     		</li>
     		<li class="nav-item">
        		<a class="nav-link" id="lacks-tab" data-toggle="tab" href="#lacks" role="tab" aria-controls="lacks" aria-selected="false">Karty braków
        			 <span style="font-size: 10px;" class="badge badge-primary"><?php echo $lacksActive.'/'.count($lacks); ?></span></a>

      		</li>
      		<li class="nav-item">
      			<a class="nav-link" id="measure-tab" data-toggle="tab" href="#measure" role="tab" aria-controls="measure" aria-selected="false">Pomiary</a>
      		</li>
      		<li class="nav-item">
      			<a class="nav-link" id="measure-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="measure" aria-selected="false">Załączniki
      			<span style="font-size: 10px;" class="badge badge-primary"><?php echo $countFile; ?></span></a>
      		</li>
      		<li class="nav-item">
        		<a class="nav-link" id="edition-tab" data-toggle="tab" href="#edition" role="tab" aria-controls="edition" aria-selected="false">Edycja</a>
      		</li>
    	</ul>
  	</div>

  	<div class="card-body">
  	<div class="tab-content" id="myTabContent">
      
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<!-- OPIS ZLECENIA -->
<div class="card">
	<div class="card-header">Opis 
	<div class="editIcon" data-toggle="modal" data-target="#editDescription" view="all" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></div>
	</div>
	<div class="card-text">
    	<?php echo $description; ?>
    </div>
</div>

<br />


<div class="row">
	<!-- DANE PODSTAWOWE -->
	<div class="col-md-4">
        <div class="card">
        	<div class="card-header">Podstawowe informacje</div>
        	<div class="card-text">
        		<ul>
        			<li><b>Numer zlecenia:</b> <?php echo $nameOrder; ?> </li>
        			<li><b>Kontrahent: </b><?php echo $client; ?>
        			<a href="/Orders/editClient/<?php echo $id; ?>" class="editIcon" view="all" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></a>
        			</li>
        			<li><b>Wartość umowy:</b> <?php echo $money; ?>[PLN]
        			<button class="editIcon" data-toggle="modal" data-target="#editMoney" view="all" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></button></li>
        			<li><b>Data utworzenia:</b> <?php echo $date_create; ?></li>
        			<li><b>Autor:</b> <?php echo $autor; ?>
        			<button class="editIcon" data-toggle="modal" data-target="#editAutor" view="mod" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></button>
        			</li>
        			<li><b>Rok realizacji:</b> <?php echo $year; ?></li>
        			<li><b>Tydzień realizacji:</b> <?php echo $week; ?>
        			<button class="editIcon" data-toggle="modal" data-target="#editWeek" view="mod" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></button>
        			</li>
        		</ul>
        	</div>
        </div>
   	</div>

   	<!-- ZAKRES UMOWY -->
   	<div class="col-md-3">
        <div class="card">
        	<div class="card-header">Zakres umowy</div>
        	<div class="card-text">
        		<?php
        			if ($pcv_white != false) echo $pcv_white.'<br />';
        			if ($pcv_color != false) echo $pcv_color.'<br />';
        			if ($aluminium != false) echo $aluminium.'<br />';
        			if ($rolets != false) echo $rolets.'<br />';
        			if ($parapets != false) echo $parapets.'<br />';
        			if ($glass != false) echo $glass.'<br />';
        			if (isset($anotherElement)) echo $anotherElement; '<br />';
        		?>
        	</div>
        </div>
   	</div>

   	<!-- LISTA MONTAŻY -->
   	<div class="col-md-5">
        <div class="card">
        	<div class="card-header">Lista montaży
        	<?php
        	if ($orderMonter == 1) {
        		echo '<button class="addIcon" data-toggle="modal" data-target="#addMonter" view="all" per="'.$permission.'" archive="'.$archive.'"></button>';
        	}
        	?>
        	</div>
        	<div class="card-text">
        	
        	<?php 
        		if ($orderMonter == 0) {
        			echo '<div class="card-text"><center>Umowa bez montażu</center></div>';
        		}else {
        			echo '<Div class="card-text">';
        			foreach ($listMonters as $lm) {
        				echo '<li><b>'.$lm['monterName'].'</b> | '.$lm['start'].' - '.$lm['end'].' | '.$lm['description'].'<a href="/Orders/deleteMonter/'.$lm['id'].'" class="btn btn-danger btn-sm">Usuń</a></li>';
        			};
        			echo '</div>';
        		};
        	?>
   	</div>
</div>
</div>
</div>
</div>

<!-- ///////////////////////////////////FAKTURY/ZAMÓWIENIA/////////////////////////////////// -->
<div class="tab-pane fade" id="fv" role="tabpanel" aria-labelledby="fv-tab">
	<div class="row">
		<div class="col-md-12">
			<div class="card bg-light">
		        <div class="card-header">Zamówienia
		        	<button class="addIcon" data-toggle="modal" data-target="#addMaterial" view="all" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></button></li>
		        </div>
		        <div class="card-block">
		           	<div class="card-text">
		           				<table class="table table-sm table-hover">
	           				<thead class="thead-light"><tr>
	           					<th>Data utworzenia</th>
	           					<th>Nazwa</th>
	           					<th>Producent</th>
	           					<th>Opis</th>
	           					<th>Autor</th>
	           					<th></th>
	           				</tr></thead>
	           				<tbody>
	           			<?php 
	           				foreach ($materials as $materials) {
	           					echo '<tr>
	           					<td>'.$materials['date_create'].'</td>
	           					<td>'.$materials['name']. '</td>
	           					<td>'.$materials['factoryName'].'</td>
	           					<td>'.$materials['description']. '</td>
	           					<td>'.$materials['autorName'].' '.$materials['autorSurname'].'</td><td><div class="btn-group">';
	           					if ($permission != 0) {
	           						echo '<a href="/Materials/deleteMaterial/'.$materials['id'].'/'.$id.'" class="btn-danger btn-sm" type="button">Usuń</a>';
	           					};
	           						echo '<a href="/Materials/edit/'.$materials['id'].'/'.$id.'" class="btn-info btn-sm" type="button">Edytuj</a>';
	           					echo '</div></td></tr>';
	           				}
	           			?>
	           			</tbody>
	           			</table>
		           	</div>
		        </div>
		    </div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="card bg-light">
	        <div class="card-header">Faktury montażowe
	        	<button class="addIcon" data-toggle="modal" data-target="#addFvMonter" view="all" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></button></li>
	        </div>
	        	<div class="card-block">
	           		<div class="card-text">
	           			<table class="table table-sm table-hover">
	           				<thead class="thead-light"><tr>
	           					<th>Data utworzenia</th>
	           					<th>Nazwa</th>
	           					<th>Wartość</th>
	           					<th>Opis</th>
	           					<th>Autor</th>
	           					<th></th>
	           				</tr></thead>
	           				<tbody>
	           			<?php 
	           				foreach ($fv_monter as $fv_monter) {
	           					echo '<tr>
	           					<td>'.$fv_monter['date_create'].'</td>
	           					<td>'.$fv_monter['name']. '</td>
	           					<td>'.$fv_monter['money'].' zł</td>
	           					<td>'.$fv_monter['description']. '</td>
	           					<td>'.$fv_monter['autorName'].' '.$fv_monter['autorSurname'].'</td><td><div class="btn-group">';
	           					if ($permission != 0) {
	           						echo '<a href="/FvMonter/deleteFvMonter/'.$fv_monter['id'].'/'.$id.'" class="btn-danger btn-sm" type="button">Usuń</a>';
	           					};
	           						echo '<a href="/FvMonter/edit/'.$fv_monter['id'].'/'.$id.'" class="btn-info btn-sm" type="button">Edytuj</a>';
	           					echo '</div></td></tr>';
	           				}
	           			?>
	           			</tbody>
	           			</table>
	           		</div>
	         	</div>
	        </div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card bg-light">
	        <div class="card-header">Faktury sprzedażowe
	        <button class="addIcon" data-toggle="modal" data-target="#addFvSale" view="all" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></button></li>
	        </div>
	        	<div class="card-block">
	           		<div class="card-text">
	           			<table class="table table-sm table-hover">
	           				<thead class="thead-light"><tr>
	           					<th>Data utworzenia</th>
	           					<th>Nazwa</th>
	           					<th>Wartość</th>
	           					<th>Opis</th>
	           					<th>Autor</th>
	           					<th></th>
	           				</tr></thead>
	           				<tbody>
	           			<?php 
	           				foreach ($fv_sale as $fv_sale) {
	           					echo '<tr>
	           					<td>'.$fv_sale['date_create'].'</td>
	           					<td>'.$fv_sale['name']. '</td>
	           					<td>'.$fv_sale['money'].' zł</td>
	           					<td>'.$fv_sale['description']. '</td>
	           					<td>'.$fv_sale['autorName'].' '.$fv_sale['autorSurname'].'</td><td><div class="btn-group">
	           					';
	           					if ($permission != 0) {
	           						echo '<a href="/FvSale/deleteFvSale/'.$fv_sale['id'].'/'.$id.'" class="btn-danger btn-sm" type="button">Usuń</a>';
	           					};
	           					echo '<a href="/FvSale/edit/'.$fv_sale['id'].'/'.$id.'" class="btn-info btn-sm" type="button">Edytuj</a>';
	           					echo '</div></td></tr>';
	           				}
	           			?>
	           			</tbody>
	           			</table>
	           		</div>
	         	</div>
	        </div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card bg-light">
	        <div class="card-header">Faktury zakupowe
	        	<button class="addIcon" data-toggle="modal" data-target="#addFvPayment" view="all" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></button></li>
	        </div>
	        	<div class="card-block">
	           		<div class="card-text">
	           			<table class="table table-sm table-hover">
	           				<thead class="thead-light"><tr>
	           					<th>Data utworzenia</th>
	           					<th>Nazwa</th>
	           					<th>Producent</th>
	           					<th>Wartość</th>
	           					<th>Opis</th>
	           					<th>Autor</th>
	           					<th></th>
	           				</tr></thead>
	           				<tbody>
	           			<?php 
	           				foreach ($fv_payment as $fv_payment) {
	           					echo '<tr>
	           					<td>'.$fv_payment['date_create'].'</td>
	           					<td>'.$fv_payment['name']. '</td>
	           					<td>'.$fv_payment['factoryName'].'</td>
	           					<td>'.$fv_payment['money'].' zł</td>
	           					<td>'.$fv_payment['description']. '</td>
	           					<td>'.$fv_payment['autorName'].' '.$fv_payment['autorSurname'].'</td><td><div class="btn-group">';
	           					if ($permission != 0) {
	           						echo '<a href="/FvPayment/deleteFvPayment/'.$fv_payment['id'].'/'.$id.'" class="btn-danger btn-sm" type="button">Usuń</a>';
	           					};
	           					echo '<a href="/FvPayment/edit/'.$fv_payment['id'].'/'.$id.'" class="btn-info btn-sm" type="button">Edytuj</a>';
	           					echo '</div></td></tr>';
	           				}
	           			?>
	           			</tbody>
	           			</table>
	           		</div>
	         	</div>
	        </div>
		</div>
	</div>
	</div>

<!-- /////////////////////////KONIEC FAKTUR/ZAMÓWIEŃ/////////////////////////////////////// -->


<!-- /////////////////////////PRZYCISKI EDYCJI/////////////////////////////////////////////// -->
<div class="tab-pane fade" id="edition" role="tabpanel" aria-labelledby="edition-tab">
	<?php if ($permission != 0) { ?>
	<div class="row">
		<Div class="col-md-12">
			<button class="btn btn-danger btn-block" data-toggle="modal" data-target="#formDeleteOrder">Usuń zlecenie</button><Br />
		</Div>
	</div>
	<?php }; ?>
	<div class="row">
		<div class="col-md-12">
			<?php if ($archive == 1 && ($permission != 0)) { ?>
			<a href="/Orders/unArchive/<?php echo $id; ?>" class="btn btn-primary btn-block">Przywróć z archiwum</a>
			<?php }elseif ($archive == 0) { ?>
			<a href="/Orders/addArchive/<?php echo $id; ?>" class="btn btn-primary btn-block">Archiwizuj</a>
			<?php }; ?>
		</div>
	</div>
</div>
<!-- ////////////////////////////////KONIEC PRZYCISKÓW EDYCJI/////////////////////////////////// -->

<!-- ////////////////////////////////POMIARY//////////////////////////////////////////// -->
<div class="tab-pane fade" id="measure" role="tabpanel" aria-labelledby="measure-tab">
	<button style="float: left;" class="addIcon" data-toggle="modal" data-target="#addMeasure" view="all" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></button><br />
	<table class="table table-sm">
	    <thead class="thead-light"><tr>
	   	<th>Data pomiaru</th>
		<th>Adres pomiaru</th>
		<th>Numer tel.</th>
		<th>Email</th>
		<th>Opis</th>
		<th>Autor</th>
		<th>Data utworzenia</th>
		<th>Edycja</th>
	    </tr></thead>
	    <tbody>
	    	<?php foreach ($measure as $m) {
	    		echo '<tr>
	    		<Td>'.$m['date_measure'].'</td>
	    		<td>'.$m['address'].'</td>
	    		<td>'.$m['contact'].'</td>
	    		<td>'.$m['mail'].'</td>
	    		<td>'.$m['description'].'</td>
	    		<td>'.$m['autorName'].' '.$m['autorSurname'].'</td>
	    		<td>'.$m['date_create'].'</td>
	    		<td><a href="/Measure/delete/'.$m['id'].'" class="btn-danger btn-xs">Usuń</a></td></tr>';
	    	};
	    	?>
		</tbody>
	</table>
</div>
<!-- ///////////////////////////////KONIEC POMIARÓW/////////////////////////////// -->

<!-- //////////////////////////////////KARTY BRAKÓW////////////////////////////////////////////// -->
<div class="tab-pane fade" id="lacks" role="tabpanel" aria-labelledby="lacks-tab">
	<div class="card bg-light">
	<div class="card-header">Karty Braków
	<button style="float: right;" class="addIcon" data-toggle="modal" data-target="#addLack" view="all" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></button><br /></div>
	<table class="table table-sm table-hover">
	    <thead class="thead-light"><tr>
	    <th>Data</th>
	    <th>Numer</th>
	    <th>Opis</th>
	    <th>Typ</th>
	    <th>Stan</th>
	    <th>Autor</th>
	    <th></th>
	    </tr></thead>
	    <tbody>
	    	<?php foreach ($lacks as $lack) {
	    		($lack['inside'] == 1) ? $typ = 'Niezgodność wewnętrzna' : $typ = 'Reklamacja';
	    		($lack['active'] == 1) ? $active = 'Aktywne' : $active = 'Nieaktywne';
	    		echo '<tr class="thead-light">
	    		<td>'.$lack['date'].'</td>
	    		<td>'.$lack['name'].'</td>
	    		<td>'.$lack['description'].'</td>
	    		<td>'.$typ.'</td>
	    		<td>'.$active.'</td>
	    		<td>'.$lack['autorName']. ' '.$lack['autorSurname'].'</td>
	    		<td><div class="btn-group">
	    		<a href="/Lack/deleteLack/'.$lack['id'].'/'.$id.'" class="btn-danger btn-sm" type="button">Usuń</a>';
	    		if ($lack['active'] == 1) {
	    			echo '<a href="/Lack/unActive/'.$lack['id'].'/'.$id.'" class="btn-info btn-sm" type="button">Dezaktywuj</a>';
	    		}else{
	    			echo '<a href="/Lack/addActive/'.$lack['id'].'/'.$id.'" class="btn-info btn-sm" type="button">Aktywuj</a>';

	    		};
	    		echo '<a href="/Lack/printIdLack/'.$lack['id'].'" class="btn-primary btn-sm" type="button">Drukuj</a>
	    		<a href="/Lack/edit/'.$lack['id'].'" class="btn btn-success btn-sm" type="button">Edytuj</a>';
	    		echo '</div></td>
	    		</tr>';
	    	}
	    	?>
		</tbody>
	</table>
</div>
</div>
<!-- ///////////////////////////////KONIEC KART BRAKÓW////////////////////////////////// -->

<!-- /////////////////////////////////UPLOAD PLIKÓW/////////////////////////////// -->
<div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="upload-tab">
	<div class="card bg-light">
	<div class="card-header">Załączniki<button style="float: right;" class="addIcon" data-toggle="modal" data-target="#addFile" view="all" per="<?php echo $permission; ?>" archive="<?php echo $archive; ?>"></button><br /></div>
	<table class="table table-sm table-hover">
	    <thead class="thead-light"><tr>
	    <th>Nazwa załącznika</th>
	    <th></th></tr>
		</thead>
		<tbody>
	<?php 
		if ($dir = @opendir($_SERVER['DOCUMENT_ROOT']."/media/upload/files/".$id."/")) {
   			while($file = readdir($dir)) {
   				if ($file != '.' && $file != '..') {
      				echo '<tr><td>'.$file.'</td><td>
      				<div class="btn-group">
      				<a href="/Orders/downloadFile/'.$id.'/'.$file.'" class="btn btn-info btn-sm" type="button">Pobierz</a>
      				<a href="/Orders/deleteFile/'.$id.'/'.$file.'" class="btn btn-danger btn-sm" type="button">Usuń</a>
      				</div>
      				</td></tr>';
      			}
   			}  
  			 closedir($dir);
		}
	?>
	</tbody>
	</table>
</div>
<!-- ///////////////////////////////KONIEC UPLOADU////////////////////////////// -->

</div>
</div>



<!--///////////////////////////// FORMULARZE EDYCJI////////////////////////////////// -->


<!-- editMoney -->
<div class="modal" id="editMoney" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Wartość umowy</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Orders/saveMoney" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="text" name="money" class="form-control" value="<?php echo $money; ?>">
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>

<!-- editDescription -->
<div class="modal" id="editDescription" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Opis</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Orders/saveDescription" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<textarea class="form-control" rows="4" name="description" placeholder="Opis..."><?php echo $description; ?></textarea>
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>

<!-- editWeek -->
<div class="modal" id="editWeek" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Tydzień realizacji</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Orders/saveWeek" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<select name="week" class="form-control">
				<?php 
					for ($i = 1; $i <= 52; $i++) {
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
				?>
				</select>
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>

<!-- editAutor -->
<div class="modal" id="editAutor" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Autor</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Orders/editUser" method="POST">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<select name="user" class="form-control">
					<?php 
						foreach ($usersActive as $user) {
							echo '<option value="'.$user['id'].'">'.$user['name'].' '.$user['surname'].'</option>';
						}
					?>
					</select>
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>

<!-- addMonter -->
<div class="modal" id="addMonter" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Nowy montaż</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Orders/addMonter" method="POST">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<select name="monter" class="form-control">
					<?php 
						foreach ($monters as $monter) {
							echo '<option value="'.$monter['id'].'">'.$monter['name'].'</option>';
						}
					?>
					</select><br>
					Początek montażu: <input type="date" name="startMonter" class="form-control" /><br />
					Koniec montażu: <input type="date" name="endMonter" class="form-control" /><br />
					Opis: <textarea name="description" class="form-control" /></textarea>

      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>


<!-- add material -->
<div class="modal" id="addMaterial" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Nowe zamówienie</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Materials/addMaterial" method="POST">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="text" name="name" placeholder="Nazwa/numer zamówienia" class="form-control">
					<select name="factory" class="form-control">
						<?php 	
							foreach ($factory as $factory2) {
								echo '<option value="'.$factory2['id'].'">'.$factory2['name'].'</option>';
							}
						?>
						</select>
					<textarea class="form-control" rows="4" name="description" placeholder="Opis..."></textarea>
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>

<!-- add FvMonter -->
<div class="modal" id="addFvMonter" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Nowa faktura montażowa</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/FvMonter/addFvMonter" method="POST">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="text" name="name" placeholder="Nazwa/numer faktury" class="form-control">
					<input type="text" name="money" placeholder="Wartość faktury..." class="form-control">
					<textarea class="form-control" rows="4" name="description" placeholder="Opis..."></textarea>
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>

<!-- add FvSale -->
<div class="modal" id="addFvSale" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Nowa faktura sprzedażowa</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/FvSale/addFvSale" method="POST">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="text" name="name" placeholder="Nazwa/numer faktury" class="form-control">
					<input type="text" name="money" placeholder="Wartość faktury..." class="form-control">
					<textarea class="form-control" rows="4" name="description" placeholder="Opis..."></textarea>
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>

<!-- add FvPayment -->
<div class="modal" id="addFvPayment" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Nowa faktura zakupowa</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/FvPayment/addFvPayment" method="POST">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="text" name="name" placeholder="Nazwa/numer faktury" class="form-control">
					<input type="text" name="money" placeholder="Wartość faktury..." class="form-control">
					<select name="factory" class="form-control">
						<?php 	
							foreach ($factory as $factory) {
								echo '<option value="'.$factory['id'].'">'.$factory['name'].'</option>';
							}
						?>
						</select>
					<textarea class="form-control" rows="4" name="description" placeholder="Opis..."></textarea>
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>

<!-- add Lack -->
<div class="modal" id="addLack" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Nowa karta braków</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Lack/addLack" method="POST">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<label class="radio-inline">
 						 <input type="radio" name="inside" id="inlineRadio1" value="1"> Niezgodność wewnętrzna
					</label>
					<label class="radio-inline">
  						<input type="radio" name="inside" id="inlineRadio2" value="0"> Reklamacja
					</label>

					<textarea class="form-control" rows="4" name="description" placeholder="Opis..."></textarea>
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>

<!-- deleteOrder -->
<div class="modal" id="formDeleteOrder" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Usuwanie zlecenia</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Orders/deleteOrder" method="POST">
					Czy na pewno chcesz usunąć zlecenie?
					Zostanie ono bezpowrotnie usunięte z bazy danych.
					<input type="hidden" name="id" value="<?php echo $id; ?>">
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="Usuń">
          		</form>
        	</div>
     	</div>
    </div>
</div>

<!-- add Measure -->
<div class="modal" id="addMeasure" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Nowy pomiar</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Measure/saveMeasureOrder" method="POST">
      				<input type="hidden" name="order" value="<?php echo $id; ?>" />
      				<input type="hidden" name="client" value="<?php echo $clientId; ?>" />
					<input type="text" name="address" placeholder="Adres pomiaru..." class="form-control" id="address">
					<input type="text" name="contact" placeholder="Numer tel..." class="form-control" id="contact">
					<input type="text" name="mail" placeholder="Email..." class="form-control" id="mail">
					<input type="date" name="date_measure" class="form-control">
					<textarea name="description" class="form-control" placeholder="Dodatkowe informacje..."></textarea>
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>

<!-- add File -->
<div class="modal" id="addFile" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Nowy załącznik</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Orders/addFile" enctype="multipart/form-data" method="POST">
      				<input type="hidden" name="id" value="<?php echo $id; ?>" />
					<input type="file" name="file" class="form-control"/>
      			<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>
