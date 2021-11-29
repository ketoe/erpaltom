<script src="/media/client/newOrder.js"></script>
<div ng-controller="NewOrderCtrl">


<h3>Edycja Klienta</h3>
<form action="/Orders/saveClient" method="POST" class="card">
	<input type="hidden" name="order" value="<?php echo $id; ?>" />
	<div class="card-header">Kontrahent</div>
	<div class="card-block">
		<div class="card-text">
			<div class="form-group">
			<input type="submit" name="saveClient" value="ZAPISZ" class="btn btn-success" />
			<a href="/Orders/view/<?php echo $id; ?>" class="btn btn-danger" />ANULUJ</a>
			</div>
			<div class="form-group">
				<input type="text" ng-model="filterBy.name" ng-disabled="order.new_client" placeholder="Wyszukiwanie klienta" class="form-control">
			</div>

			<div class="form-group">
				<select multiple class="form-control" ng-disabled="order.new_client" name="client" ng-model="order.clientId">
					<option ng-repeat="client in clients | filter: filterBy" value="{{client.id}}">{{client.name}}</option>
				</select>
			</div>
		</div>
	</div>
</form>