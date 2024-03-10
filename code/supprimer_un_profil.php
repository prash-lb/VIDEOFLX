<?php

include("connexion.inc.php");
session_start();
$name = $_POST['supprimé'];
$kh=$cnx->query("SELECT * FROM profil");

foreach ($kh as $key) {
    if ($key["prenom"]== $name) {
        $sqlQuery = 'UPDATE profil SET prenom = NULL WHERE prenom = :l ';
        
        $o= $cnx->prepare($sqlQuery);
        $recipes = $o->execute([
            'l' => $key['prenom'],
        ]);
        }}

echo"profil supprimé";?>
<form action="compte.php " method="post">
	<p><input type ="submit" value="retour au profil"></p>
</form><?php
exit();



?>
