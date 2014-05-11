<?php
	session_start();
	//Connexion à la base de données
	include("../connect_bdd.php");

	mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
	
	// On récupère l'id du profil à modifier (depuis l'url)
	$idSelect = $_GET['id'];

	// On effectue une requête afin d'afficher les informations du profil du membre			
	$requet = "SELECT * FROM Membre WHERE IdMembre='".$idSelect."'";
	$result = mysql_query($requet) or die ("Erreur de la base de données.");
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
							<?php while($affiche = mysql_fetch_row($result)) {
									// On affiche un formulaire pré-rempli avec les données déjà rentrées dans la bdd
									echo "<form method='post' action=''>
									
									<p>Nom : <input type='text' name='nom' value='".$affiche[1]."'/></p>
									<p>Prénom : <input type='text' name='prenom' value='".$affiche[2]."'/></p>
									<p>Age : <input type='text' name='age' maxlength='2' value='".$affiche[6]."'/></p>
									<p>Formation : <input type='text' name='formation' value='".$affiche[5]."'/></p>
									<p>Mail : <input type='text' name='mail' value='".$affiche[4]."'/></p>
									<p>Mot de passe : <input type='password' name='mdp_inscript' value='".$affiche[3]."'/></p>
								
									<input type='submit' name='Valider' value='Valider'/>";
									
									// Si le formulaire a été validé, alors on modifie les informations du membre et on affiche un message au membre
									if (isset($_POST['Valider'])){
										
										// On vérifie si tous les champs sont remplis
										if (isset($_POST['age']) && isset($_POST['formation']) && isset($_POST['mdp_inscript']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail'])){
									
											// Mise à jour des informations du membre
											$age=$_POST['age'];
											$formation=$_POST['formation'];
											$mdp_inscript=$_POST['mdp_inscript'];
											$prenom=$_POST['prenom'];
											$nom=$_POST['nom'];
											$mail=$_POST['mail'];

											//On vérifie si le mail n'existe pas déjà
											$requet_exist = "SELECT * FROM Membre WHERE MailMembre='$mail' AND IdMembre!='".$idSelect."'"; 
											$result_exist = mysql_query($requet_exist) or die("Erreur de base de données.");
											$num = mysql_num_rows($result_exist);
											if ($num == 0){
												$requetmodifprofil="UPDATE Membre SET NomMembre='".mysql_real_escape_string($nom)."', PrenomMembre='".mysql_real_escape_string($prenom)."', MdpMembre='".mysql_real_escape_string($mdp_inscript)."', MailMembre='".mysql_real_escape_string($mail)."', ScolMembre='".mysql_real_escape_string($formation)."', AgeMembre='".mysql_real_escape_string($age)."' WHERE IdMembre='".$idSelect."'";	
												mysql_query($requetmodifprofil) or die("erreur requête".mysql_error());
												
												echo "<script>alert('Votre profil a été modifié avec succès.');</script>";
												// on redirige notre visiteur vers la page de l'annonce
												echo "<script>window.location.replace('profil.php?id=".$idSelect."');</script>";
											}
											else { 
												echo "<script>alert('Ce mail est déjà utilisé.');</script>";
												// on redirige notre visiteur vers la page pour s'inscrire
												echo "<script>window.location.replace('modif_profil.php?id=".$idSelect."');</script>";
											}
										}
										else {
											echo "<script>alert('Veuillez remplir tous les champs.');</script>";
											// on redirige notre visiteur vers la page de l'annonce
											echo "<script>window.location.replace('modif_profil.php?id=".$idSelect."')</script>";
										}
									}
								}
							?>	
												
						</div><!-- /single post -->
					</div><!-- end grid8 -->
				</div><!-- end grid9 -->

				<div class="grid_3 omega sidebar sidebar_a">
					<div class="widget">
						<ul class="counter clearfix">
							<li class="twitter">
								<a href="index.html#"><i class="fa fa-twitter"></i></a>
								<span> 2545 <br> Followers </span>
							</li>
							<li class="facebook">
								<a href="index.html#"><i class="fa fa-facebook"></i></a>
								<span> 1317 <br> Likes </span>
							</li>
						</ul>
					</div><!-- widget réseaux sociaux -->

					<div class="widget">
							<div id="calendar_wrap"><table id="wp-calendar">
								<caption>Avril 2014</caption>
									<thead>
										<tr>
											<th scope="col" title="Monday">L</th>
											<th scope="col" title="Tuesday">M</th>
											<th scope="col" title="Wednesday">M</th>
											<th scope="col" title="Thursday">J</th>
											<th scope="col" title="Friday">V</th>
											<th scope="col" title="Saturday">S</th>
											<th scope="col" title="Sunday">D</th>
										</tr>
									</thead>
							
									<tfoot>
										<tr>
											<td colspan="3" id="prev"><a href="index.html#" title="">« Dec</a></td>
											<td class="pad">&nbsp;</td>
											<td colspan="3" id="next" class="pad">&nbsp;</td>
										</tr>
									</tfoot>
							
									<tbody>
										<tr><td colspan="2" class="pad">&nbsp;</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
										<tr><td>6</td><td>7</td><td id="today">8</td><td>9</td><td>10</td><td>11</td><td>12</td></tr>
										<tr><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td></tr>
										<tr><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td></tr>
										<tr><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td><td class="pad" colspan="2">&nbsp;</td></tr>
									</tbody>
								</table>
							</div>
						</div><!-- widget calendrier -->

					<div class="widget">
						<div class="title"><h4>Commentaires récents</h4></div>
					</div><!-- /widget commentaires récents -->

				</div><!-- /grid3 barre latérale -->
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