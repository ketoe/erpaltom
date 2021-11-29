<h3>Ustawienia systemowe</h3>
	
<div class="row">
    <div class="col-md-6">
    	<div class="card">
        	<div class="card-header">Aktualny rok produkcyjny</div>
          	<div class="card-block">
            	<div class="card-text">
            		<form action="/Admin/updateActualYear" method="POST">
            			<div class="form-group"><input type="numeric" name="year" value="<?php echo $year; ?>" class="form-control"/></div>
            			<div class="form-group"><input type="submit" name="save" value="zapisz" class="btn btn-success btn-block" /></div>
					</form>
            	</div>
          	</div>
        </div>
    </div>
</div>
			