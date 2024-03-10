<?php
include("connexion.inc.php");
session_start();
$pdostat=$cnx-> prepare('INSERT INTO  visionnage (id_visio,durée,id_profil)VALUES( :id_visio,:dur,:id_profil)');
$lm = $cnx->prepare('INSERT INTO appartient(id_video,id_visio )VALUES(:id_video,:id_visio)');
$id = 0;
$p=$cnx->query("SELECT id_visio FROM visionnage");

foreach($p as $ligne)
{
 $id+=1;
}	
if (empty($_POST['minute'])==TRUE or empty($_POST['seconde']==TRUE)){?>
    <p>l'un des champ est vide impossible de sauvegarder votre visionnage </p>
<form action="vidéo.php " method="post">
    <p><input type ="submit" value="<---"></p>
</form><?php
exit();
}
if (($_POST['minute']< 0 or $_POST['minute']>60) or  ($_POST['seconde']<0 or $_POST['seconde'] >60 )) {
    ?>
    <p>les minute ou seconde rentré sont pas comprit entre 0 et 60  </p>
<form action="vidéo.php " method="post">
    <p><input type ="submit" value="<---"></p>
</form><?php
exit();
}

$temp = ((int)$_POST['minute']*60)+((int)$_POST['seconde']);
$jk =$cnx->query("SELECT * FROM visionnage");
$po=$cnx->query("SELECT * FROM appartient");
foreach ($jk as $key ) {
    foreach ($po as $ke) {

        if ($key['id_visio']==$ke['id_visio']){
            if (($key['id_profil']==$_SESSION['id_profile'])and ($ke['id_video']==$_SESSION['id']) ){
                $sqlQuery = 'UPDATE visionnage SET durée =:mp WHERE id_visio = :l AND id_profil=:ui ';
        
                $o= $cnx->prepare($sqlQuery);
                $recipes = $o->execute([
                    'l' => $key['id_visio'],
                    'mp' => $temp,
                    'ui' =>$_SESSION['id_profile'],

                ]);
                ?>
                <p>visionnage enregistré</p>
                    <form action=vidéo.php " method="post">
                    <p><input type ="submit" value="<---"></p>
                    </form><?php
                        exit();
                    ?><?php


            }
        }
    }

}


$pdostat-> bindValue(':id_visio',$id,PDO::PARAM_INT);
$pdostat-> bindValue(':dur',$temp,PDO::PARAM_STR);
$pdostat-> bindValue(':id_profil',$_SESSION['id_profile'],PDO::PARAM_INT);
$lm-> bindValue(':id_visio',$id,PDO::PARAM_INT);
$lm-> bindValue(':id_video', $_SESSION['id'],PDO::PARAM_INT);

$pdostat->execute();
$lm-> execute();

?>
<p>visionnage enregistré</p>
<form action="vidéo.php " method="post">
    <p><input type ="submit" value="<---"></p>
</form><?php
exit();
?>