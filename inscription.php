<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Inscription</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<div id="header">
		</div>
		<div id="content">
			<?php
				//Connexion à la base de données
				include("connect_bdd.php");
			?>	
			<div id='inscription'>
				<form method='post' action='login_inscript.php' ENCTYPE='multipart/form-data'>
					<h2>S'inscrire</h2>
					<p>Nom : <input type='text' name='nom' /></p>
					<p>Prénom : <input type='text' name='prenom' /></p>
					<p>Age : <input type='text' name='age' maxlength="2"/></p>
					<p>Formation : <input type='text' name='formation' /></p>
					<p>Mail : <input type='text' name='mail' /></p>
					<p>Mot de passe : <input type='password' name='mdp_inscript' /></p>
					<p>
						Image : <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
						<input type='file' name='image' />
					</p>
					<input type='submit' value='Valider' />
				</form>
			</div>
		</div>
		<div id="footer">
		</div>
	</body>
</html>