<?php session_start (); 
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
				include("connect_bdd.php");
				
				mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
				
				if(!empty($_POST['PrixAnn']) && !empty($_POST['Categorie']) && !empty($_POST['TitreAnn']) && !empty($_POST['DescrAnn']) && !empty($_FILES['image']) && !empty($_POST['ville'])){

						/*echo ($_FILES['image']['size']);
						echo "<br />";
						echo ($_FILES['image']['error']);*/
					// si le fichier a bien été envoyé
					if (isset($_FILES['image'])){

						// vérification de la taille
        				if ($_FILES['image']['size'] <= 1500000){
							//ajout de l'annonce dans la BDD
							$TitreAnn=$_POST['TitreAnn'];
							$PrixAnn=$_POST['PrixAnn'];
							$DescrAnn=$_POST['DescrAnn'];
							$DateAnn=date("Y-m-d");
							$Mail=$_SESSION['mail'];
							$Ville=$_POST['ville'];
							$Categorie=$_POST['Categorie'];
				
							$RequeteIdMembre="SELECT IdMembre FROM Membre WHERE MailMembre='".$Mail."'";
							$ResultIdMembre=mysql_query($RequeteIdMembre) or die("erreur requête".mysql_error());
							$IdMembre=mysql_fetch_row($ResultIdMembre);
						
							$RequeteIdLocal="SELECT IdLocal FROM Localisation WHERE VilleLocal='".$Ville."'";
							$ResultIdLocal=mysql_query($RequeteIdLocal) or die("erreur requête".mysql_error());
							$IdLocal=mysql_fetch_row($ResultIdLocal);
						
							$requetannonce="INSERT INTO Annonce (TitreAnn, PrixAnn, DateAnn, DescrAnn, CatAnn, IdMembre, IdLocal) values ('".mysql_real_escape_string($TitreAnn)."', '$PrixAnn', '$DateAnn', '".mysql_real_escape_string($DescrAnn)."', '$Categorie', '$IdMembre[0]', '$IdLocal[0]')";	
							mysql_query($requetannonce) or die("erreur requête".mysql_error());

							//On récupère l'id de la dernière annonce ajoutée pour pouvoir ajouter l'image correspondante à cet id et pour la renommer
							$idAnnonce=mysql_insert_id();
						
							echo "Votre annonce a été ajoutée avec succès <br />";
							// on redirige notre visiteur vers la page de l'annonce
							echo "<script>window.location.replace('ipress/profil.php?id=".$IdMembre[0]."');</script>";

							// On déplace l'image dans le dossier imgAnnonce
							$newname = $idAnnonce;
							$uploads_dir = 'imgAnnonce';
							$tmp_name = $_FILES["image"]["tmp_name"];
							
					        move_uploaded_file($tmp_name, "$uploads_dir/$newname.jpg");

							$requeteimage="INSERT INTO Image (UrlImage, IdAnn) values ('".mysql_real_escape_string($newname)."', '$idAnnonce')";	
							mysql_query($requeteimage) or die("erreur requête".mysql_error());
						}
						else{
							echo "<script>alert('Problème avec le format de l'image.');</script>";
							// on redirige notre visiteur vers la page pour poster l'annonce
							echo "<script>window.location.replace('ipress/post_ann.php');</script>";
						}
					}	
					else {
						echo "<script>alert('Vous n'avez pas ajouté d'images.');</script>";
						// on redirige notre visiteur vers la page de l'annonce
						echo "<script>window.location.replace('ipress/post_ann.php')</script>";
					}
				}
				else {
					echo "<script>alert('Veuillez remplir tous les champs.');</script>";
					// on redirige notre visiteur vers la page de l'annonce
					echo "<script>window.location.replace('ipress/post_ann.php')</script>";
				}
			?>
		</div>	
		<div id="footer">
		</div>	
	</body>
</html>