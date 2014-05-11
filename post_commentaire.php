<?php
	session_start();
	include("connect_bdd.php");
	
	mysql_query("SET NAMES 'utf8'"); //Fonction qui convertit toutes les entrées textuelles en utf-8 pour la BDD
	
	if(!empty($_POST['post_com'])){
		//ajout de l'annonce dans la BDD
		$commentaire=$_POST['post_com'];
		$idAnn=$_POST['idAnnonce'];
		$idProfil=$_POST['idProfil'];
		$DateCom=date("Y-m-d H:i:s");
	
		$requetCommentaire="INSERT INTO Commentaire (IdMembre, IdAnn, ContenuCom, DateCom) values ('$idProfil', '$idAnn', '".mysql_real_escape_string($commentaire)."', '$DateCom')";	
		mysql_query($requetCommentaire) or die("erreur requête".mysql_error());
	
		echo "Votre commentaire a été posté avec succès <br />";
		// on redirige notre visiteur vers la page de l'annonce
		echo "<script>window.location.replace('ipress/annonce.php?id=".$idAnn."');</script>";
	}
	else {
		echo "<script>alert('Vous n'avez pas entré de message.');</script>";
		// on redirige notre visiteur vers la page de l'annonce
		echo "<script>window.location.replace('ipress/post_ann.php')</script>";
	}
?>