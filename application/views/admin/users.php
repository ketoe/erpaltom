<h3>Ustawienia pracowników</h3>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="/Admin/addUser" method="POST">
				<div class="form-group"><input type="text" name="name" placeholder="Imię..." class="form-control" /></div>
				<div class="form-group"><input type="text" name="surname" placeholder="Nazwisko..." class="form-control" /></div>
				<div class="form-group"><input type="text" name="login" placeholder="Login..." class="form-control" /></div>
				<div class="form-group"><input type="text" name="password" placeholder="Hasło..." class="form-control" /></div>



				<div class="form-group"><input type="submit" name="addUser" value="Utwórz pracownika" class="btn btn-success btn-block" /></div></form>
			</div>
		</div>
	</div>
</div>

<Div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
		<div class="panel-body">
				<table class="table table-sm table-striped">
					<thead class="thead-light">
						<tr>
							<th><b>Imię</b></th>
							<th><b>Nazwisko</b></th>
							<th><b>Login</b></th>
							<th><b>Ranga</b></th>
							<th><b>Zmiana rangi</b></th>
							<th><b>Edycja</b></th>
						</tr>
					</thead>
						
		<?php
		foreach ($Users as $u) {
			echo '<tr class="small-text" active="'.$u['active'].'"><td>'.$u['name'].'</td><td>'.$u['surname'].'</td><td>'.$u['login'].'</td><td>'.$dataPermission[$u['permission']]['name'].'</td><td>';

			/*Zmiana rangi*/
			if ($u['permission'] == 0) {
				echo '<a href="/Admin/editPermission/'.$u['id'].'/1" class="btn btn-success btn-sm">Moderator</a>';
				echo '<a href="/Admin/editPermission/'.$u['id'].'/2" class="btn btn-success btn-sm">Admin</a>';
			}elseif ($u['permission'] == 1) {
				echo '<a href="/Admin/editPermission/'.$u['id'].'/0" class="btn btn-success btn-sm">Użytkownik</a>';
				echo '<a href="/Admin/editPermission/'.$u['id'].'/2" class="btn btn-success btn-sm">Admin</a>';
			}elseif ($u['permission'] == 2) {
				echo '<a href="/Admin/editPermission/'.$u['id'].'/0" class="btn btn-success btn-sm">Użytkownik</a>';
				echo '<a href="/Admin/editPermission/'.$u['id'].'/1" class="btn btn-success btn-sm">Moderator</a>';
			}

			echo '</td>';

			/*Aktywacja/dezaktywacja konta*/
			if ($u['active'] == 1 && $u['permission'] != 3) {
				echo '<td><a href="/Admin/unActiveUser/'.$u['id'].'" class="btn btn-info btn-sm">Dezaktywuj</a>';
			}elseif ($u['active'] == 0) {
				echo '<td><a href="/Admin/activeUser/'.$u['id'].'" class="btn btn-info btn-sm">Aktywuj</a>';
			}
			

			echo '</td>
			</tr>';
		}
		?>

		</table>
		</div>
		</div>
