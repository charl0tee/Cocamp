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
			$requet = "SELECT Membre.IdMembre, Membre.MailMembre, Image.IdImage FROM Annonce, Membre, Image WHERE Annonce.IdMembre=Membre.IdMembre AND Annonce.IdAnn=Image.IdAnn AND Annonce.IdAnn='".$idSelect."'";
			$result = mysql_query($requet) or die ("Erreur de la base de données.");
			$affiche = mysql_fetch_row($result);
			
			// On vérifie que l'annonce à modifier est bien celle du membre connecté
			if($affiche[1]==$_SESSION['mail']){
				// requête pour supprimer l'image dans la BDD
				$requetSupprIm = "DELETE FROM Image WHERE IdAnn='".$idSelect."'";
				$resultSupprIm = mysql_query($requetSupprIm) or die ("Erreur de la base de données.");
				// requête pour supprimer l'annonce
				$requetSuppr = "DELETE FROM Annonce WHERE IdAnn='".$idSelect."'";
				$resultSuppr = mysql_query($requetSuppr) or die ("Erreur de la base de données.");
				
				//On supprime l'image du dossier imgAnnonce
				/*$uploads_dir = 'imgAnnonce';
				$name = $affiche[2];
				
		       	unlink($tmp_name, "$uploads_dir/$newname.jpg");*/

				$filename = "imgAnnonce/".$affiche[2].".jpg"; //nom de ton fichier ici.
				unlink($filename);

				echo "<script>alert('Votre annonce a bien été supprimée.')</script>";
				// on redirige notre visiteur vers la page d'accueil
				echo "<script>window.location.replace('ipress/profil.php?id=".$affiche[0]."');</script>";
			}
			else{
				echo "Cette annonce ne vous appartient pas.";
			}
		?>
	</body>
</html>