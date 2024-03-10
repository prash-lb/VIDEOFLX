
<!DOCTYPE html>
<html>
<head>
	<title>Vidéo flex</title>
</head>
<body>
<h1> VidéoFlex</h1>
<center>
	<h2> Inscripton </h2>
	<form action="insertion.php " method="post">
		

		<p>
			<label for ="nom">Nom</label>
			<input id="name" type = "varchar" name="lastname">
		</p>
		<p>
			<label for ="prenom">Prenom</label>
			<input id="fname" type = "varchar" name="firstname">
		</p>
		<p>
			<label for ="courriel">adresse électronique</label>
			<input id="mel" type = "varchar" name="mail">
		</p>
		<p>
			<label for ="adresse">adresse</label>
			<input id="adress" type = "varchar" name="adress">

		</p>
		<p>
			<label for ="abonnement">abonné</label>
			
			<select name="abonnée">
				<option value="" selected="selected">-- CHOIX --</option>
				<option value='p'> premium </option>
				<option value='n'> normale </option> 
			</select>
		</p>
		<p>
			<label for ="date_de_fin_abonnement">Expiration</label>
			<input id="fin-abonnée" type = "date" name="expirer">
		</p>
		<p><input type ="submit" value="Enregistrer"></p>
	</form>	
	<form action="connect.php " method="post">
		<p><input type ="submit" value = "Connexion"></p>

	</form>
</center>
</body>
</html>