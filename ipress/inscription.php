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
							<h3 class="single_title">Inscrivez-vous</h3>
							
							<div id="alert">
								<button type="button" class="close-alert">x</button>
								<p id="text-alert"></p>
							</div>

							<form method='post' action='' ENCTYPE='multipart/form-data'>
								<h2>S'inscrire</h2>
								<p>Nom : <input type='text' name='nom' /></p>
								<p>Prénom : <input type='text' name='prenom' /></p>
								<p>Age : <input type='number' name='age' maxlength="2"/></p>
								<p>Formation : <input type='text' name='formation' /></p>
								<p>Mail : <input type='text' name='mail' /></p>
								<p>Mot de passe : <input type='password' name='mdp_inscript' /></p>
								<p>
									Image (taille maximum : 1,5 Mo) <input type='hidden' name='MAX_FILE_SIZE' value='10000000' />
									<input type='file' name='image' />
								</p>
								<input class="submitform" type='submit' name="Valider" value='Valider' />
							</form>

							<?php
								// Si le formulaire a été validé
								if (isset($_POST['Valider'])){
								
									// On vérifie si tous les champs sont remplis
									if (!empty($_POST['age']) && !empty($_POST['formation']) && !empty($_POST['mdp_inscript']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail'])){

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
													window.location.replace('index.php');
													</script> ";
													
												}
												else{ ?>
				 									<script type="text/javascript">
														document.getElementById("alert").style.display = "block";
														document.getElementById("text-alert").innerHTML = "Problème avec le format de l'image.";
													</script>
												<?php }
											}	
											else { ?>
													<script type="text/javascript">
														document.getElementById("alert").style.display = "block";
														document.getElementById("text-alert").innerHTML = "Vous n'avez pas ajouté d'image.";
													</script>
											<?php }
										}
										else { ?>
												<script type="text/javascript">
													document.getElementById("alert").style.display = "block";
													document.getElementById("text-alert").innerHTML = "Ce mail est déjà utilisé.";
												</script>
										<?php }
									}
									else {
							?>
									
									<script type="text/javascript">
										document.getElementById("alert").style.display = "block";
										document.getElementById("text-alert").innerHTML = "Veuillez remplir tous les champs.";
									</script>

							<?php } }?>										
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