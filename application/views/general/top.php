<!DOCTYPE html>
<html ng-app="altomApp">
<head>
	<title>ERP Altom</title>
	<link rel="stylesheet" type="text/css" href="/media/framework/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/media/css/reset.css">
	<link rel="stylesheet" type="text/css" href="/media/css/checkbox.css">
	<link rel="stylesheet" type="text/css" href="/media/css/home.css">
	<link rel="stylesheet" type="text/css" href="/media/css/nav.css">
	<link rel="Stylesheet" type="text/css" media="print, handheld" href="/media/css/print.css" />

	<script src="/media/framework/jquery.min.js"></script>
	<script src="/media/framework/angular.min.js"></script>
	<script src="/media/framework/angular-route.min.js"></script>
	<script src="/media/framework/bootstrap.min.js"></script>
	<script src="/media/client/generalClient.js"></script>
	<script src="/media/framework/nav.js"></script>

</head>
<body>
<nav class="nav">
	<ul>
		<li><a href="/">Strona Główna</a>
		<li class="drop"><a href="#">Zlecenia</a>
			<ul class="dropdown">
				<li><a href="/Orders">Lista zleceń</a></li>
				<li><a href="/Timetable">Harmonogram zleceń</a></li>
				<li><a href="/Clients">Lista klientów</a></li>
				<li><a href="/Orders/newOrder">+ Nowe zlecenie</a></li>
				<li><a href="/Clients/newClient">+ Nowy klient</a></li>
			</ul>
		</li>
		<li class="drop"><a href="#">Pomiary</a>
			<ul class="dropdown">
				<li><a href="/Measure">Lista aktualnych pomiarów</a>
				<li><a href="/Measure/archive">Archiwum pomiarów</a>
				<li><a href="/Measure/newMeasure"> + Nowy pomiar</a></li>
			</ul>

		</li>
		<li><a href="/Lack">Karty Braków</a></li>
		<li><a href="/Raports">Raporty</a></li>
		<li class="drop"><a href="#">Magazyn</a>
			<ul class="dropdown">
				<li><a href="/Warehouse">Magazyn - Aluminium</a></li>
				<li><a href="/WarehouseRoto">Magazyn - Roto</a></li>
			</ul>
		</li>
		<li class="drop"><a href="#">Montaże</a>
			<ul class="dropdown">
				<li><a href="/Monters">Harmonogram montaży</a></li>
			</ul>
		</li>
		<li><a href="/Admin">Ustawienia</a></li>
		<li><a href="/User/logout">Wyloguj</a></li>
	</ul>
</nav>


	<div class="context">
