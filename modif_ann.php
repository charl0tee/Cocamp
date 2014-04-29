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
			
			// On récupère l'id de l'annonce à modifier (depuis l'url)
			$idSelect = $_GET['id'];
			
			// On effectue les requêtes afin d'afficher l'annonce que le membre veut modifier dans un formulaire			
			$requet = "SELECT Localisation.VilleLocal, Annonce.TitreAnn, Annonce.DescrAnn, Annonce.PrixAnn, Annonce.CatAnn, Membre.MailMembre FROM Annonce, Localisation, Membre WHERE Localisation.IdLocal=Annonce.IdLocal AND Annonce.IdMembre=Membre.IdMembre AND Annonce.IdAnn='".$idSelect."'";
			$result = mysql_query($requet) or die ("Erreur de la base de données.");
			while($affiche = mysql_fetch_row($result)) {
			
				// On vérifie que l'annonce à modifier est bien celle du membre connecté
				if($affiche[5]==$_SESSION['mail']){

					// On affiche un formulaire pré-rempli avec les données déjà rentrée dans la bdd
					echo "<form method='post' action=''>
					<h2>Localisation</h2>
					
					<p>Ville : 
						<select name='ville'>
							<option selected>".$affiche[0]."</option>";
							$requetville = ' SELECT DISTINCT VilleLocal FROM Localisation'; //DISTINCT = éviter les doublons
							$resultville = mysql_query($requetville) or die("Erreur de base de données.");
							while($k=mysql_fetch_row($resultville)){
								echo "<option value=".$k[0].">".$k[0]."</option>";
							}					
						echo "</select>	
					</p>
					
					<h2>Catégorie</h2>
					
					<select name='Categorie'>
						<option selected>".$affiche[4]."</option>
						<option value='Evenement'>Évènement</option>
						<option value='PetiteAnnonce'>Petites Annonces</option>		
						<option value='Logement'>Logement</option>
						<option value='StageEmploi'>Stage / Emploi</option>			
						<option value='Covoiturage'>Covoiturage</option>
					</select>
						
					<h2>Annonce</h2> 
					<p>Titre : <input type='text' name='TitreAnn' value='".$affiche[1]."'/></p>
					<p>Description :<br /> <textarea rows='10' cols='50' name='DescrAnn'>".$affiche[2]."</textarea></p>	
					<p>Prix : <input type='number' name='PrixAnn'/>".$affiche[3]." €</p>
				
					<input type='submit' name='Valider' value='Valider'/>";
					
					// Si le formulaire a été validé, alors on modifie l'annonce sélectionné et on affiche un message au membre
					if (isset($_POST['Valider'])){
				
						if(!empty($_POST['TitreAnn']) && !empty($_POST['DescrAnn']) && !empty($_POST['PrixAnn'])){
					
							// Mise à jour de l'annonce
							$TitreAnn=$_POST['TitreAnn'];
							$PrixAnn=$_POST['PrixAnn'];
							$DescrAnn=$_POST['DescrAnn'];
							$Categorie=$_POST['Categorie'];
							$ville=$_POST['ville'];
				
							$requetLocalisation="SELECT IdLocal FROM Localisation WHERE VilleLocal='".$ville."'";
							$resultLocalisation=mysql_query($requetLocalisation) or die("erreur requête".mysql_error());
							$idLocal=mysql_fetch_row($resultLocalisation);

							$requetannonce="UPDATE Annonce SET TitreAnn='".mysql_real_escape_string($TitreAnn)."', PrixAnn='".$PrixAnn."', DescrAnn='".mysql_real_escape_string($DescrAnn)."', CatAnn='".$Categorie."', IdLocal='".$idLocal."' WHERE IdAnn='".$idSelect."'";	
							mysql_query($requetannonce) or die("erreur requête".mysql_error());
							
							echo "<br />Votre annonce a été modifiée avec succès <br />";
						}
						else {
							echo "Veuillez remplir tous les champs.";
							echo "<br /><a href='modif_ann.php'>Retour</a><br />";
						}
					}
				}
				else{
					echo "Vous n'êtes pas propriétaire de cette annonce.";
					echo "<br /><a href='index.php'>Retour à la page d'accueil</a>";
				}
			}
		?>
		</div>
	</body>
</html>