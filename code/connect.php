<!DOCTYPE html>
<html>
<head>
	<title>Vidéo flex</title>
</head>
<body>
<h1> VidéoFlex</h1>
<center>

	<h1> Connexion </h1>
	<form action="connexion.php " method="post">
		<p>
			<label for ="nom">NOM</label>
			<input id="nom" type = "varchar" name="lastname">
		</p>
		<p>
			<label for ="courriel">Adresse électronique</label>
			<input id="courriel" type = "varchar" name="mail">
		</p>
		
		<p><input type ="submit" value="valider"></p>
	</form>
	<form action="index.php " method="post">
		<p><input type ="submit" value="Creér un compte "></p>
	</form>
</center>
</body>
</html>
