<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<div id="header">
		</div>
		<?php
			//Connexion à la base de données
			include("connect_bdd.php");
			
			mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
			
			// On récupère l'id du profil à supprimer (depuis l'url)
			$idSelect = $_GET['id'];
			
			// On effectue une requête afin de récupérer le nom de l'image du profil du membre			
			$requetPhoto = "SELECT PhotoMembre FROM Membre WHERE IdMembre='".$idSelect."'";
			$resultPhoto = mysql_query($requetPhoto) or die ("Erreur de la base de données.");
			$nomPhoto = mysql_fetch_row($resultPhoto);
			
			// requête pour supprimer le profil
			$requetSuppr = "DELETE FROM Membre WHERE IdMembre='".$idSelect."'";
			$resultSuppr = mysql_query($requetSuppr) or die ("Erreur de la base de données.");
			
			//On supprime l'image du dossier imgProfil
			$filename = "imgProfil/".$nomPhoto[0].".jpg";
			unlink($filename);

			// On détruit les variables de la session
			session_unset ();

			// On détruit la session
			session_destroy ();

			echo "<script>alert('Votre profil a bien été supprimé.')</script>";
			// on redirige notre visiteur vers la page d'accueil
			echo "<script>window.location.replace('ipress/index.php');</script>";

		?>
	</body>
</html>