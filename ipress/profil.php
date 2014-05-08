<?php
	session_start();
	//Connexion à la base de données
	include("../connect_bdd.php");

	mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
	
	//Requête pour afficher les données du membre
	$requet_membre="SELECT NomMembre, PrenomMembre, MailMembre, ScolMembre, AgeMembre, PhotoMembre FROM Membre WHERE MailMembre='".$_SESSION['mail']."'";
	$result_membre=mysql_query($requet_membre) or die("Erreur de base de données.");
	$membre=mysql_fetch_row($result_membre);	
	// On effectue les requêtes afin d'afficher les annonces postées par le membre			
	$requet = "SELECT Annonce.IdAnn, Annonce.TitreAnn, Annonce.PrixAnn, Annonce.CatAnn, Annonce.DescrAnn, Localisation.VilleLocal, Annonce.DateAnn, Image.UrlImage FROM Annonce, Localisation, Image, Membre WHERE Localisation.IdLocal=Annonce.IdLocal AND Image.IdAnn=Annonce.IdAnn AND Membre.IdMembre=Annonce.IdMembre AND Membre.MailMembre='".$_SESSION['mail']."'";
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
<!--[if (gte IE 10)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" lang="en-US"><!--<![endif]-->
<head>
	<title>Here's What Instagram Ads Will Look Like</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Seo Meta -->
		<meta name="description" content="Here's What Instagram Ads Will Look Like">
		<meta name="keywords" content="iPress, magazine, light, dark, themeforest, multi purpose, premium, unlimited, blog, news, AD, optimized">

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
									echo "<div id='deconnexion'> <a href='profil.php'>Bonjour ".$_SESSION['prenom']."</a><a href='../logout.php'>Se déconnecter</a></div>";
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
						<a href="post_ann.php"><p>Déposer une annonce</p></a>
					</div>
				</div><!-- /row -->
			</div><!-- /b head -->

			<div class="row clearfix">
				<div class="c_head clearfix">
					<nav>
						<ul class="sf-menu">
							<li class="current colordefault home_class"><a href="index.php"><i class="icon-home"></i></a>
							</li>
							<li class="color1"><a href="evenements.php">Événements</a>
							</li>
							<li class="color2"><a href="petitesannonces.php">Petites annonces</a>
							</li>
							<li class="color3"><a href="logements.php">Logements</a>
							</li>
							<li class="color4"><a href="stageemploi.php">Stage / Emploi</a></li>
							<li class="color5"><a href="covoiturage.php">Covoiturage</a></li>
							<li class="color6"><a href="orientation.php">Orientation</a></li>
							<li class="color7"><a href="loisirs.php">Loisirs</a></li>
						</ul><!-- /menu -->
					</nav><!-- /nav -->

					<div class="right_icons">
						<div class="search">
							<div class="search_icon"><i class="fa-search"></i></div>
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

		<div class="page-content">			<div class="row clearfix">
				<div class="grid_9 alpha">
					<div class="grid_12 alpha posts">

						<div class="single_post mbf clearfix">
							<h3 class="single_title"><a href="../supprim_profil.php"><i class="icon-trash mi"></i></a></h3>
							<?php //On affiche l'image du profil
								echo "<img src='../imgProfil/".$membre[5].".jpg'/><br />";
							?>	
							<h4 class="h4float">Prénom : </h4><p class="pfloat">
							<?php // On affiche le prénom
								echo $membre[1];
							?></p>
							<h4 class="h4float">Nom : </h4><p class="pfloat">
							<?php // On affiche le nom
								echo $membre[0];
							?></p>
							<h4 class="h4float">Mail :</h4><p class="pfloat">
							<?php  //On affiche le mail
								echo $membre[2];
							?></p>	
							<h4 class="h4float">Scolarité : </h4><p class="pfloat"><?php  
								// On affiche la scolarité
								echo $membre[3];
							?>
							<h4 class="h4float">Age : </h4><p class="pfloat"><?php  	
								// On affiche l'age
								echo $membre[4];
							?></p>
							<h4>Mes annonces :</h4> 
							<p class="pfloat annonce"><?php // On affiche la liste des annonces
									while($affiche = mysql_fetch_row($result)) {
										// le lien renvoie vers l'annonce sélectionnée grâce à l'ID récupéré par la méthode GET
										echo "<a href='annonce.php?id=".$affiche[0]."'>".$affiche[1]." - ".$affiche[3]."</a><br />".datefr($affiche[6])." - ".$affiche[5]."<br />".$affiche[2]." €<br />".$affiche[4]."<br />";
										echo "<img src='../imgAnnonce/".$affiche[7].".jpg'/><br />";		
									} 
								?>
							</p>
						</div><!-- /single post -->


						<div class="related_posts mbf clearfix">
							<div class="title">
								<h4>Annonces similaires</h4>
								<a href="single_post.html#" class="feed toptip" title="More Posts"><i class="icon-forward"></i></a>
							</div>

							<div class="carousel_related">
								<div class="item"><a href="single_post.html#"><img class="toptip" src="images/assets/r_7.jpg" alt="#" title="Lorem Ipsum is not simply"></a></div>
								<div class="item"><a href="single_post.html#"><img class="toptip" src="images/assets/r_8.jpg" alt="#" title="Shooting for new goodies"></a></div>
								<div class="item"><a href="single_post.html#"><img class="toptip" src="images/assets/r_9.jpg" alt="#" title="For the days of peace and warmth"></a></div>
								<div class="item"><a href="single_post.html#"><img class="toptip" src="images/assets/r_10.jpg" alt="#" title="A picture of Sin Fang in Bairro Alto"></a></div>
								<div class="item"><a href="single_post.html#"><img class="toptip" src="images/assets/r_11.jpg" alt="#" title="Breaking the darkness"></a></div>
								<div class="item"><a href="single_post.html#"><img class="toptip" src="images/assets/r_12.jpg" alt="#" title="For the days of peace and warmth"></a></div>
								<div class="item"><a href="single_post.html#"><img class="toptip" src="images/assets/r_13.jpg" alt="#" title="Bairro Alto in Lisboa, Portugal"></a></div>
							</div>
						</div><!-- /related -->

						<div class="disqus_comments">
							<!-- Disqus Comment Form -->
								<div id="disqus_thread"></div>
								<script type="text/javascript">
								/* <![CDATA[ */
									var disqus_shortname = 'officialtemplate';
									(function() {
										var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
										dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
										(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
									})();
								/* ]]> */
								</script><noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
							<!-- Disqus Comment Form -->
						</div><!-- /comments -->
					</div><!-- end grid8 -->
				</div><!-- end grid9 -->

				<div class="grid_3 omega sidebar sidebar_a">
					<div class="widget">
						<ul class="counter clearfix">
							<li class="twitter">
								<a href="single_post.html#"><i class="fa fa-twitter"></i></a>
								<span> 2545 <br> Followes </span>
							</li>
							<li class="facebook">
								<a href="single_post.html#"><i class="fa fa-facebook"></i></a>
								<span> 1317 <br> Likes </span>
							</li>
							<li class="dribbble">
								<a href="single_post.html#"><i class="fa fa-dribbble"></i></a>
								<span> 325 <br> Followes </span>
							</li>
							<li class="rss">
								<a href="single_post.html#"><i class="fa fa-rss"></i></a>
								<span> 27 <br> Subscribers </span>
							</li>
						</ul>
					</div><!-- widget -->

					<div class="widget">
						<div class="ads_widget clearfix">
							<a href="single_post.html#"><img src="images/ads2.jpg" alt="#"></a>
							<a href="single_post.html#" class="lefter mt"><img src="images/ads3.jpg" alt="#"></a>
							<a href="single_post.html#" class="righter mt"><img src="images/ads3.jpg" alt="#"></a>
						</div><!-- widget -->
					</div><!-- widget -->

					<div class="widget">
						<div class="title"><h4>What's Hot</h4></div>

							<div class="small_slider_hots owl-carousel owl-theme">
								<div class="item clearfix">
									<ul class="small_posts">
										<li class="clearfix">
											<a class="s_thumb hover-shadow" href="single_post.html"><img width="70" height="70" src="images/assets/thumb13.jpg" alt="#"><span>1</span></a>
											<h3><a href="single_post.html">What is the worst could be the worst?</a></h3>
											<div class="meta mb"> <a class="cat color1" href="single_post.html#" title="View all posts under Entertainment">Entertainment</a><span class="post_rating" href="#" title="Rating">8.89</span> </div>
										</li>
										<li class="clearfix">
											<a class="s_thumb hover-shadow" href="single_post.html"><img width="70" height="70" src="images/assets/thumb12.jpg" alt="#"><span>2</span></a>
											<h3><a href="single_post.html">Praesent ipsum adipiscing mi eget ipsum</a></h3>
											<div class="meta mb"> <a class="cat color3" href="single_post.html#" title="View all posts under News">News</a><span class="post_rating" href="#" title="Rating">8.1</span> </div>
										</li>
										<li class="clearfix">
											<a class="s_thumb hover-shadow" href="single_post.html"><img width="70" height="70" src="images/assets/thumb11.jpg" alt="#"><span>3</span></a>
											<h3><a href="single_post.html">Paul Thomson on post with SoundCloud</a></h3>
											<div class="meta mb"> <a class="cat color4" href="single_post.html#" title="View all posts under Sports">Sports</a><span class="post_rating" href="#" title="Rating">7.95</span> </div>
										</li>
										<li class="clearfix">
											<a class="s_thumb hover-shadow" href="single_post.html"><img width="70" height="70" src="images/assets/thumb10.jpg" alt="#"><span>4</span></a>
											<h3><a href="single_post.html">For the days of peace and warmth</a></h3>
											<div class="meta mb"> <a class="cat color5" href="single_post.html#" title="View all posts under People">People</a><span class="post_rating" href="#" title="Rating">7.5</span> </div>
										</li>
									</ul>
								</div>
								<div class="item clearfix">
									<ul class="small_posts">
										<li class="clearfix">
											<a class="s_thumb hover-shadow" href="single_post.html"><img width="70" height="70" src="images/assets/thumb9.jpg" alt="#"><span>5</span></a>
											<h3><a href="single_post.html">What worst could be the worst?</a></h3>
											<div class="meta mb"> <a class="cat color6" href="single_post.html#" title="View all posts under People">People</a><span class="post_rating" href="#" title="Rating">7</span> </div>
										</li>
										<li class="clearfix">
											<a class="s_thumb hover-shadow" href="single_post.html"><img width="70" height="70" src="images/assets/thumb8.jpg" alt="#"><span>6</span></a>
											<h3><a href="single_post.html">Praesent ipsum adipiscing mi eget ipsum</a></h3>
											<div class="meta mb"> <a class="cat color7" href="single_post.html#" title="View all posts under TV">TV</a><span class="post_rating" href="#" title="Rating">5.89</span> </div>
										</li>
										<li class="clearfix">
											<a class="s_thumb hover-shadow" href="single_post.html"><img width="70" height="70" src="images/assets/thumb7.jpg" alt="#"><span>7</span></a>
											<h3><a href="single_post.html">Paul Thomson on post with SoundCloud</a></h3>
											<div class="meta mb"> <a class="cat color8" href="single_post.html#" title="View all posts under Society">Society</a><span class="post_rating" href="#" title="Rating">5.5</span> </div>
										</li>
										<li class="clearfix">
											<a class="s_thumb hover-shadow" href="single_post.html"><img width="70" height="70" src="images/assets/thumb6.jpg" alt="#"><span>8</span></a>
											<h3><a href="single_post.html">For the days of peace and warmth</a></h3>
											<div class="meta mb"> <a class="cat color3" href="single_post.html#" title="View all posts under Health">Health</a><span class="post_rating" href="#" title="Rating">4</span> </div>
										</li>
									</ul>
								</div>
							</div><!-- /slides -->
					</div><!-- /widget -->

					<div class="widget">
						<div class="latest_tweets">
							<h4> <i class="fa fa-twitter"></i>  @iPress <small> tweets </small> </h4>
							<div class="tweets">
								<div class="tweets_slider owl-carousel owl-theme">
									<div class="item clearfix">
										Singolo is a free PSD template of a flat, single page website created by @T20 #freebie #psd <a href="single_post.html#">http://bit.ly/19XM8Lj</a> <br><br>										2 hours ago  
									</div><!-- /slide -->
									<div class="item clearfix">
										Singolo is a free PSD template of a flat, single page website created by @T20 #freebie #psd <a href="single_post.html#">http://bit.ly/19XM8Lj</a> <br><br>
										1 day ago  
									</div><!-- /slide -->
									<div class="item clearfix">
										Singolo is a free PSD template of a flat, single page website created by @T20 #freebie #psd <a href="single_post.html#">http://bit.ly/19XM8Lj</a> <br><br>
										5 days ago  
									</div><!-- /slide -->
								</div><!-- /tweets slider -->
							</div><!-- /tweets -->
						</div><!-- /latest tweets -->
					</div><!-- /widget -->

					<div class="widget">
						<div class="title"><h4>Polls</h4></div>
						<div class="wp-polls">
							<form class="wp-polls-form" action="#" method="post">
								<p class="tac"><strong>What do you think about our website?</strong></p>
								<div class="wp-polls-ans">
									<ul class="wp-polls-ul">
										<li><input type="radio" name="poll_2" value="6"> <label for="poll-answer-6">Awesome</label></li>
										<li><input type="radio" name="poll_2" value="7"> <label for="poll-answer-7">Super</label></li>
										<li><input type="radio" name="poll_2" value="8"> <label for="poll-answer-8">Normal</label></li>
										<li><input type="radio" name="poll_2" value="9"> <label for="poll-answer-9">Bad</label></li>
									</ul>
							
									<input type="button" name="vote" value="   Vote   " class="Buttons">
									<input type="button" name="results" value="   View Results   " class="Buttons">
								</div>
							</form>
						</div>
					</div><!-- widget -->

					<div class="widget">
						<div class="title"><h4>Recent Comments</h4></div>
						<ul class="recent_comments small_posts">
							<li class="clearfix">
								<a class="s_thumb hover-shadow" href="single_post.html"><img width="80" height="80" src="images/assets/avatar1.jpg" alt="#"></a>
								<h5><a href="single_post.html#">Alex Cohn</a>:</h5>
								<p>Lorem Ipsum is simply dummy text of the printing...</p>
							</li>
							<li class="clearfix">
								<a class="s_thumb hover-shadow" href="single_post.html"><img width="80" height="80" src="images/assets/avatar2.jpg" alt="#"></a>
								<h5><a href="single_post.html#">Michele</a>:</h5>
								<p>Here's What Instagram Ads Will Look Like...</p>
							</li>
							<li class="clearfix">
								<a class="s_thumb hover-shadow" href="single_post.html"><img width="80" height="80" src="images/assets/avatar3.jpg" alt="#"></a>
								<h5><a href="single_post.html#">Admin</a>:</h5>
								<p>Lorem ipsum is dolor sit amet text of the ipsum...</p>
							</li>
							<li class="clearfix">
								<a class="s_thumb hover-shadow" href="single_post.html"><img width="80" height="80" src="images/assets/avatar4.jpg" alt="#"></a>
								<h5><a href="single_post.html#">Tomas Giggs</a>:</h5>
								<p>Lorem Ipsum is simply dummy text of the printing...</p>
							</li>
						</ul>
					</div><!-- /widget -->

				</div><!-- /grid3 sidebar A -->
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