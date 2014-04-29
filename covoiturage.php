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
						
			// On effectue la requête afin d'afficher toutes les annonces de la catégorie événement			
			$requetEvenements = "SELECT Annonce.IdAnn, Annonce.TitreAnn, Annonce.PrixAnn, Annonce.CatAnn, Annonce.DescrAnn, Localisation.VilleLocal, Annonce.DateAnn, Image.UrlImage FROM Annonce, Localisation, Image, Membre WHERE Localisation.IdLocal=Annonce.IdLocal AND Image.IdAnn=Annonce.IdAnn AND CatAnn='Covoiturage'";
			$resultEvenements = mysql_query($requetEvenements) or die ("Erreur de la base de données.");
			while($evenements = mysql_fetch_row($resultEvenements)) {
				// le lien renvoie vers l'annonce sélectionnée grâce à l'ID récupéré par la méthode GET
				echo "<a href='annonce.php?id=".$evenements[0]."'>".$evenements[1]." - ".$evenements[3]."<br />".datefr($evenements[6])." - ".$evenements[5]."<br />".$evenements[2]." €<br />".$evenements[4]."</a> <br />";
				echo "<img src='imgAnnonce/".$evenements[7].".jpg'/><br />";
				
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