<!doctype html>
<html lang="fr">
<head>
	<link rel="icon" type="image/png" href="img/gmail.png" />
	<meta charset="utf-8">
	<title>Pangolinette de mail</title>
	<link rel="stylesheet" href="css/foundation.css">
	<!-- This is how you would link your custom stylesheet -->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header>
		<h1>Pangolinette de mail</h1>
	</header>
	<nav>
		<a href="index.php">Retour à l'accueil</a>
	</nav>
	<ul class='main_liste'>
	<?php
	include "simple_html_dom.php";
	include "script_mail.php";
	?>
	</ul>
</body>
</html>