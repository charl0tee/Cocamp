<?php
	session_start();
	//Connexion à la base de données
	include("../connect_bdd.php");

	mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD


	
	if (isset($_SESSION['mail'])) {
		// On récupère l'ID du membre qui est connecté pour que l'utilisateur puisse accéder à son profil
		$requetProfil="SELECT IdMembre FROM Membre WHERE MailMembre='".$_SESSION['mail']."'";
		$resultProfil=mysql_query($requetProfil) or die("Erreur de base de données.");
		$profil=mysql_fetch_row($resultProfil);
	}	

	// On récupère l'ID de l'annonce sur laquelle l'utilisateur a cliqué
	$idSelect = $_GET['id'];
	
	// On récupère le titre de l'annonce sélectionnée
	$requetTitre = "SELECT TitreAnn FROM Annonce WHERE IdAnn='".$idSelect."'";
	$resultTitre = mysql_query($requetTitre) or die ("Erreur de la base de données.");
	$titre=mysql_fetch_row($resultTitre);
	// fonction pour convertir la date en format français et en format texte //DATE
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

		// fonction pour convertir la date en format français et en format texte //DATETIME
		function datefrCOM($date) { 
			$splitTime = explode(" ",$date); 

			$split = explode("-", $splitTime[0]);
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
			return "$jour"." "."$moistxt"." "."$annee"." à "."$splitTime[1]";
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
	
	//afficher l'image de l'annonce sélectionnée 
	
	$requetImage = "SELECT UrlImage FROM Image WHERE IdAnn='".$idSelect."'";
	$resultImage = mysql_query($requetImage) or die ("Erreur de la base de données.");
	$Image = mysql_fetch_row($resultImage);
	// On récupère le prix de l'annonce sélectionnée
	$requetPrix = "SELECT PrixAnn FROM Annonce WHERE IdAnn='".$idSelect."'";
	$resultPrix = mysql_query($requetPrix) or die ("Erreur de la base de données.");
	$prix=mysql_fetch_row($resultPrix);
	// On récupère la ville et le code postal de l'annonce sélectionnée
	$requetVille = "SELECT Localisation.VilleLocal, Localisation.CodePostLocal FROM Localisation, Annonce WHERE Localisation.IdLocal=Annonce.IdLocal AND Annonce.IdAnn='".$idSelect."'";
	$resultVille = mysql_query($requetVille) or die ("Erreur de la base de données.");
	$ville=mysql_fetch_row($resultVille);
	
	// On récupère la description de l'annonce sélectionnée
	$requetDescr = "SELECT DescrAnn FROM Annonce WHERE IdAnn='".$idSelect."'";
	$resultDescr = mysql_query($requetDescr) or die ("Erreur de la base de données.");
	$descr=mysql_fetch_row($resultDescr);

	// On récupère les commentaires
	$requetCom = "SELECT * FROM commentaire WHERE IdAnn='".$idSelect."' ORDER BY DateCom Desc ";
	$resultCom = mysql_query($requetCom) or die ("Erreur de la base de données.");
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" lang="fr-FR"><!--<![endif]-->
<head>
	<title>Cocamp</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Seo Meta -->
		<meta name="description" content="">
		<meta name="keywords" content="">

	<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="styles/icons.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="styles/animate.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="styles/responsive.css" media="screen" />
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>

	<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div id="layout" class="boxed">
		<header id="header">
			<div class="a_head">
				<div class="row clearfix">
					<div class="right_bar">
					
							<?php 
								
								if (!isset($_SESSION['mail'])) {
									?><div id="connexion">
										<div class="connect">
											<a>Se connecter</a>	
										</div>
										<div class="c_form">
											<form action="../login_connect.php" id="connexionform" method="post">
												<input id="inputmail" name="mail_connect" type="text" onfocus="if (this.value=='Email') this.value = '';" onblur="if (this.value=='') this.value = 'Email';" value="Email" placeholder="Email">
												<input id="inputmdp" name="mdp_connect" type="password" onfocus="if (this.value=='Mot de passe') this.value = '';" onblur="if (this.value=='') this.value = 'Mot de passe';" value="Mot de passe" placeholder="Mot de passe">
												<button type="submit">Valider</button>
											</form><!-- /form -->
										</div><!-- /s form -->
									</div> <!-- /connexion --> 
							<?php
									echo "<div id='inscription'>
													<a href='inscription.php' class='' title=''>S'inscrire</a>
												</div><!-- /inscription -->";
								}
								else{
									echo "<div id='deconnexion'> <a href='profil.php?id=".$profil[0]."'>Bonjour ".$_SESSION['prenom']."</a><a href='../logout.php'>Se déconnecter</a></div>";
								}	
							?>
						
						<span id="date_time"></span><!-- /date -->
					</div><!-- /right bar -->
				</div><!-- /row -->
			</div><!-- /a head -->

			<div class="b_head">
				<div class="row clearfix">
					<div class="logo">
						<a href="index.php" title="iPress - Responsive News/Blog/Magazine HTML5"><img src="images/logo.png" alt="iPress - Responsive News/Blog/Magazine HTML5"></a>
					</div><!-- /logo -->
					<div id="poster_ann">
						<?php
							if (isset($_SESSION['mail'])) {
								echo "<a href='post_ann.php'><p>Déposer une annonce</p></a>";
							}
						?>
					</div>
				</div><!-- /row -->
			</div><!-- /b head -->

			<div class="row clearfix">
				<div class="c_head clearfix">
					<nav>
						<ul class="sf-menu">
							<li class="current colordefault home_class"><a href="index.php"><i class="icon-home"></i></a>
							</li>
							<li class="color1"><a href="evenement.php">Événements</a>
							</li>
							<li class="color2"><a href="petitesannonces.php">Petites annonces</a>
							</li>
							<li class="color3"><a href="logement.php">Logements</a>
							</li>
							<li class="color4"><a href="stageemploi.php">Stages / Emplois</a></li>
							<li class="color5"><a href="covoiturage.php">Covoiturage</a></li>
							<li class="color6"><a href="orientation.php">Orientation</a></li>
							<li class="color7"><a href="loisirs.php">Loisirs</a></li>
						</ul><!-- /menu -->
					</nav><!-- /nav -->

					<div class="right_icons">
						<div class="search">
							<div class="search_icon"><a href="messagerie.php"><i class="icon-message"></i></a></i></div>
							<div class="s_form">
								<form action="search_result.html" id="search" method="get">
									<input id="inputhead" name="search" type="text" onfocus="if (this.value=='Recherche') this.value = '';" onblur="if (this.value=='') this.value = 'Recherche';" value="Recherche" placeholder="Recherche">
									<button type="submit"><i class="fa-search"></i></button>
								</form><!-- /form -->
							</div><!-- /s form -->
						</div><!-- /search -->
					</div><!-- /right icons -->
				</div><!-- /c head -->
			</div><!-- /row -->
		</header><!-- /header -->

		<div class="page-content">
			<div class="row clearfix">
				<div class="grid_9 alpha">
					<div class="grid_12 alpha posts">

						<div class="single_post mbf clearfix">
							<h3 class="single_title">
								<?php if ($_SESSION['mail'] == $membre[3]) { ?>
									<a href="modif_ann.php?id=<?php echo $idSelect; ?>"><i class="icon-document-edit mi"></i></a>
									<a href="../supprim_ann.php?id=<?php echo $idSelect; ?>"><i class="icon-trash mi"></i></a>
								<?php }
									// On affiche le titre de l'annonce sélectionnée
									echo $titre[0]."<br />";
								?>
							</h3>
							<div class="meta mb"> postée par <a href="profil.php?id=<?php echo $idMembre; ?>">
								<?php // On affiche le nom et prénom du membre et la date de l'annonce sélectionnée
									echo $membre[2]." ".$membre[1];
								?></a> le <?php echo datefr($dateAnn[0]) ?>
								<br />
								<?php echo "<a href='envoi_message.php?id=".$idMembre."'>Contacter l'annonceur</a>"; ?>
							</div>

							<?php //On affiche l'image de l'annonce
								if(!empty($Image)) {
									echo "<img class='mbt' src='../imgAnnonce/".$Image[0].".jpg'/><br/>";
								}
								else { 
									echo "";
								}
							?>	
							<h4 class="h4float">Prix : </h4><p class="pfloat">
							<?php  
								if(!empty($prix)) {
									// On affiche le prix de l'annonce sélectionnée
									echo $prix[0]." €<br />";
								}
								else{
									echo "";
								} 
							?></p>	
							<h4 class="h4float">Ville : </h4><p class="pfloat"><?php  
								// On affiche le code postal de l'annonce sélectionnée
								echo $ville[1]." ";
								// On affiche la ville de l'annonce sélectionnée
								echo $ville[0];
								 ?></p>
							<h4>Description :</h4> 
							<p> <?php // On affiche la description de l'annonce sélectionnée
									echo $descr[0];  
								?>
							</p>
						</div><!-- /single post -->
							<div id="commentaires">
								<?php if (isset($_SESSION['mail'])) { ?>
									<div class="com_form">
										<form action="../post_commentaire.php" id="comform" method="post">
											<input type="hidden" name="idProfil" value="<?php echo $profil[0] ?>">
											<input type="hidden" name="idAnnonce" value="<?php echo $idSelect ?>">
											<textarea id="inputcom" name="post_com" cols="100" rows="3" placeholder="Votre commentaire"></textarea>
											<button type="submit">Envoyer</button>
										</form><!-- /form -->
									</div><!-- /s form -->
								<?php } ?>	
								<div id="liste_commentaires">
								<h4>Commentaires :</h4>
								<?php 
									while ($commentaire=mysql_fetch_row($resultCom)){
										// On récupère les commentaires$
										$requetPhotoProfil = "SELECT NomMembre, PrenomMembre, PhotoMembre FROM membre WHERE IdMembre='".$commentaire[1]."'";
										$resultPhotoProfil = mysql_query($requetPhotoProfil) or die ("Erreur de la base de données.");
										$photoProfil=mysql_fetch_row($resultPhotoProfil);
										
										?><div class="commentaire">
											<div class="photoProfil"><?php
											echo "<img width='60' height'60' src='../imgProfil/".$photoProfil[2].".jpg'>";
										?></div> <?php	
											echo "<p><strong>".$photoProfil[1]." ".$photoProfil[0]."</strong> - ".datefrCOM($commentaire[4])."</p>";
											echo "<p>".$commentaire[3]."</p>";
										?></div><?php	
									} 
								?>
								</div>
							</div>			
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

			// Disqus
			var disqus_shortname = 'officialtemplate'; 
			(function () {
				var s = document.createElement('script'); s.async = true;
				s.type = 'text/javascript';
				s.src = '//' + disqus_shortname + '.disqus.com/count.js';
				(document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
			}());
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