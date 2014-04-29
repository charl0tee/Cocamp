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
			
			$idSelect = $_GET['id'];
		
			// On effectue une requête afin de récupérer les donnnées de l'annonce que le membre veut supprimer			
			$requet = "SELECT Membre.MailMembre FROM Annonce, Membre WHERE Annonce.IdMembre=Membre.IdMembre AND Annonce.IdAnn='".$idSelect."'";
			$result = mysql_query($requet) or die ("Erreur de la base de données.");
			$affiche = mysql_fetch_row($result);
			
			// On vérifie que l'annonce à modifier est bien celle du membre connecté
			if($affiche[0]==$_SESSION['mail']){
				$requetSuppr = "DELETE FROM Annonce WHERE IdAnn='".$idSelect."'";
				$resultSuppr = mysql_query($requetSuppr) or die ("Erreur de la base de données.");
				
				echo "<br />Votre annonce a bien été supprimée.";
			}
			else{
				echo "Cette annonce ne vous appartient pas.";
			}
		?>
	</body>
</html>