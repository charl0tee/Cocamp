<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title></title>
	</head>
	<body>
		<?php
			//Connexion à la base de données
			include("connect_bdd.php");
			
			// On teste si le mail correspond au mot de passe et s'ils existent dans la BDD
			if (isset($_POST['mail_connect']) && isset($_POST['mdp_connect'])) {
				$mail_connect=$_POST['mail_connect'];
				$mdp_connect=$_POST['mdp_connect'];
				$requet = "SELECT * FROM Membre WHERE MailMembre='$mail_connect' AND MdpMembre='$mdp_connect'"; 
				$result = mysql_query($requet) or die("Erreur de base de données.");
				$num = mysql_num_rows($result);
				// Si la requête donne au moins un résultat c'est que l'utilisateur existe dans la BDD
				if ($num == 1){
					// on démarre la session
					session_start ();
					
					// Requête pour récupérer le prénom du membre qui vient de se connecter
					$requet_prenom="SELECT PrenomMembre FROM Membre WHERE MailMembre='$mail_connect' AND MdpMembre='$mdp_connect'";
					$result_prenom= mysql_query($requet_prenom) or die("Erreur de base de données.");
					$prenom=mysql_fetch_row($result_prenom);

					// on enregistre les paramètres de notre visiteur comme variables de session
					$_SESSION['mail'] = $mail_connect;
					$_SESSION['prenom']=$prenom[0];

					// on redirige notre visiteur vers la page d'accueil
					echo "<script>window.location.replace('ipress/index.php');</script>";
					//header('Location: index.php');
				}
				else { 
					echo "<script>alert('Mauvais mail ou mauvais mot de passe. Veuillez réessayer.');</script>";
					// on redirige notre visiteur vers la page pour s'inscrire
					echo "<script>window.location.replace('ipress/index.php');</script>";
				}
			}		
			else { 
				echo "<script>alert('Veuillez remplir tous les champs.');</script>";
				// on redirige notre visiteur vers la page pour s'inscrire
				echo "<script>window.location.replace('ipress/index.php');</script>";
			}	
		?>
	</body>
</html>