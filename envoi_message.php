<?php session_start (); ?>
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

			mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
			
			// On récupère l'ID du membre que l'utilisateur veut contacter
			$idMembre = $_GET['id'];

			// requête pour récupérer le nom et prénom du membre à contacter
			$requetMembre = "SELECT Membre.NomMembre, Membre.PrenomMembre FROM Membre WHERE Membre.IdMembre='".$idMembre."'";
			$resultMembre = mysql_query($requetMembre) or die ("Erreur de la base de données.");
			$membre=mysql_fetch_row($resultMembre);
		
			//début du formulaire
			echo"<h2>Écrire un message</h2>	
				<form method='post' action='message_bdd.php?id=".$idMembre."'>
					<p>Destinataire : ".$membre[1]." ".$membre[0]."</p>

					<p>Message :</p>
					<textarea name='message' rows='10' cols='50'></textarea>

					<input type='submit' value='Envoyer'/>	
				</form>	";
		?>
	</body>
</html>