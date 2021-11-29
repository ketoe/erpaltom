<script src="/media/client/orders.js"></script>
<div ng-controller="OrdersListCtrl">

<h3>Zlecenia</h3>
<h2><div id="actual_year"><?php echo $Actual_year; ?></div></h2>

<select class="form-control form-control-sm selectYear">
	<option value="">Wybierz rok...</option>
	<?php 
		for ($i = 0; $i < count($Years); $i++) {
			echo '<option value="'.$Years[$i].'">'.$Years[$i].'</option>';
		}
	?>
</select>

<form role="form">
   	<h2>Wyszukiwanie i filtracja</h2>
   	<div class="row">
   		<div class="col-md-2">
   			<input type="text" ng-model="filterBy.name" name="name" placeholder="Numer zlecenia" class="form-control form-control-sm"/>
   		</div>
   		<div class="col-md-3">
   		 	<select ng-model="filterBy.autor" name="filter-users" class="form-control form-control-sm">
   		 		<option value="">Wszyscy autorzy</option>
   		 		<option ng-repeat="user in users" value="{{user.id}}">{{user.name}} {{user.surname}}</option>
   		 	</select>
   		</div>
   		<div class="col-md-3">
   			<input type="text" ng-model="filterBy.clientName" placeholder="Klient..." class="form-control form-control-sm"/>
   		</div>

   		<?php if ($this->session->userdata('viewDescriptionList') == TRUE) { ?>
   		<div class="col-md-2">
   			<input type="text" ng-model="filterBy.description" placeholder="Opis..." class="form-control form-control-sm"/>
   		</div>
   		<?php }; ?>

   		<div class="col-md-2">
   			<a href="/Orders/newOrder" class="btn btn-success btn-block form-control form-control-sm btn-sm">Nowe zlecenie</a>
   		</div>
   	</div>
</form><br />

<?php 
if ($this->session->userdata('viewDescriptionList') == TRUE) {
	echo '<a href="/Orders/hideDescriptionList" class="btn btn-info btn-sm">Ukryj opis</a>';
}else {
	echo '<a href="/Orders/showDescriptionList" class="btn btn-info btn-sm">Pokaż opis</a>';
}
?>


<table class="table table-sm table-striped">
	<thead class="thead-light">		
		<tr>
			<th>Data utworzenia</th>
			<th>Numer zlecenia</th>
			<th>Kontrahent</th>
			<th>Wartość umowy</th>
			<th>Tydzień realizacji</th>
			<th>Autor</th>
			<?php 
			if ($this->session->userdata('viewDescriptionList') == TRUE) {
				echo '<th>Opis</th>';
			};
			?>	
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php if ($this->session->userdata('new_order') > 0) {
			echo '<tr><td colspan="7"><div class="alert alert-success" role="alert">Nowe zlecenie zostało utworzone</div></td></tr>';
		}
		?>
		<tr archive={{order.archive}} ng-repeat="order in orders | filter: filterBy | orderBy: orderByColumn : orderByDir">
			<td>{{order.date_create}}</td>
		    <td>{{order.name}}</td>
			<td>{{order.clientName}}</td>
			<td>{{order.money}} zł</td>
		    <td>{{order.week}}</td>
		    <td>{{order.autorName}} {{order.autorSurname}}</td>
		    <?php 
		    if ($this->session->userdata('viewDescriptionList') == TRUE) {
		   	?>
		   	<td>{{order.description}}</td>
		   	<?php }; ?>
		    <td><a href="/Orders/view/{{order.id}}" class="btn btn-primary btn-small">PODGLĄD</a></td>
		</tr>
	</tbody>
</table>
