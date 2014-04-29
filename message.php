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

			// On récupère l'ID du message
			$idMessage = $_GET['id'];

			// On effectue une requête afin d'afficher le message sélectionné		
			$requet = "SELECT * FROM Message WHERE IdMessage='".$idMessage."'";
			$result = mysql_query($requet) or die ("Erreur de la base de données.");
			$affiche = mysql_fetch_row($result);

			// Requête pour récupérer le nom et prénom du membre qui a envoié le message
			$requet_sender="SELECT NomMembre, PrenomMembre FROM Membre WHERE IdMembre='".$affiche[1]."'";
			$result_sender=mysql_query($requet_sender) or die("Erreur de base de données.");
			$sender=mysql_fetch_row($result_sender);

			// on affiche le message
			echo "Le ".datefr($affiche[4])."<br />Envoyé par ".$sender[1]." ".$sender[0];
			echo "<br />".$affiche[3];

			// pour répondre on envoi un message avec l'id du membre qui a envoyé le message
			echo "<br /><a href='envoi_message.php?id=".$affiche[1]."'>Répondre</a>";

			// fonction pour convertir la date en format français et en format texte
			function datefr($date) { 
				$splitTime = explode(" ",$date); 

				$split = explode("-", $splitTime[0]);
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
				return "$jour"." "."$moistxt"." "."$annee"." à "."$splitTime[1]";
			}
		?>
	</body>
</html>