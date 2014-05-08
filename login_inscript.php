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
			
			// On vérifie si tous les champs sont remplis
			if (isset($_POST['age']) && isset($_POST['formation']) && isset($_POST['mdp_inscript']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail'])){

				//On déclare des variables 
				$age=$_POST['age'];
				$formation=$_POST['formation'];
				$mdp_inscript=$_POST['mdp_inscript'];
				$prenom=$_POST['prenom'];
				$nom=$_POST['nom'];
				$mail=$_POST['mail'];
				
				//On vérifie si le mail n'existe pas déjà
				$requet_exist = "SELECT * FROM Membre WHERE MailMembre='$mail'"; 
				$result = mysql_query($requet_exist) or die("Erreur de base de données.");
				$num = mysql_num_rows($result);
				if ($num == 0){

					// si une image a été ajoutée :
					if (is_uploaded_file($_FILES['image']['tmp_name'])) {
						// vérification de la taille
						if(($_FILES['image']['size'] <= $_POST['MAX_FILE_SIZE'])){
							// on récupère l'id du dernier membre inscrit pour renommer les images selon l'id du membre
							$reqId = "SELECT * FROM Membre ORDER BY IdMembre Desc LIMIT 1"; 
							$resId = mysql_query($reqId);
							$idmax = mysql_fetch_row($resId);
							//echo ($idmax[0]);
							$newname = $idmax[0]+1;

							// On déplace l'image dans le dossier imgProfil
							$uploads_dir = 'imgProfil';
							$tmp_name = $_FILES["image"]["tmp_name"];
					        move_uploaded_file($tmp_name, "$uploads_dir/$newname.jpg");
							
							$requet = "INSERT INTO Membre (NomMembre, PrenomMembre, MdpMembre, MailMembre, ScolMembre, AgeMembre, PhotoMembre) values ('$nom', '$prenom', '".mysql_real_escape_string($mdp_inscript)."', '".mysql_real_escape_string($mail)."', '$formation', '$age', '".mysql_real_escape_string($newname)."')";
							mysql_query($requet) or die("erreur requête".mysql_error());
							//Enregistrement réussi
							// on démarre la session
							session_start ();
							// on enregistre les paramètres de notre visiteur comme variables de session
							$_SESSION['mail'] = $mail;
							$_SESSION['prenom'] = $prenom;

							//Redirection vers la page d'accueil
							echo "<script>
							window.location.replace('ipress/index.php');
							</script> ";
							
						}
						else{
							die("Problème avec le format de l'image");
						}
					}	
					else {
						echo "Vous n'avez pas ajouté d'images <br />
						<a href='inscription.php'>Retour</a>";
					}
				}
				else { echo "Ce mail est déjà utilisé<br/>";
					echo "<a href='inscription.php'>Retour</a>";}
			}
			else { echo "Veuillez remplir tous les champs.<br/>";
				echo "<a href='inscription.php'>Retour</a>";}	
		?>
	</body>
</html>