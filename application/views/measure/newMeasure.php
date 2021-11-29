 <script src="/media/client/newMeasure.js"></script>
<div ng-controller="NewMeasureCtrl">

<h3>Nowy pomiar</h3>

<form action="/Measure/addMeasure" method="POST" class="card">
	 <div class="card-body">

		<!-- Przycisk Zapisu/anulacji -->
		<div class="form-group">
			<input type="submit" name="addMeasure" value="ZAPISZ" class="btn btn-success" />
			<a href="/Measure" class="btn btn-danger" />ANULUJ</a>
		</div>

		<div class="row">
			<div class="col-md-6">
				<input type="text" name="address" placeholder="Adres pomiaru..." class="form-control" id="address">
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<input type="text" name="contact" placeholder="Numer tel..." class="form-control" id="contact">
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<input type="text" name="mail" placeholder="Email..." class="form-control" id="mail">
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<input type="date" name="date_measure" class="form-control">
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<textarea name="description" class="form-control" placeholder="Dodatkowe informacje..."></textarea>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
			<div class="card">
			<div class="card-header">Kontrahent</div>
			<div class="card-block">
			<div class="card-text">
				<div class="form-group">
					<input type="text" ng-model="filterBy.name" ng-disabled="order.new_client" placeholder="Wyszukiwanie klienta" class="form-control">
				</div>

				<div class="form-group">
					<select multiple class="form-control" ng-disabled="order.new_client" name="clientId" ng-model="order.clientId">
						<option ng-repeat="client in clients | filter: filterBy" value="{{client.id}}">{{client.name}}</option>
					</select>
				</div>
				
				<div class="form-group">
					<label class="control control-checkbox">Nowy klient
						<input type="checkbox" ng-model="order.new_client" name="new_client" id="pcv_color" value="1" />
						<div class="control_indicator"></div>
					</label>
				</div>
				<input type="text" ng-model="order.clientName" name="nameClient" class="form-control" ng-disabled="!order.new_client" placeholder="Nazwa..." class="form-control" />
			</div>
			</div>
			</div>
		</div>
	</div>
	</div>
</form>