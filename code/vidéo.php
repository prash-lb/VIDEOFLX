<?php

include("connexion.inc.php");
session_start();
if (empty($_POST['nom_film'])== TRUE){
        $nom_film = $_SESSION['nom_film'];
}
if (empty($_POST['nom_film'])== FALSE) {
        $_SESSION['nom_film'] = $_POST['nom_film'];
		$nom_film = $_POST['nom_film'];
    }
?>
<title>VIDEO</title>
<center>
	<h1> film </h1>
<?php
$requete="SELECT * FROM vidéo";
$sql=$cnx->query($requete);
$joue=$cnx-> query("SELECT * FROM joue");
$personnage = $cnx->query("SELECT * FROM personnage");
$acteur =$cnx->query("SELECT * FROM personne");
$visionnage =$cnx->query("SELECT*FROM visionnage");
$appartient = $cnx->query ("SELECT *FROM appartient");
$_SEESION['lecture'] = FALSE;
foreach ($sql as $ligne){
	if ($ligne['titre']==$nom_film){
		$_SESSION['titre']=$ligne['titre'];
		$_SESSION['durée']=$ligne['durée'];
		$_SESSION['année_prod']=$ligne['année_prod'];
		$_SESSION['t']=$ligne['lien_vidéo'];
		$_SESSION['id'] = $ligne['id_video'];
		foreach ($appartient as $key ) {
			if ($key['id_video'] == $_SESSION['id']){
				foreach ($visionnage as $ke) {
				if ($key['id_visio']==$ke['id_visio']) {
					if ($ke['id_profil']==$_SESSION['id_profile']){
						$_SEESION['lecture'] = TRUE;
						$_SESSION['temp'] = $ke['durée'];

					}
				}
			}
		}}}}
			
						
		 if ($_SEESION['lecture']) {
			?><iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $_SESSION['t'];?>?start=<?php echo $_SESSION['temp'];?> " title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><?php
		 }
		 if ($_SEESION['lecture']==FALSE){ ?>
		 <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $_SESSION['t'];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		

<?php
		 }
		
	


?>
<center>
<?php
echo 'Titre : '.$_SESSION['titre'].'    ';
echo 'Durée : '.$_SESSION['durée'].'    ';
echo 'Année de production : '.$_SESSION['année_prod'].'<br>';


foreach ($joue as $k) {
	if ($k["id_video"]==$_SESSION['id']) {
		$_SESSION['num_acteur'] = $k['id_perso'];
		$_SESSION['num_personnage'] = $k['id_personnage'];
	foreach ($personnage as $perso) {
			
			$_SESSION['id_personnage'] = $perso['id_personnage'];
			if($_SESSION['num_personnage'] == $_SESSION['id_personnage']){
				$_SESSION['nom_personnage'] = $perso['descriptions'];
			}

		}
		foreach ($acteur as $act) {
			$_SESSION['id_perso']= $act['id_perso'];
			if ( $_SESSION['num_acteur'] == $act['id_perso']) {
				$_SESSION['nom_acteur'] = $act['nom'];
				$_SESSION['prenom_acteur'] = $act['prenom'];
			}}
			echo $_SESSION['nom_acteur']." ".$_SESSION['prenom_acteur'] .' joue '.$_SESSION['nom_personnage'];
		
	}}

		

	
?>

<html>
<body>

            <p>
			<label for ="note">Note</label>
			<select name="Note">
				<option value="0"> 0 </option> 
                <option value="1"> 1 </option>
                <option value="2"> 2 </option> 
                <option value="3"> 3 </option> 
                <option value="4"> 4 </option>
                <option value="5"> 5 </option>   
			</select>
		</p>
		</center>

<form action="page_d_acceuil.php" method="post">
        <label for ='retour'> </label>
		<p><input type ="submit" value='<------' name='effacer'  style="width:130px"></p>
    </form>

<form action="sauvegarde_visionnage.php " method="post">
		

		<p>
			<label for ="minute">minute(format ex:00)</label>
			<input id="minute" type = "varchar" name="minute">
		</p>
		<p>
			<label for ="seconde">seconde(format XX ex:23 )</label>
			<input id="seconde" type = "varchar" name="seconde">
		
		</p>
		<p><input type ="submit" value="sauvegarder le visionnage"></p></form>
</body>
</html>






		