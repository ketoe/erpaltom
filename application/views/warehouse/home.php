<script src="/media/client/warehouse.js"></script>
<div ng-controller="WarehouseCtrl">

<h3>Magazyn</h3>

<div class="btn btn-success" data-toggle="modal" data-target="#addArticle">Nowy Artykuł</div>
<div class="btn btn-info" data-toggle="modal" data-target="#addZam">Analiza zamówienia materiałowego</div>
<A href="/Warehouse/listZamAluprof" class="btn btn-info">Lista Zamówień</a>
<div class="card">
  <div class="card-text">
    <form role="form">
      <h2>Wyszukiwanie i filtracja</h2>
      <div class="row">
        <div class="col-md-4">
            <input type="text" ng-model="filterBy.name" name="name" placeholder="Nazwa artykułu..." class="form-control form-control-sm"/>
        </div>
        <div class="col-md-4">
          <input type="text" ng-model="filterBy.code" placeholder="Numer artykułu..." class="form-control form-control-sm"/>
        </div>
      </form><br />
    </div>
</div>
</div>
<table class="table table-sm table-striped">
	<thead class="thead-light">		
		<tr>
			<th>Nazwa</th>
			<th>Oznaczenie</th>
			<th>j.m</th>
			<th>Ilość</th>	
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="article in articles | filter: filterBy | orderBy: orderByColumn : orderByDir">
			<td>{{article.name}}</td>
		    <td>{{article.code}}</td>
			<td>{{article.jm}}</td>
			<td>{{article.value}}</td>
		    <td><a href="/Warehouse/edit/{{article.id}}" class="btn btn-success btn-sm">Edytuj</a>
		    	<a href="/Warehouse/delete/{{article.id}}" class="btn btn-danger btn-sm">Usuń</a></td>
		</tr>
	</tbody>
</table>

<!-- addArticle -->
<div class="modal" id="addArticle" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Nowy Artykuł</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Warehouse/addArticle" method="POST">
      				<div class="form-group"><input type="text" name="name" placeholder="Nazwa..." class="form-control" /></div>
      				<div class="form-group"><input type="text" name="code" placeholder="Oznaczenie..." class="form-control" /></div>
      				<div class="form-group"><label for="jm">Jednostka: </label><select name="jm" class="form-control">
      					<option value="szt">szt</option>
      					<option value="kpl">kpl</option>
      					<option value="mb">mb</option>
      					<option value="m2">m2</option>
      				</select></div>
      				<div class="form-group"><label for="code">Ilość:</label><input type="text" name="value" value="0" class="form-control" /></div>
      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="zapisz">
          		</form>
        	</div>
     	</div>
    </div>
</div>


<!-- addZam -->
<div class="modal" id="addZam" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
        	<div class="modal-header">
				<h5 class="modal-title">Analiza zamówienia</h5>
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            			<span aria-hidden="true">×</span>
          			</button>
       		</div>
      		<div class="modal-body">
      			<form action="/Warehouse/addAutomaticZamAluprof" method="POST" ENCTYPE="multipart/form-data">
      			Zamówienie w formacie XML (Aluprof S.A.)<input type="file" name="fileZam" class="form-control"/><br/>
      			<div class="form-group"><label>Nazwa zamówienia: </label><input type="text" name="name" value="<?php echo $nameZam; ?>" class="form-control"></div>
      			<div class="form-group"><label>Nagłówek zamówienia: </label><input  type="text" name="title" value="ZAMÓWIENIE" class="form-control"></div>


      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="analizuj">
          		</form>
        	</div>
     	</div>
    </div>
</div>