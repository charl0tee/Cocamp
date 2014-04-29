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
		<div id="content">
		<?php
			//Connexion à la base de données
			include("connect_bdd.php");

			mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
			
			//Requête pour afficher les données du membre
			$requet_membre="SELECT NomMembre, PrenomMembre, MailMembre, ScolMembre, AgeMembre, PhotoMembre FROM Membre WHERE MailMembre='".$_SESSION['mail']."'";
			$result_membre=mysql_query($requet_membre) or die("Erreur de base de données.");
			$membre=mysql_fetch_row($result_membre);	
			echo "Prénom : ".$membre[1]."<br /> Nom : ".$membre[0]."<br /> Mail : ".$membre[2]."<br /> Scolarité : ".$membre[3]."<br /> Age : ".$membre[4]."<br />";
			echo "<img src='imgProfil/".$membre[5].".jpg'/><br />";



			echo "Mes annonces";
			
			// On effectue les requêtes afin d'afficher les annonces postées par le membre			
			$requet = "SELECT Annonce.IdAnn, Annonce.TitreAnn, Annonce.PrixAnn, Annonce.CatAnn, Annonce.DescrAnn, Localisation.VilleLocal, Annonce.DateAnn, Image.UrlImage FROM Annonce, Localisation, Image, Membre WHERE Localisation.IdLocal=Annonce.IdLocal AND Image.IdAnn=Annonce.IdAnn AND Membre.IdMembre=Annonce.IdMembre AND Membre.MailMembre='".$_SESSION['mail']."'";
			$result = mysql_query($requet) or die ("Erreur de la base de données.");
			while($affiche = mysql_fetch_row($result)) {
				// le lien renvoie vers l'annonce sélectionnée grâce à l'ID récupéré par la méthode GET
				echo "<a href='annonce.php?id=".$affiche[0]."'>".$affiche[1]." - ".$affiche[3]."<br />".datefr($affiche[6])." - ".$affiche[5]."<br />".$affiche[2]." €<br />".$affiche[4]."</a> <br />";
				echo "<img src='imgAnnonce/".$affiche[7].".jpg'/><br />";
				
			}
			
			// fonction pour convertir la date en format français
			function datefr($date) { 
				$split = split("-",$date); 
				$annee = $split[0]; 
				$mois = $split[1]; 
				$jour = $split[2];
				$moisfr = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
				return "$jour"." "."$moisfr[$mois]"." "."$annee"; 
			}
		?>
		</div>
		<div id="footer">
		</div>
	</body>
</html>