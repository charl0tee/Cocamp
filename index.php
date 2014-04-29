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
			
			// On teste si l'utilisateur est déjà connecté
			if (!isset($_SESSION['mail'])) {
				echo "<div id='connexion'>
					<form method='post' action='login_connect.php'>
						<h2>Se connecter</h2>
						<p>Mail : <input type='text' name='mail_connect' /></p>
						<p>Mot de passe : <input type='password' name='mdp_connect' /></p>
						<input type='submit' value='Connexion' />
					</form>
				</div>
				<a href='inscription.php'>S'inscrire</a>";
			}		
			else {
				echo "Bonjour ".$_SESSION['prenom'];

				echo "<br /><div id='deconnection'><a href='logout.php'>Se déconnecter</a></div>";
			}	
		?>
		</div>
		<div id="footer">
		</div>
	</body>
</html>