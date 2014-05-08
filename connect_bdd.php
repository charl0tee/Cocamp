<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title></title>
	</head>
	<body>
			<?php
				//Gabi
				//$link = mysql_connect("localhost","root","") or die("erreur de connexion serveur".mysql_error());
				//Cha
				$link = mysql_connect("localhost","root","") or die("erreur de connexion serveur".mysql_error());
				$d = mysql_select_db("cocamp",$link) or die("erreur de connexion à la BDD".mysql_error());
			?>
	</body>
</html>