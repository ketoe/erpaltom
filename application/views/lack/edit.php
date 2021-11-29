<h3>Edycja Karty Braków</h3>

<a href="/Lack" class="btn btn-info btn-sm">Powrót do listy</a><br /><br />
<b>Numer karty braków: </b><?php echo $name; ?><br />
<b>Zlecenie: </b><?php echo $nameOrder; ?><br />

<form action="/Lack/save" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<textarea class="form-control" name="description"><?php echo $description; ?></textarea>
<input type="submit" name="save" value="Zapisz" class="btn btn-success btn-block" />
</form>
