<script src="/media/client/warehouseRoto.js"></script>
<div ng-controller="WarehouseRotoCtrl">

<h3>Magazyn Roto</h3>

<div class="btn btn-success" data-toggle="modal" data-target="#addArticle">Nowy Artykuł</div>
<div class="btn btn-info" data-toggle="modal" data-target="#addZam">Analiza zamówienia materiałowego</div>
<A href="/WarehouseRoto/listZamRoto" class="btn btn-info">Lista Zamówień</a>
  <div class="card">
  <div class="card-text">
    <form role="form">
      <h2>Wyszukiwanie i filtracja</h2>
      <div class="row">
        <div class="col-md-4">
            <input type="text" ng-model="filterBy.name" name="name" placeholder="Nazwa artykułu..." class="form-control form-control-sm"/>
        </div>
        <div class="col-md-4">
          <input type="text" ng-model="filterBy.sap" placeholder="Numer artykułu..." class="form-control form-control-sm"/>
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
			<th>Paczkowanie</th>
			<th>Ilość</th>	
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="article in articles | filter: filterBy | orderBy: orderByColumn : orderByDir">
			<td>{{article.name}}</td>
		    <td>{{article.sap}}</td>
			<td>{{article.pack}}</td>
			<td>{{article.value}}</td>
		    <td><a href="/WarehouseRoto/edit/{{article.id}}" class="btn btn-success btn-sm">Edytuj</a>
		    	<a href="/WarehouseRoto/delete/{{article.id}}" class="btn btn-danger btn-sm">Usuń</a></td>
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
      			<form action="/WarehouseRoto/addArticle" method="POST">
      				<div class="form-group"><input type="text" name="name" placeholder="Nazwa..." class="form-control" /></div>
      				<div class="form-group"><input type="text" name="sap" placeholder="Oznaczenie..." class="form-control" /></div>
      				<div class="form-group"><input type="text" name="pack" placeholder="Paczkowane..." class="form-control" /></div>
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
      			<form action="/WarehouseRoto/addAutomaticZamRoto" method="POST" ENCTYPE="multipart/form-data">
      			Zamówienie w formacie CSV (Roto - WinCon)<input type="file" name="fileZam" class="form-control"/><br/>
      			<div class="form-group"><label>Nazwa zamówienia: </label><input type="text" name="name" class="form-control"></div>


      		</div>
       		<div class="modal-footer">
          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
          		<input type="submit" class="btn btn-primary" value="analizuj">
          		</form>
        	</div>
     	</div>
    </div>
</div>