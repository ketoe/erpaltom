<!DOCTYPE html>
<html>
<head>
	<title>ERP Altom</title>
	<link rel="stylesheet" type="text/css" href="/media/framework/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/media/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/media/css/home.css">
</head>
<body class="login">
	<div class="logo"></div>
	<div class="card border-primary border-login">
		<div class="card-header">ERP Altom</div>
  		<div class="card-body">
    		<form action="/User/getAuth" method="POST">
				<div class="form-group"><input type="text" name="login" placeholder="Login..." class="form-control"/></div>
				<div class="form-group"><input type="password" name="password" placeholder="Hasło..." class="form-control"/></div>
				<div class="form-group"><input type="submit" name="getLog" value="ZALOGUJ" class="btn btn-success btn-block" /></div>
			</form>
 		</div>
	</div>
	
</body>
</html>
