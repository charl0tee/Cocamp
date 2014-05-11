<?php
	session_start();
	//Connexion à la base de données
	include("../connect_bdd.php");

	mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
	
	// On récupère l'ID du membre sur lequel l'utilisateur a cliqué
	$idSelect = $_GET['id'];

	//Requête pour afficher les données du membre
	$requet_membre="SELECT NomMembre, PrenomMembre, MailMembre, ScolMembre, AgeMembre, PhotoMembre FROM Membre WHERE IdMembre='".$idSelect."'";
	$result_membre=mysql_query($requet_membre) or die("Erreur de base de données.");
	$membre=mysql_fetch_row($result_membre);	
	// On effectue les requêtes afin d'afficher les annonces postées par le membre			
	$requet = "SELECT Annonce.IdAnn, Annonce.TitreAnn, Annonce.PrixAnn, Annonce.CatAnn, Annonce.DescrAnn, Localisation.VilleLocal, Annonce.DateAnn, Image.UrlImage FROM Annonce, Localisation, Image, Membre WHERE Localisation.IdLocal=Annonce.IdLocal AND Image.IdAnn=Annonce.IdAnn AND Membre.IdMembre=Annonce.IdMembre AND Membre.IdMembre='".$idSelect."'ORDER BY Annonce.IdAnn DESC";
	$result = mysql_query($requet) or die ("Erreur de la base de données.");
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
							<div class="mbf clearfix article_cat">
								<h3 class="single_title">
									<?php if ($_SESSION['mail'] == $membre[2]) { ?>
										<a href="modif_profil.php?id=<?php echo $idSelect; ?>"><i class="icon-document-edit mi"></i></a>
										<a href="../supprim_profil.php?id=<?php echo $idSelect; ?>"><i class="icon-trash mi"></i></a>
									<?php }	?>
								</h3>
								<div class="grid_4 alpha">
									<?php //On affiche l'image du profil
										echo "<img src='../imgProfil/".$membre[5].".jpg'/><br />";
									?>	
								</div>
								<div class="grid_8 omega">
									<h4 class="h4float">Prénom : </h4><p class="pfloat profil">
									<?php // On affiche le prénom
										echo $membre[1];
									?></p>
									<h4 class="h4float">Nom : </h4><p class="pfloat profil">
									<?php // On affiche le nom
										echo $membre[0];
									?></p>
									<h4 class="h4float">Mail :</h4><p class="pfloat profil">
									<?php  //On affiche le mail
										echo $membre[2];
									?></p>	
									<h4 class="h4float">Scolarité : </h4><p class="pfloat profil"><?php  
										// On affiche la scolarité
										echo $membre[3];
									?></p>
									<h4 class="h4float">Age : </h4><p class="pfloat profil"><?php  	
										// On affiche l'age
										echo $membre[4];
									?></p>
								</div>	
							</div>	
							<h4>Mes annonces :</h4> 
							<p class="pfloat annonce"><?php // On affiche la liste des annonces
									while($affiche = mysql_fetch_row($result)) {
										// le lien renvoie vers l'annonce sélectionnée grâce à l'ID récupéré par la méthode GET
										?> 
										<div class="mbf clearfix article_cat"> <!-- article -->
											<div class="grid_4 alpha"><?php	
												echo "<img src='../imgAnnonce/".$affiche[7].".jpg'/><br />";?>
											</div>
											<div class="grid_8 omega"> <?php
												echo "<a href='annonce.php?id=".$affiche[0]."'>".$affiche[1]." - ".$affiche[3]."</a><br />".datefr($affiche[6])." - ".$affiche[5]."<br />".$affiche[2]." €<br />".$affiche[4]."<br />";?>
											</div>
										</div>	
											<?php

									} 
								?>
							</p>
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