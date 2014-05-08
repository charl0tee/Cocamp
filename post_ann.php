<?php session_start (); ?>
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
			
		?>
			<h2>Déposer une annonce</h2>	
			<form method='post' action='ann_bdd.php' ENCTYPE='multipart/form-data'>
				<h2>Localisation</h2>
				
				<p>Ville : 
					<select name='ville'>
						<?php
						$requetville = ' SELECT DISTINCT VilleLocal FROM Localisation'; //DISTINCT = éviter les doublons
						$resultville = mysql_query($requetville) or die("Erreur de base de données.");
						while($k=mysql_fetch_row($resultville)){
							echo "<option value=".$k[0].">".$k[0]."</option>";
						}
						?>				
					</select>	
				</p>
				
				<h2>Catégorie</h2>
				
				<select name='Categorie'>
					<option value='' selected>Choisir une catégorie</option>
					<option value='Evenement'>Évènement</option>
					<option value='PetiteAnnonce'>Petites Annonces</option>		
					<option value='Logement'>Logement</option>
					<option value='StageEmploi'>Stage / Emploi</option>	
					<option value='Covoiturage'>Covoiturage</option>
				</select>
					
				<h2>Annonce</h2> 
				<p>Titre : <input type='text' name='TitreAnn'/></p>
				<p>Description :<br /> <textarea rows='10' cols='50' name='DescrAnn'></textarea></p>	
				<p>Prix : <input type='number' name='PrixAnn'/> €</p>
				<p>
					Image* (taille maximum : 1,5 Mo) <!--<input type='hidden' name='MAX_FILE_SIZE' value='8000000 ' />-->
					<input type='file' name='image' /> 
				</p>
				<input type='submit' value='Valider'/>	
				<p>* champ obligatoire</p>
			</form>
		</div>
		<div id="footer">
		</div>	
	</body>
</html>