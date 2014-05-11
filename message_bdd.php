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

			// On récupère l'ID du destinataire
			$destinataire = $_GET['id'];

			if(!empty($_POST['message'])){
				// Requête pour récupérer l'id du membre qui envoie le message
				$requet_membre="SELECT IdMembre FROM Membre WHERE MailMembre='".$_SESSION['mail']."'";
				$result_membre=mysql_query($requet_membre) or die("Erreur de base de données.");
				$membre=mysql_fetch_row($result_membre);
				
				$heure = date("H")+2; //ajustement de l'heure avec phpMyAdmin
				$dateMess=date("Y-m-d ".$heure.":i:s");
				$contenuMess=$_POST['message'];
				$emetteur=$membre[0];

				$requetMessage="INSERT INTO Message (IdSender, IdReceiver, ContenuMess, DateMess, EtatMess) values ('$emetteur', '$destinataire', '".mysql_real_escape_string($contenuMess)."', '$dateMess', 'Non lu')";	
				mysql_query($requetMessage) or die("erreur requête".mysql_error());

				echo "<script>alert('Votre message a bien été envoyé !')</script>";
				// on redirige notre visiteur vers la page de l'annonce
				echo "<script>window.location.replace('ipress/messagerie.php');</script>";

			}
			else{
				echo "<script>alert('Veuillez écrire un message')</script>";
				// on redirige notre visiteur vers la page de l'annonce
				echo "<script>window.location.replace('ipress/envoi_message.php?id=".$destinataire."');</script>";
			}
		?>
	</body>
</html>