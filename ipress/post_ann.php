<?php
	session_start();
	
	//Connexion à la base de données
	include("../connect_bdd.php");

	mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" lang="fr-FR"><!--<![endif]-->
<head>
	<title>Cocamp</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="styles/icons.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="styles/animate.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="styles/responsive.css" media="screen" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>

	<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">

	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div id="layout" class="boxed">
		
		<?php include("header.php"); ?>

		<div class="page-content">
			<div class="row clearfix">
				<div class="grid_9 alpha">
					<div class="grid_12 alpha posts">

						<div class="single_post mbf clearfix">
							<h3 class="single_title">Déposer une annonce</h3>

							<div id="alert2">
								<button type="button" class="close-alert">x</button>
								<p id="text-alert2"></p>
							</div>

							<form method='post' action='' ENCTYPE='multipart/form-data'>
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
									Image (taille maximum : 1,5 Mo) <!--<input type='hidden' name='MAX_FILE_SIZE' value='8000000 ' />-->
									<input type='file' name='image' /> 
								</p>
								<input class="submitform" type='submit' name="Valider" value='Valider'/>
							</form>


							<?php
								// Si le formulaire a été validé
								if (isset($_POST['Valider'])){
								
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
												echo "<script>window.location.replace('profil.php?id=".$IdMembre[0]."');</script>";

												// On déplace l'image dans le dossier imgAnnonce
												$newname = $idAnnonce;
												$uploads_dir = 'imgAnnonce';
												$tmp_name = $_FILES["image"]["tmp_name"];
												
										        move_uploaded_file($tmp_name, "$uploads_dir/$newname.jpg");

												$requeteimage="INSERT INTO Image (UrlImage, IdAnn) values ('".mysql_real_escape_string($newname)."', '$idAnnonce')";	
												mysql_query($requeteimage) or die("erreur requête".mysql_error());
											}
											else{ ?>
												<script type="text/javascript">
													document.getElementById("alert2").style.display = "block";
													document.getElementById("text-alert2").innerHTML = "Problème avec le format de l'image.";
												</script>
											<?php }
										}	
										else { ?>
											<script type="text/javascript">
												document.getElementById("alert2").style.display = "block";
												document.getElementById("text-alert2").innerHTML = "Vous n'avez pas ajouté d'images.";
											</script>
										<?php }
									}
									else { ?>
										<script type="text/javascript">
											document.getElementById("alert2").style.display = "block";
											document.getElementById("text-alert2").innerHTML = "Veuillez remplir tous les champs.";
										</script>
									<?php }
								}

							?>
												
						</div><!-- /single post -->
					</div><!-- end grid8 -->
				</div><!-- end grid9 -->

				<?php include('barreLaterale.php'); ?>
			</div><!-- /row -->
		</div><!-- /end page content -->

		<footer id="footer">
			<div class="row clearfix">
				<div class="footer_last">
					<span class="copyright">© 2014 Cocamp. Tous droits réservés. Réalisé par Charlotte HABRE et Gabrielle PENNEROUX - Master 1 PSM - UFR STGI.</span>

					<div id="toTop" class="toptip" title="Back to Top"><i class="icon-arrow-thin-up"></i></div>
				</div>
			</div>
		</footer><!-- /footer -->

	</div><!-- /layout -->

	<!-- Scripts -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/ipress.js"></script>
		<script type="text/javascript" src="js/owl.carousel.min.js"></script>
		<script type="text/javascript" src="js/jquery.ticker.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
		<script type="text/javascript">
		/* <![CDATA[ */
			function date_time(id){
				date = new Date;
				year = date.getFullYear();
				month = date.getMonth();
				months = new Array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
				d = date.getDate();
				day = date.getDay();
				days = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
				h = date.getHours();
				if(h<10){
					h = "0"+h;}
					m = date.getMinutes();
					if(m<10){
						m = "0"+m;
					}
					s = date.getSeconds();
					if(s<10){
						s = "0"+s;
					}
				// result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
				result = ''+days[day]+' '+d+' '+months[month]+' '+year;
				document.getElementById(id).innerHTML = result;
				setTimeout('date_time("'+id+'");','1000');
				return true;
			}
			window.onload = date_time('date_time');
		/* ]]> */
		</script>
</body>
</html>