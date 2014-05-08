<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie8" lang="fr"><![endif]-->
<!--[if IE 9 ]><html class="ie9" lang="fr"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" lang="fr_FR"><!--<![endif]-->
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
	<div class="boxed">
		<header id="header">
			<div class="a_head">
				<div class="row clearfix">
					<div class="right_bar">
						<div id="connexion">
							<div class="connect">
								<a>Se connecter</a>
							</div>
							<div class="c_form">
								<form action="" id="connexionform" method="post">
									<input id="inputmail" name="connexion" type="text" onfocus="if (this.value=='Email') this.value = '';" onblur="if (this.value=='') this.value = 'Email';" value="Email" placeholder="Email">
									<input id="inputmdp" name="connexion" type="password" onfocus="if (this.value=='Mot de passe') this.value = '';" onblur="if (this.value=='') this.value = 'Mot de passe';" value="Mot de passe" placeholder="Mot de passe">
									<button type="submit">Valider</button>
								</form><!-- /form -->
							</div><!-- /s form -->
						</div> <!-- /connexion -->
						<div id="inscription">
							<a href="index.html#" class="" title="">S'inscrire</a>
						</div><!-- /inscription -->

						<span id="date_time"></span><!-- /date -->
					</div><!-- /right bar -->
				</div><!-- /row -->
			</div><!-- /a head -->

			<div class="b_head">
				<div class="row clearfix">
					<div class="logo">
						<a href="index.html" title="iPress - Responsive News/Blog/Magazine HTML5"><img src="images/logo.png" alt="iPress - Responsive News/Blog/Magazine HTML5"></a>
					</div><!-- /logo -->
				</div><!-- /row -->
			</div><!-- /b head -->

			<div class="row clearfix">
				<div class="c_head clearfix">
					<nav>
						<ul class="sf-menu">
							<li class="current colordefault home_class"><a href="index.html"><i class="icon-home"></i></a>
							</li>
							<li class="color1"><a href="../evenements.php">Événements</a>
							</li>
							<li class="color2"><a href="../petitesannonces.php">Petites annonces</a>
							</li>
							<li class="color3"><a href="../logements.php">Logements</a>
							</li>
							<li class="color4"><a href="../stageemploi.php">Stage / Emploi</a></li>
							<li class="color5"><a href="../covoiturage.php">Covoiturage</a></li>
							<li class="color6"><a href="../orientation.php">Orientation</a></li>
							<li class="color7"><a href="../loisirs.php">Loisirs</a></li>
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

		<div class="page-content">
			<div class="row clearfix">
				<div class="grid_9 alpha">

					<div class="grid_12 omega posts righter">
						<div class="title color1">
							<h4>Événements</h4>
						</div><!-- /title bar -->
						
						<div class="mbf clearfix article_cat"> <!-- article -->
							<div class="grid_4 alpha">
								<a href="annonce.php"><img src="images/assets/r_4.jpg" alt=""></a>
							</div><!-- /grid4 alpha -->

							<div class="grid_8 omega">
								<div class="post_content">
									<h3> <a href="annonce.php">Titre annonce</a> </h3><p class="com_post"> - 0 commentaires</p>
									<p class="date_content"> Date  -  Localisation
									<br />Prix</p>
									<p class="description_content"> Lorem Ipsum is simply dummy text of the printing and typesetting industry unknown printer took a galley of type and scrambled it to make a type has survived not only fiv... </p>
								</div><!-- /post content -->
							</div><!-- /grid8 omega -->
						</div><!-- /article-->

						<div class="mbf clearfix article_cat"> <!-- article -->
							<div class="grid_4 alpha">
								<a href="annonce.php"><img src="images/assets/r_4.jpg" alt=""></a>
							</div><!-- /grid4 alpha -->

							<div class="grid_8 omega">
								<div class="post_content">
									<h3> <a href="annonce.php">Titre annonce</a> </h3><p class="com_post"> - 0 commentaires</p>
									<p class="date_content"> Date  -  Localisation
									<br />Prix</p>
									<p class="description_content"> Lorem Ipsum is simply dummy text of the printing and typesetting industry unknown printer took a galley of type and scrambled it to make a type has survived not only fiv... </p>
								</div><!-- /post content -->
							</div><!-- /grid8 omega -->
						</div><!-- /article-->

						<div class="mbf clearfix article_cat"> <!-- article -->
							<div class="grid_4 alpha">
								<a href="annonce.php"><img src="images/assets/r_4.jpg" alt=""></a>
							</div><!-- /grid4 alpha -->

							<div class="grid_8 omega">
								<div class="post_content">
									<h3> <a href="annonce.php">Titre annonce</a> </h3><p class="com_post"> - 0 commentaires</p>
									<p class="date_content"> Date  -  Localisation
									<br />Prix</p>
									<p class="description_content"> Lorem Ipsum is simply dummy text of the printing and typesetting industry unknown printer took a galley of type and scrambled it to make a type has survived not only fiv... </p>
								</div><!-- /post content -->
							</div><!-- /grid8 omega -->
						</div><!-- /article-->
					</div><!-- end grid12 -->
				</div><!-- end grid9 -->

				<div class="grid_3 omega sidebar sidebar_a">
					<div class="widget">
						<ul class="counter clearfix">
							<li class="twitter">
								<a href="index.html#"><i class="fa fa-twitter"></i></a>
								<span> 2545 <br> Followes </span>
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
											<td colspan="3" id="prev"><a href="index.html#" title="View posts for December 2013">« Dec</a></td>
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
						<ul class="recent_comments small_posts">
							<li class="clearfix">
								<a class="s_thumb" href="single_post.html"><img width="80" height="80" src="images/assets/avatar1.jpg" alt="#"></a>
								<h5><a href="index.html#">Alex Cohn</a>:</h5>
								<p>Lorem Ipsum is simply dummy text of the printing...</p>
							</li>
							<li class="clearfix">
								<a class="s_thumb" href="single_post.html"><img width="80" height="80" src="images/assets/avatar2.jpg" alt="#"></a>
								<h5><a href="index.html#">Michele</a>:</h5>
								<p>Here's What Instagram Ads Will Look Like...</p>
							</li>
							<li class="clearfix">
								<a class="s_thumb" href="single_post.html"><img width="80" height="80" src="images/assets/avatar3.jpg" alt="#"></a>
								<h5><a href="index.html#">Admin</a>:</h5>
								<p>Lorem ipsum is dolor sit amet text of the ipsum...</p>
							</li>
							<li class="clearfix">
								<a class="s_thumb" href="single_post.html"><img width="80" height="80" src="images/assets/avatar4.jpg" alt="#"></a>
								<h5><a href="index.html#">Tomas Giggs</a>:</h5>
								<p>Lorem Ipsum is simply dummy text of the printing...</p>
							</li>
						</ul>
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
				months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
				d = date.getDate();
				day = date.getDay();
				days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
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