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

			// Requête pour récupérer l'id du membre qui a recu les messages
			$requet_membre="SELECT IdMembre FROM Membre WHERE MailMembre='".$_SESSION['mail']."'";
			$result_membre=mysql_query($requet_membre) or die("Erreur de base de données.");
			$membre=mysql_fetch_row($result_membre);

			// On effectue une requête afin d'afficher les messages recus par le membre		
			$requet = "SELECT * FROM Message WHERE IdReceiver='".$membre[0]."'";
			$result = mysql_query($requet) or die ("Erreur de la base de données.");

			while($affiche = mysql_fetch_row($result)) {
				// Requête pour récupérer le nom et prénom du membre qui a envoié le message
				$requet_sender="SELECT NomMembre, PrenomMembre FROM Membre WHERE IdMembre='".$affiche[1]."'";
				$result_sender=mysql_query($requet_sender) or die("Erreur de base de données.");
				$sender=mysql_fetch_row($result_sender);

				// on affiche qu'une partie du message
				$messagecoupe=substr($affiche[3], 0, 10);

				// le lien renvoie vers le message sélectionnée grâce à l'ID récupéré par la méthode GET
				echo "<a href='message.php?id=".$affiche[0]."'>Message reçu le ".datefr($affiche[4])." - Par ".$sender[1]." ".$sender[0]." - ".$messagecoupe."</a><br />";	
			}
			
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