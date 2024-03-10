<?php


include("connexion.inc.php");
session_start();
$id_lm = $_SESSION['id'];
$pdostat=$cnx-> prepare(' INSERT INTO profil (id_profil, nom, prenom, id_client)VALUES (:id_profil,:nom,:prenom,:id_client)');
$id_profil = 0;
$p=$cnx->query("SELECT *FROM profil");
foreach($p as $ligne)
{
    $id_profil+=1;
    if ($ligne['id_client']==$id_lm) {
    
    if ($_POST['firstname'] == $ligne['prenom']) {
        echo "erreur le prénom est déja utiliser";
        ?>
        <form action="compte.php " method="post">
		<p><input type ="submit" value="<---"></p>
	    </form><?php
        exit();
    }}
}	


/** on lie les valeurs*/
$pdostat-> bindValue(':id_profil',$id_profil,PDO::PARAM_INT);
$pdostat-> bindValue(':nom',$_POST['lastname'],PDO::PARAM_STR);
$pdostat-> bindValue(':prenom',$_POST['firstname'] ,PDO::PARAM_STR);
$pdostat-> bindValue(':id_client',$id_lm,PDO::PARAM_INT);
$pdostat->execute();
if ($pdostat->execute() == 0) {

    ?>
    <p>Profil créer</p>
    <form action="compte.php " method="post">
		<p><input type ="submit" value="<---"></p>
	</form><?php
    exit();
}

?>
