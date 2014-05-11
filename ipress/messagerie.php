<?php 
	session_start ();
	
	include("../connect_bdd.php");

	mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD

	// Requête pour récupérer l'id du membre qui a envoyé et recu les messages
	$requet_membre="SELECT IdMembre FROM Membre WHERE MailMembre='".$_SESSION['mail']."'";
	$result_membre=mysql_query($requet_membre) or die("Erreur de base de données.");
	$membre=mysql_fetch_row($result_membre);

	// On effectue une requête afin d'afficher les messages envoyés par le membre		
	$requet = "SELECT * FROM Message WHERE IdSender='".$membre[0]."' ORDER BY IdMessage DESC";
	$result = mysql_query($requet) or die ("Erreur de la base de données.");

	// On effectue une requête afin d'afficher les messages recus par le membre		
	$requet2 = "SELECT * FROM Message WHERE IdReceiver='".$membre[0]."' ORDER BY IdMessage DESC";
	$result2 = mysql_query($requet2) or die ("Erreur de la base de données.");

	
	// fonction pour convertir la date en format français et en format texte
	function datefr($date) { 
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
	<div id="layout" class="boxed">
		
		<?php include("header.php"); ?>
		
		<div class="page-content">
			<div class="row clearfix">
				<div class="grid_9 alpha">
					<div class="grid_12 omega posts righter">
						<div class="title colordefault">
							<h4>Messages reçus</h4>
						</div><!-- /title bar -->
						
						<?php while($affiche2 = mysql_fetch_row($result2)) {
							echo "<div class='messages'>";
							// Requête pour récupérer le nom et prénom du membre qui a envoié le message
							$requet_sender="SELECT NomMembre, PrenomMembre FROM Membre WHERE IdMembre='".$affiche2[1]."'";
							$result_sender=mysql_query($requet_sender) or die("Erreur de base de données.");
							$sender=mysql_fetch_row($result_sender);

							// on affiche qu'une partie du message
							$messagecoupe2=substr($affiche2[3], 0, 10);

							if ($affiche2[5] == 'Non lu') { // si le message n'a pas été lu alors il s'affiche en gras
								// le lien renvoie vers le message sélectionnée grâce à l'ID récupéré par la méthode GET
								echo "<strong><a href='message.php?id=".$affiche2[0]."'>Message reçu le ".datefr($affiche2[4])." - Par ".$sender[1]." ".$sender[0]." - ".$messagecoupe2."</a></strong><br />";	
								echo "</div>";
							}
							else{ // sinon il s'affiche normalement
								// le lien renvoie vers le message sélectionnée grâce à l'ID récupéré par la méthode GET
								echo "<a href='message.php?id=".$affiche2[0]."'>Message reçu le ".datefr($affiche2[4])." - Par ".$sender[1]." ".$sender[0]." - ".$messagecoupe2."</a><br />";	
								echo "</div>";
							}

						} ?>
					</div><!-- end grid12 -->

					<div class="grid_12 omega posts righter">
						<div class="title colordefault">
							<h4>Messages envoyés</h4>
						</div><!-- /title bar -->
						
						<?php while($affiche = mysql_fetch_row($result)) {
								echo "<div class='messages'>";
								// Requête pour récupérer le nom et prénom du membre qui a recu le message
								$requet_receiver="SELECT NomMembre, PrenomMembre FROM Membre WHERE IdMembre='".$affiche[2]."'";
								$result_receiver=mysql_query($requet_receiver) or die("Erreur de base de données.");
								$receiver=mysql_fetch_row($result_receiver);

								// on affiche qu'une partie du message
								$messagecoupe=substr($affiche[3], 0, 10);

								// le lien renvoie vers le message sélectionnée grâce à l'ID récupéré par la méthode GET
								echo "<a href='message.php?id=".$affiche[0]."'>Message envoyé le ".datefr($affiche[4])." - À ".$receiver[1]." ".$receiver[0]." - ".$messagecoupe."</a><br />";
								echo "</div>";
							}
						?>
					</div><!-- end grid12 -->

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