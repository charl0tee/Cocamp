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
		<br/>
		<div id="content">
		<?php
			//Connexion à la base de données
			include("connect_bdd.php");

			mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
			
			// On récupère l'ID de l'annonce sur laquelle l'utilisateur a cliqué
			$idSelect = $_GET['id'];
			
			// On récupère le titre de l'annonce sélectionnée
			$requetTitre = "SELECT TitreAnn FROM Annonce WHERE IdAnn='".$idSelect."'";
			$resultTitre = mysql_query($requetTitre) or die ("Erreur de la base de données.");
			$titre=mysql_fetch_row($resultTitre);
			
			// On affiche le titre de l'annonce sélectionnée
			echo $titre[0]."<br />"; 
			
			
			// fonction pour convertir la date en format français et en format texte
			function datefr($date) { 
				$split = explode("-",$date); 
				$annee = $split[0]; 
				$mois = $split[1]; 
				$jour = $split[2];
				switch ($mois){
			        case 01:
		                $moistxt = ' janvier ';
		                break;
					case 02:
		                $moistxt = ' février ';
		                break;
			        case 03:
		                $moistxt = ' mars ';
		                break;
			        case 04:
		                $moistxt = ' avril ';
		                break;
			        case 05:
		                $moistxt = ' mai ';
		                break;
			        case 06:
		                $moistxt = ' juin ';
		                break;
			        case 07:
		                $moistxt = ' juillet ';
		                break;
			        case 08:
		                $moistxt = ' août ';
		                break;
			        case 09:
		                $moistxt = ' septembre ';
		                break;
			        case 10:
		                $moistxt = ' octobre ';
		                break;
					case 11:
		                $moistxt = ' novembre ';
		                break;
					case 12:
		                $moistxt = ' décembre ';
				}
				return "$jour"." "."$moistxt"." "."$annee";
			}
			
			// On récupère la date de l'annonce sélectionnée
			$requetDateAnn = "SELECT DateAnn FROM Annonce WHERE IdAnn='".$idSelect."'";
			$resultDateAnn = mysql_query($requetDateAnn) or die ("Erreur de la base de données.");
			$dateAnn=mysql_fetch_row($resultDateAnn);


			// On récupère le prénom et le nom du membre qui a posté l'annonce sélectionnée
			$requetMembre = "SELECT Membre.IdMembre, Membre.NomMembre, Membre.PrenomMembre, Membre.MailMembre FROM Membre, Annonce WHERE Annonce.IdMembre=Membre.IdMembre AND Annonce.IdAnn='".$idSelect."'";
			$resultMembre = mysql_query($requetMembre) or die ("Erreur de la base de données.");
			$membre=mysql_fetch_row($resultMembre);
			
			// On affiche le nom et prénom du membre et la date de l'annonce sélectionnée
			echo "Cette annonce a été postée par ".$membre[2]." ".$membre[1]." le ".datefr($dateAnn[0])."<br />";
			
			// On stocke l'id du membre qui a posté l'annonce
			$idMembre = $membre[0];
			
			//afficher l'image de l'annonce sélectionnée 
			
			$requetImage = "SELECT UrlImage FROM Image WHERE IdAnn='".$idSelect."'";
			$resultImage = mysql_query($requetImage) or die ("Erreur de la base de données.");
			$Image = mysql_fetch_row($resultImage);
			if(!empty($Image)) {
				echo "<img src='imgAnnonce/".$Image[0].".jpg'/><br/>";
			}
			else { 
				echo "";
			}
			
			// On récupère le prix de l'annonce sélectionnée
			$requetPrix = "SELECT PrixAnn FROM Annonce WHERE IdAnn='".$idSelect."'";
			$resultPrix = mysql_query($requetPrix) or die ("Erreur de la base de données.");
			$prix=mysql_fetch_row($resultPrix);
			if(!empty($prix)) {
				// On affiche le prix de l'annonce sélectionnée
				echo "Prix : ".$prix[0]." €<br />";
			}
			else{
				echo "";
			}
			
			
			// On récupère la ville et le code postal de l'annonce sélectionnée
			$requetVille = "SELECT Localisation.VilleLocal, Localisation.CodePostLocal FROM Localisation, Annonce WHERE Localisation.IdLocal=Annonce.IdLocal AND Annonce.IdAnn='".$idSelect."'";
			$resultVille = mysql_query($requetVille) or die ("Erreur de la base de données.");
			$ville=mysql_fetch_row($resultVille);
			
			// On affiche la ville de l'annonce sélectionnée
			echo "Ville : ".$ville[0]."<br />";
			// On affiche le code postal de l'annonce sélectionnée
			echo "Code postal : ".$ville[1]."<br />";

			// On récupère la description de l'annonce sélectionnée
			$requetDescr = "SELECT DescrAnn FROM Annonce WHERE IdAnn='".$idSelect."'";
			$resultDescr = mysql_query($requetDescr) or die ("Erreur de la base de données.");
			$descr=mysql_fetch_row($resultDescr);
			
			// On affiche la description de l'annonce sélectionnée
			echo "Description :<br />".$descr[0];	
		
		
			echo "<br /><a href='envoi_message.php?id=".$idMembre."'>Contacter l'annonceur</a><br />";
			
			if($_SESSION['mail'] == $membre[2]){
				echo "<a href='modif_ann.php?id=".$idSelect."'>Modifier l'annonce</a><br/>";
				echo "<a href='supprim_ann.php?id=".$idSelect."'>Supprimer l'annonce</a>";
			}
		?>
		</div>
		<div id="footer">
		</div>
	</body>
</html>