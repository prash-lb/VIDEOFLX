<?php
include("connexion.inc.php");
session_start();
$_SESSION['mail']=$_POST['mail'];
$_SESSION['nom'] = $_POST['lastname'];
echo $_SESSION['mail'];
echo $_SESSION['nom'];
if (empty($_SESSION['mail']) or empty($_SESSION['nom'])){
    echo "Vous n'avez pas rentré votre nom ou votre mail";?>
    <form action="connect.php " method="post">
    <p><input type ="submit" value="connecter vous"></p>
    </form><?php
    exit();
}

$p=$cnx->query("SELECT courriel,nom FROM client");
if ((is_string($_SESSION['mail']) || is_string($_SESSION['mail']))&&(is_string($_SESSION['nom']) || is_string($_SESSION['nom']))){
foreach($p as $ligne){
    if ($ligne['courriel']==$_SESSION['mail'] and $ligne['nom']==$_SESSION['nom']) {
        printf('yop');
        header('Location:compte.php');
        exit();
        }
    }
}
echo "erreur provenant du  nom ou courriel";?>
<form action="connect.php " method="post">
<p><input type ="submit" value="connecter vous"></p>
</form><?php
exit();


?>
