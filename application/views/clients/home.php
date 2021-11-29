<script src="/media/client/clients.js"></script>
<div ng-controller="ClientsListCtrl">

<h3>Lista klientów</h3>

<form role="form">
   	<h2>Wyszukiwanie i filtracja</h2>
   	<div class="row">
   		<div class="col-md-4">
   			<input type="text" ng-model="filterBy.name" name="name" placeholder="nazwa..." class="form-control form-control-sm"/>
   		</div>
   		<div class="col-md-2">
   			<a href="/Clients/newClient" class="btn btn-success btn-block form-control form-control-sm btn-sm">Nowy klient</a>
   		</div>
   	</div>
</form>

<table class="table table-sm table-striped">
	<thead class="thead-light">		
		<tr>
			<th>Nazwa</th>
			<th>adres</th>
			<th>mail</th>
			<th>kontakt</th>
			<th>nip</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="client in clients | filter: filterBy">
			<td>{{client.name}}</td>
			<td>{{client.address}}</td>
			<td>{{client.mail}}</td>
			<td>{{client.phone}}</td>
			<td>{{client.nip}}</td>
		   
		    <td><a href="/Clients/edit/{{client.id}}" class="btn btn-info btn-small">Edycja</a></td>
		</tr>
	</tbody>
</table>
