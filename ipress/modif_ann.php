<?php
	session_start();
	//Connexion à la base de données
	include("../connect_bdd.php");

	mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
	
	// On récupère l'id de l'annonce à modifier (depuis l'url)
	$idSelect = $_GET['id'];

	// On effectue les requêtes afin d'afficher l'annonce que le membre veut modifier dans un formulaire			
	$requet = "SELECT Localisation.VilleLocal, Annonce.TitreAnn, Annonce.DescrAnn, Annonce.PrixAnn, Annonce.CatAnn, Membre.MailMembre FROM Annonce, Localisation, Membre WHERE Localisation.IdLocal=Annonce.IdLocal AND Annonce.IdMembre=Membre.IdMembre AND Annonce.IdAnn='".$idSelect."'";
	$result = mysql_query($requet) or die ("Erreur de la base de données.");

	// On récupère le titre de l'annonce sélectionnée
	$requetTitre = "SELECT TitreAnn FROM Annonce WHERE IdAnn='".$idSelect."'";
	$resultTitre = mysql_query($requetTitre) or die ("Erreur de la base de données.");
	$titre=mysql_fetch_row($resultTitre);

	// fonction pour convertir la date en format français et en format texte
	function datefr($date) { 
		$split = explode("-",$date); 
		$annee = $split[0]; 
		$mois = $split[1]; 
		$jour = $split[2];
		switch ($mois){
	        case 01:
                $moistxt = ' janvier ';
                break;
			case 02:
                $moistxt = ' février ';
                break;
	        case 03:
                $moistxt = ' mars ';
                break;
	        case 04:
                $moistxt = ' avril ';
                break;
	        case 05:
                $moistxt = ' mai ';
                break;
	        case 06:
                $moistxt = ' juin ';
                break;
	        case 07:
                $moistxt = ' juillet ';
                break;
	        case 08:
                $moistxt = ' août ';
                break;
	        case 09:
                $moistxt = ' septembre ';
                break;
	        case 10:
                $moistxt = ' octobre ';
                break;
			case 11:
                $moistxt = ' novembre ';
                break;
			case 12:
                $moistxt = ' décembre ';
		}
		return "$jour"." "."$moistxt"." "."$annee";
	}
	
	// On récupère la date de l'annonce sélectionnée
	$requetDateAnn = "SELECT DateAnn FROM Annonce WHERE IdAnn='".$idSelect."'";
	$resultDateAnn = mysql_query($requetDateAnn) or die ("Erreur de la base de données.");
	$dateAnn=mysql_fetch_row($resultDateAnn);


	// On récupère le prénom et le nom du membre qui a posté l'annonce sélectionnée
	$requetMembre = "SELECT Membre.IdMembre, Membre.NomMembre, Membre.PrenomMembre, Membre.MailMembre FROM Membre, Annonce WHERE Annonce.IdMembre=Membre.IdMembre AND Annonce.IdAnn='".$idSelect."'";
	$resultMembre = mysql_query($requetMembre) or die ("Erreur de la base de données.");
	$membre=mysql_fetch_row($resultMembre);
	// On stocke l'id du membre qui a posté l'annonce
	$idMembre = $membre[0];
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
							<h3 class="single_title">
							<?php // On affiche le titre de l'annonce sélectionnée
								echo $titre[0]."<br />";
							?></h3>
							<div class="meta mb"> postée par 
								<?php // On affiche le nom et prénom du membre et la date de l'annonce sélectionnée
									echo $membre[2]." ".$membre[1];
								?> le <?php echo datefr($dateAnn[0]) ?>
							</div>

							<?php while($affiche = mysql_fetch_row($result)) {
			
									// On vérifie que l'annonce à modifier est bien celle du membre connecté
									if($affiche[5]==$_SESSION['mail']){

										// On affiche un formulaire pré-rempli avec les données déjà rentrées dans la bdd
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
										<p>Prix : <input type='number' name='PrixAnn' value='".$affiche[3]."'/>€</p>
									
										<input type='submit' name='Valider' value='Valider'/>";
										
										// Si le formulaire a été validé, alors on modifie l'annonce sélectionnée et on affiche un message au membre
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

												$requetannonce="UPDATE Annonce SET TitreAnn='".mysql_real_escape_string($TitreAnn)."', PrixAnn='".$PrixAnn."', DescrAnn='".mysql_real_escape_string($DescrAnn)."', CatAnn='".$Categorie."', IdLocal='".$idLocal[0]."' WHERE IdAnn='".$idSelect."'";	
												mysql_query($requetannonce) or die("erreur requête".mysql_error());
												
												echo "<script>alert('Votre annonce a été modifiée avec succès.');</script>";
												// on redirige notre visiteur vers la page de l'annonce
												echo "<script>window.location.replace('annonce.php?id=".$idSelect."');</script>";
											}
											else {
												echo "<script>alert('Veuillez remplir tous les champs.');</script>";
												// on redirige notre visiteur vers la page de l'annonce
												echo "<script>window.location.replace('annonce.php?id=".$idSelect."')</script>";
											}
										}
									}
									else{
										echo "<script>alert('Vous n'êtes pas propriétaire de cette annonce.');</script>";
										// on redirige notre visiteur vers la page de l'annonce
										echo "<script>window.location.replace('index.php')</script>";
									}
								}
							?>	
												
						</div><!-- /single post -->
					</div><!-- end grid8 -->
				</div><!-- end grid9 -->

				<?php include('../barreLaterale.php'); ?>
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