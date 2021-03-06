<?php
	session_start();

	//Connexion à la base de données
	include("../connect_bdd.php");

	mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
	
	// On effectue la requête afin d'afficher la dernière annonce de la catégorie événement			
	$requeteEvenement = "SELECT Annonce.IdAnn, Annonce.TitreAnn, Annonce.PrixAnn, Annonce.CatAnn, Annonce.DescrAnn, Localisation.VilleLocal, Annonce.DateAnn, Image.UrlImage FROM Annonce, Localisation, Image WHERE Localisation.IdLocal=Annonce.IdLocal AND Image.IdAnn=Annonce.IdAnn AND CatAnn='Evenement' ORDER BY Annonce.IdAnn DESC";
	$resultEvenement = mysql_query($requeteEvenement) or die ("Erreur de la base de données.");
	$evenement = mysql_fetch_row($resultEvenement);

	// On compte le nombre de commentaires de la dernière annonce affichée sur la page d'accueil pour la catégorie Evenement 
	$requeteEvenementCom = "SELECT COUNT(IdCom) FROM Commentaire WHERE IdAnn='$evenement[0]'";
	$resultEvenementCom = mysql_query($requeteEvenementCom) or die ("Erreur de la base de données.");
	$evenementCom = mysql_fetch_row($resultEvenementCom);
	
	// On effectue la requête afin d'afficher la dernière annonce de la catégorie petite annonce			
	$requetPetiteannonce = "SELECT Annonce.IdAnn, Annonce.TitreAnn, Annonce.PrixAnn, Annonce.CatAnn, Annonce.DescrAnn, Localisation.VilleLocal, Annonce.DateAnn, Image.UrlImage FROM Annonce, Localisation, Image WHERE Localisation.IdLocal=Annonce.IdLocal AND Image.IdAnn=Annonce.IdAnn AND CatAnn='PetiteAnnonce' ORDER BY Annonce.IdAnn DESC";
	$resultPetiteannonce = mysql_query($requetPetiteannonce) or die ("Erreur de la base de données.");
	$petiteannonce = mysql_fetch_row($resultPetiteannonce);

	// On compte le nombre de commentaires de la dernière annonce affichée sur la page d'accueil pour la catégorie Petites annonces
	$requetePetiteannonceCom = "SELECT COUNT(IdCom) FROM Commentaire WHERE IdAnn='$petiteannonce[0]'";
	$resultPetiteannonceCom = mysql_query($requetePetiteannonceCom) or die ("Erreur de la base de données.");
	$petiteannonceCom = mysql_fetch_row($resultPetiteannonceCom);

	// On effectue la requête afin d'afficher la dernière annonce de la catégorie logement			
	$requetLogement = "SELECT Annonce.IdAnn, Annonce.TitreAnn, Annonce.PrixAnn, Annonce.CatAnn, Annonce.DescrAnn, Localisation.VilleLocal, Annonce.DateAnn, Image.UrlImage FROM Annonce, Localisation, Image WHERE Localisation.IdLocal=Annonce.IdLocal AND Image.IdAnn=Annonce.IdAnn AND CatAnn='Logement' ORDER BY Annonce.IdAnn DESC";
	$resultLogement = mysql_query($requetLogement) or die ("Erreur de la base de données.");
	$logement = mysql_fetch_row($resultLogement);

	// On compte le nombre de commentaires de la dernière annonce affichée sur la page d'accueil pour la catégorie Logement 
	$requeteLogementCom = "SELECT COUNT(IdCom) FROM Commentaire WHERE IdAnn='$logement[0]'";
	$resultLogementCom = mysql_query($requeteLogementCom) or die ("Erreur de la base de données.");
	$logementCom = mysql_fetch_row($resultLogementCom);

	// On effectue la requête afin d'afficher la dernière annonce de la catégorie stage/emploi			
	$requetStageEmploi = "SELECT Annonce.IdAnn, Annonce.TitreAnn, Annonce.PrixAnn, Annonce.CatAnn, Annonce.DescrAnn, Localisation.VilleLocal, Annonce.DateAnn, Image.UrlImage FROM Annonce, Localisation, Image WHERE Localisation.IdLocal=Annonce.IdLocal AND Image.IdAnn=Annonce.IdAnn AND CatAnn='StageEmploi' ORDER BY Annonce.IdAnn DESC";
	$resultStageEmploi = mysql_query($requetStageEmploi) or die ("Erreur de la base de données.");
	$stageEmploi = mysql_fetch_row($resultStageEmploi);

	// On compte le nombre de commentaires de la dernière annonce affichée sur la page d'accueil pour la catégorie Stage Emploi 
	$requeteStageEmploiCom = "SELECT COUNT(IdCom) FROM Commentaire WHERE IdAnn='$stageEmploi[0]'";
	$resultStageEmploiCom = mysql_query($requeteStageEmploiCom) or die ("Erreur de la base de données.");
	$stageEmploiCom = mysql_fetch_row($resultStageEmploiCom);

	// On effectue la requête afin d'afficher la dernière annonce de la catégorie covoiturage			
	$requetCovoiturage = "SELECT Annonce.IdAnn, Annonce.TitreAnn, Annonce.PrixAnn, Annonce.CatAnn, Annonce.DescrAnn, Localisation.VilleLocal, Annonce.DateAnn, Image.UrlImage FROM Annonce, Localisation, Image WHERE Localisation.IdLocal=Annonce.IdLocal AND Image.IdAnn=Annonce.IdAnn AND CatAnn='Covoiturage' ORDER BY Annonce.IdAnn DESC";
	$resultCovoiturage = mysql_query($requetCovoiturage) or die ("Erreur de la base de données.");
	$covoiturage = mysql_fetch_row($resultCovoiturage);

	// On compte le nombre de commentaires de la dernière annonce affichée sur la page d'accueil pour la catégorie Covoiturage 
	$requeteCovoiturageCom = "SELECT COUNT(IdCom) FROM Commentaire WHERE IdAnn='$covoiturage[0]'";
	$resultCovoiturageCom = mysql_query($requeteCovoiturageCom) or die ("Erreur de la base de données.");
	$covoiturageCom = mysql_fetch_row($resultCovoiturageCom);

	// On effectue la requête afin d'afficher la dernière annonce de la catégorie orientation			
	$requetOrientation = "SELECT Annonce.IdAnn, Annonce.TitreAnn, Annonce.PrixAnn, Annonce.CatAnn, Annonce.DescrAnn, Localisation.VilleLocal, Annonce.DateAnn, Image.UrlImage FROM Annonce, Localisation, Image WHERE Localisation.IdLocal=Annonce.IdLocal AND Image.IdAnn=Annonce.IdAnn AND CatAnn='Orientation' ORDER BY Annonce.IdAnn DESC";
	$resultOrientation = mysql_query($requetOrientation) or die ("Erreur de la base de données.");
	$orientation = mysql_fetch_row($resultOrientation);

	// On compte le nombre de commentaires de la dernière annonce affichée sur la page d'accueil pour la catégorie Orientation 
	$requeteOrientationCom = "SELECT COUNT(IdCom) FROM Commentaire WHERE IdAnn='$orientation[0]'";
	$resultOrientationCom = mysql_query($requeteOrientationCom) or die ("Erreur de la base de données.");
	$orientationCom = mysql_fetch_row($resultOrientationCom);

	// On effectue la requête afin d'afficher la dernière annonce de la catégorie loisirs			
	$requetLoisir = "SELECT Annonce.IdAnn, Annonce.TitreAnn, Annonce.PrixAnn, Annonce.CatAnn, Annonce.DescrAnn, Localisation.VilleLocal, Annonce.DateAnn, Image.UrlImage FROM Annonce, Localisation, Image WHERE Localisation.IdLocal=Annonce.IdLocal AND Image.IdAnn=Annonce.IdAnn AND CatAnn='Loisir' ORDER BY Annonce.IdAnn DESC";
	$resultLoisir = mysql_query($requetLoisir) or die ("Erreur de la base de données.");
	$loisir = mysql_fetch_row($resultLoisir);

	// On compte le nombre de commentaires de la dernière annonce affichée sur la page d'accueil pour la catégorie Loisirs
	$requeteLoisirsCom = "SELECT COUNT(IdCom) FROM Commentaire WHERE IdAnn='$loisir[0]'";
	$resultLoisirsCom = mysql_query($requeteLoisirsCom) or die ("Erreur de la base de données.");
	$loisirCom = mysql_fetch_row($resultLoisirsCom);

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
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie8" lang="fr"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="fr"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" lang="fr_FR"><!--<![endif]-->
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
	<div class="boxed">
		
		<?php include("header.php"); ?>

		<div class="page-content">
			<div class="row clearfix">
				<div class="grid_9 alpha">

					<div class="grid_12 omega posts righter">
						<div class="mbf clearfix">
							<div class="title color1">
								<h4>Événements</h4>
							</div><!-- /title bar -->
							
							<div class="grid_4 alpha">
								<?php echo "<a href='annonce.php?id=".$evenement[0]."'><img src='../imgAnnonce/".$evenement[7].".jpg'/></a>"; ?>
							</div><!-- /grid4 alpha -->

							<div class="grid_8 omega">
								<div class="post_content">
									<h3><?php echo "<a href='annonce.php?id=".$evenement[0]."'>".$evenement[1]."</a>"; ?></h3><p class="com_post"> - <?php echo "<a href='annonce.php?id=".$evenement[0]."#commentaires'>".$evenementCom[0] ?> commentaires</a></p>
									<p class="date_content"> <?php echo datefr($evenement[6])." - ".$evenement[5];?>
									<br /><?php echo $evenement[2]; ?> €</p>
									<p class="description_content"><?php echo $evenement[4]; ?></p>
								</div><!-- /post content -->
							</div><!-- /grid8 omega -->
						</div><!-- /post-->

						<div class="mbf clearfix">
							<div class="title color2">
								<h4>Petites annonces</h4>
							</div><!-- /title bar -->

							<div class="grid_4 alpha">
								<?php echo "<a href='annonce.php?id=".$petiteannonce[0]."'><img src='../imgAnnonce/".$petiteannonce[7].".jpg'/></a>"; ?>
							</div><!-- /grid4 alpha -->

							<div class="grid_8 omega">
								<div class="post_content">
									<h3><?php echo "<a href='annonce.php?id=".$petiteannonce[0]."'>".$petiteannonce[1]."</a>"; ?></h3><p class="com_post"> - <?php echo "<a href='annonce.php?id=".$petiteannonce[0]."#commentaires'>".$petiteannonceCom[0] ?> commentaires</p>
									<p class="date_content"> <?php echo datefr($petiteannonce[6])." - ".$petiteannonce[5];?>
									<br /><?php echo $petiteannonce[2]; ?> €</p>
									<p class="description_content"><?php echo $petiteannonce[4]; ?></p>
								</div><!-- /post content -->
							</div><!-- /grid8 omega -->
						</div>

						<div class="mbf clearfix">
							<div class="title color3">
								<h4>Logements</h4>
							</div><!-- /title bar -->

							<div class="grid_4 alpha">
								<?php echo "<a href='annonce.php?id=".$logement[0]."'><img src='../imgAnnonce/".$logement[7].".jpg'/></a>"; ?>
							</div><!-- /grid4 alpha -->

							<div class="grid_8 omega">
								<div class="post_content">
									<h3><?php echo "<a href='annonce.php?id=".$logement[0]."'>".$logement[1]."</a>"; ?></h3><p class="com_post"> - <?php echo "<a href='annonce.php?id=".$logement[0]."#commentaires'>".$logementCom[0] ?> commentaires</p>
									<p class="date_content"> <?php echo datefr($logement[6])." - ".$logement[5];?>
									<br /><?php echo $logement[2]; ?> €</p>
									<p class="description_content"><?php echo $logement[4]; ?></p>
								</div><!-- /post content -->
							</div><!-- /grid8 omega -->
						</div>

						<div class="mbf clearfix">
							<div class="title color4">
								<h4>Stage / Emploi</h4>
							</div><!-- /title bar -->

							<div class="grid_4 alpha">
								<?php echo "<a href='annonce.php?id=".$stageEmploi[0]."'><img src='../imgAnnonce/".$stageEmploi[7].".jpg'/></a>"; ?>
							</div><!-- /grid4 alpha -->

							<div class="grid_8 omega">
								<div class="post_content">
									<h3><?php echo "<a href='annonce.php?id=".$stageEmploi[0]."'>".$stageEmploi[1]."</a>"; ?></h3><p class="com_post"> - <?php echo "<a href='annonce.php?id=".$stageEmploi[0]."#commentaires'>".$stageEmploiCom[0] ?> commentaires</p>
									<p class="date_content"> <?php echo datefr($stageEmploi[6])." - ".$stageEmploi[5];?>
									<br /><?php echo $stageEmploi[2]; ?> €</p>
									<p class="description_content"><?php echo $stageEmploi[4]; ?></p>
								</div><!-- /post content -->
							</div><!-- /grid8 omega -->
						</div>

						<div class="mbf clearfix">
							<div class="title color5">
								<h4>Covoiturage</h4>
							</div><!-- /title bar -->

							<div class="grid_4 alpha">
								<?php echo "<a href='annonce.php?id=".$covoiturage[0]."'><img src='../imgAnnonce/".$covoiturage[7].".jpg'/></a>"; ?>
							</div><!-- /grid4 alpha -->

							<div class="grid_8 omega">
								<div class="post_content">
									<h3><?php echo "<a href='annonce.php?id=".$covoiturage[0]."'>".$covoiturage[1]."</a>"; ?></h3><p class="com_post"> - <?php echo "<a href='annonce.php?id=".$covoiturage[0]."#commentaires'>".$covoiturageCom[0] ?> commentaires</p>
									<p class="date_content"> <?php echo datefr($covoiturage[6])." - ".$covoiturage[5];?>
									<br /><?php echo $covoiturage[2]; ?> €</p>
									<p class="description_content"><?php echo $covoiturage[4]; ?></p>
								</div><!-- /post content -->
							</div><!-- /grid8 omega -->
						</div>

						<div class="mbf clearfix">
							<div class="title color6">
								<h4>Orientation</h4>
							</div><!-- /title bar -->

							<div class="grid_4 alpha">
								<?php echo "<a href='annonce.php?id=".$orientation[0]."'><img src='../imgAnnonce/".$orientation[7].".jpg'/></a>"; ?>
							</div><!-- /grid4 alpha -->

							<div class="grid_8 omega">
								<div class="post_content">
									<h3><?php echo "<a href='annonce.php?id=".$orientation[0]."'>".$orientation[1]."</a>"; ?></h3><p class="com_post"> - <?php echo "<a href='annonce.php?id=".$orientation[0]."#commentaires'>".$orientationCom[0] ?> commentaires</p>
									<p class="date_content"> <?php echo datefr($orientation[6])." - ".$orientation[5];?>
									<br /><?php echo $orientation[2]; ?> €</p>
									<p class="description_content"><?php echo $orientation[4]; ?></p>
								</div><!-- /post content -->
							</div><!-- /grid8 omega -->
						</div>

						<div class="mbf clearfix">
							<div class="title color7">
								<h4>Loisirs</h4>
							</div><!-- /title bar -->

							<div class="grid_4 alpha">
								<?php echo "<a href='annonce.php?id=".$loisir[0]."'><img src='../imgAnnonce/".$loisir[7].".jpg'/></a>"; ?>
							</div><!-- /grid4 alpha -->

							<div class="grid_8 omega">
								<div class="post_content">
									<h3><?php echo "<a href='annonce.php?id=".$loisir[0]."'>".$loisir[1]."</a>"; ?></h3><p class="com_post"> - <?php echo "<a href='annonce.php?id=".$loisir[0]."#commentaires'>".$loisirCom[0] ?> commentaires</p>
									<p class="date_content"> <?php echo datefr($loisir[6])." - ".$loisir[5];?>
									<br /><?php echo $loisir[2]; ?> €</p>
									<p class="description_content"><?php echo $loisir[4]; ?></p>
								</div><!-- /post content -->
							</div><!-- /grid8 omega -->
						</div>


					</div><!-- end grid12 -->
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