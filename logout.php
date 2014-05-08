<?php
session_start ();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<?php
			//Connexion à la base de données
			include("connect_bdd.php");

			// On détruit les variables de notre session
			session_unset ();

			// On détruit notre session
			session_destroy ();

			// On redirige le visiteur vers la page d'accueil
			echo "<script>window.location.replace('ipress/index.php');</script>";

		?>
	</body>
</html>
