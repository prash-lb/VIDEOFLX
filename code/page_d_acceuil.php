
<?php
    include("connexion.inc.php");
    session_start();
    if (empty($_POST['nom_compte'])== TRUE){
        $nom_profil = $_SESSION['prenom'];
    }
    if (empty($_POST['nom_compte'])== FALSE) {
        $nom_profil = $_POST['nom_compte'];
    }
    $p=$cnx->query("SELECT * FROM  profil");
    foreach ($p as $key) {
        if ($key['prenom']==$nom_profil){
            $_SESSION['prenom'] = $key['prenom'];
            $_SESSION['id_profile']= $key['id_profil'];
        }
    }
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>
<body>
<center>
    <h1>Bienvenue <?php echo $nom_profil?> voici les films disponible pour le moment :</h1>
    <?php
    $n=$cnx->query("SELECT titre FROM vidéo");
    foreach($n as $ligne){
        if (empty($nom = $ligne['titre'])== FALSE) {
        ?>
        <form action="vidéo.php" method="post">
        <label for =<?php echo $nom;?>></label>
		<p><input type ="submit" value=<?php echo $nom;?> name='nom_film'  style="width:130px"></p>
    </form>
    <?php
    }
    }
    
?>   
</center> 
<form action="compte.php" method="post">
        <label for ='retour'></label>
		<p><input type ="submit" value='<---' name='retour'  style="width:130px"></p>
    </form>  
    <form action="connect.php" method="post">
        <label for ='retour'></label>
		<p><input type ="submit" value='déconnexion' name='retour'  style="width:130px"></p>
    </form>   

</body>
</html>