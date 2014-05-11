<?php

	// Si le membre est connecté, on récupère son ID pour qu'il puisse accéder à son profil
	if (isset($_SESSION['mail'])) {
		$requetProfil="SELECT IdMembre FROM Membre WHERE MailMembre='".$_SESSION['mail']."'";
		$resultProfil=mysql_query($requetProfil) or die("Erreur de base de données.");
		$profil=mysql_fetch_row($resultProfil);
	

		// Requête qui permet de vérifier s'il le membre a recu des nouveaux messages non lus
		$requetnotifmess = "SELECT * FROM Message WHERE IdReceiver='".$profil[0]."' AND EtatMess='Non lu'";
		$resultnotifmess = mysql_query($requetnotifmess) or die ("Erreur de la base de données.");
		$notifmess = mysql_num_rows($resultnotifmess);
	}
?>
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
				<a href="index.php" title=""><img src="images/logo.png" alt=""></a>
			</div><!-- /logo -->
			<div id="poster_ann">
				<?php
					if (isset($_SESSION['mail'])) {
						echo "<a href='post_ann.php'>Déposer une annonce</a>";
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

			<?php if (isset($_SESSION['mail'])) { ?>
			<div class="right_icons">
				<div class="search">
					<div class="search_icon"><a href="messagerie.php"><i class="icon-message"></i></a></div>
					<?php if ($notifmess != 0) {
						echo "<div class='notifications-message'><span>".$notifmess."</span></div>";
					} ?>
				</div><!-- /search -->
			</div><!-- /right icons -->
			<?php } ?>
		</div><!-- /c head -->
	</div><!-- /row -->
</header><!-- /header -->