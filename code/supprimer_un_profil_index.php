<!DOCTYPE html>
<?php
include("connexion.inc.php");
$stmt = $cnx->query("SELECT * FROM PROFIL");
session_start();

$liste_profil = array();
foreach ($stmt as $key) {
    if ($key["id_client"] == $_SESSION['id']){
		if (empty($key['prenom']== FALSE)) {
			array_push($liste_profil,$key['prenom']);
		}
    }
}
?>
<html>
<head>
	<title>Vidéo flex</title>
</head>
<body>
<h1> VidéoFlex</h1>
<center>
	<h2> suppression de profil </h2>
	<form action="supprimer_un_profil.php " method="post">
    <select name="supprimé">
				<option value="" selected="selected">-- CHOIX --</option>
				<?php
				foreach($liste_profil as $value){?>
				<option value=<?php echo $value;?>> <?php echo $value;?> </option><?php }?>

			</select>

		<p><input type ="submit" value="supprimer"></p></form>

	
</center>
</body>
</html>