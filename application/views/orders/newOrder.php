<script src="/media/client/newOrder.js"></script>
<div ng-controller="NewOrderCtrl">


<h3>Nowe zlecenie</h3>


<form action="/Orders/addNewOrder" method="POST" class="card">
	<?php if ($measure != null) { ?>
	<input type="hidden" name="measure" value="<?php echo $measure; ?>" />
	<?php }; ?>
	 <div class="card-body">

		<!-- Przycisk Zapisu/anulacji -->
		<div class="form-group">
			<input type="submit" name="addOrder" value="ZAPISZ" class="btn btn-success" />
			<a href="/Orders" class="btn btn-danger" />ANULUJ</a>
		</div>

	
		<!-- z montażem -->
		<!-- <div class="control-group">
			 <label class="control control-checkbox">
				Z montażem
				<input type="checkbox" name="orderMonter" id="orderMonter" value="1" />
				<div class="control_indicator"></div>
			</label>
		</div> -->

	<!-- Zakres umowy -->
	<div class="row">
	<div class="col-md-4">
	
	<div class="card">
		<div class="card-header">Zakres umowy</div>
		<div class="card-block">
		<div class="card-text">
			<div class="control-group">
			 	<label class="control control-checkbox">Okna PCV białe
					<input type="checkbox" name="pcv_white" id="pcv_white" value="1" />
					<div class="control_indicator"></div>
				</label>

				<label class="control control-checkbox">Okna PCV w kolorze
					<input type="checkbox" name="pcv_color" id="pcv_color" value="1" />
					<div class="control_indicator"></div>
				</label>

				<label class="control control-checkbox">Aluminium
					<input type="checkbox" name="aluminium" id="aluminium" value="1" />
					<div class="control_indicator"></div>
				</label>

				<label class="control control-checkbox">Rolety
					<input type="checkbox" name="rolets" id="rolets" value="1" />
					<div class="control_indicator"></div>
				</label>

				<label class="control control-checkbox">Parapety
					<input type="checkbox" name="parapets" id="parapets" value="1" />
					<div class="control_indicator"></div>
				</label>

				<label class="control control-checkbox">Szyby
					<input type="checkbox" name="glass" id="glass" value="1" />
					<div class="control_indicator"></div>
				</label>

				<input type="text" name="anotherElement" placeholder="Inne..." class="form-control" />
				<br />
				<label class="control control-checkbox">Z montażem
					<input type="checkbox" name="orderMonter" id="orderMonter" value="1" />
					<div class="control_indicator"></div>
				</label>

			</div>
		</div>
		</div>
	</div>

	</div>

	
	<!-- TERMINY -->
	<div class="col-md-4">
		<div class="card">
		<div class="card-header">Terminy:</div>
		<div class="card-block">
		<div class="card-text">
			<div class="form-group">
				<select name="week" class="form-control" ng-model="order.week">
					<option value="">Tydzień</option>
					<?php for ($w = 1; $w <= 52; $w++) {
						echo '<option value="'.$w.'">'.$w.'</option>';
					}
					?>
				</select>
			</div>
			
			<div class="form-group">
				<select name="year" class="form-control" ng-model="order.year">
					<option value="">Rok</option>
					<?php
					for ($i = 0; $i < count($Years); $i++) {
						echo '<option value="'.$Years[$i].'">'.$Years[$i].'</option>';
					}
					?>
				</select>
			</div>
		</div>
		</div>
		</div>
	</div>


	<!-- Wartość umowy netto -->
	<div class="col-md-4">
		<div class="card">
		<div class="card-header">Wartość</div>
		<div class="card-block">
		<div class="card-text">
			<div class="form-group">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
   						<span class="input-group-text">PLN</span>
    					<span class="input-group-text">0.00</span>
  					</div>
					<input type="text" name="money" placeholder="Wartość umowy netto..." class="form-control" id="money">
				</div>
			</div>
		</div>
		</div>
		</div>
	</div>
</div>


<div class="row"> <!-- DRUGI WIERSZ -->

	<?php if ($measure == null) { ?>
	<!-- Klient -->
	<div class="col-md-5">
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
	<?php }; ?>



	<!-- Opis -->
	<div class="col-md-7">
		<div class="card">
		<div class="card-header">Opis</div>
		<div class="card-block">
		<div class="card-text">
				<div class="form-group">
					<textarea class="form-control" name="description" placeholder="Opis"></textarea>
				</div>
		</div>
		</div>
		</div>
	</div>

</div>
</div>
</div>	
</form>