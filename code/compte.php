<?php
include("connexion.inc.php");

session_start();
$nom = $_SESSION['nom'];
$mail = $_SESSION['mail'];
$compteur_de_profil = 0;
$stack = array();
$stmt = $cnx->query("SELECT * FROM CLIENT");
foreach ($stmt as $row) {
    if ($row['nom']==$nom and $row['courriel']==$mail) {
        $m=$cnx->query("SELECT id_client,prenom FROM profil");
        foreach($m as $col) {
            if ($row['id_client']==$col['id_client']) {
                if (empty($col['prenom'] == FALSE)) {
                    $compteur_de_profil +=1;
                    array_push($stack,$col['prenom']);
                }
             }
        } $_SESSION['id'] = $row['id_client'];
        $_SESSION['aboner']= $row['abonnement'];
            ?>
            <html>
            

            <center>
                    <h2>Voici vos profils : </h2>
                        
                    <?php      
                        foreach($stack as $value){
                            ?>
                         <form action="page_d_acceuil.php " method="post">
                         <label for =<?php echo $value;?>><?php $value;?></label>
		                    <p><input type ="submit" value=<?php echo $value;?> name='nom_compte'  style="width:130px"></p>
                        </form><?php?>

        
            <?php

        }
        if ($compteur_de_profil !=4 and $_SESSION['aboner']=='p') {?>
                            <form action="inscription_profil.php " method="post">
		                    <p><input type ="submit" value="Créer un profil"></p>
	                    </form> </center>    
            </html><?php
                        }
        if ($compteur_de_profil !=1 and $_SESSION['aboner']=='n') {?>
                            <form action="inscription_profil.php " method="post">
		                    <p><input type ="submit" value="Créer un profil"></p>
	                    </form> </center>    
            </html><?php
                        }
    }
}
?>

<form action="supprimer_un_profil_index.php " method="post">
		<p><input type ="submit" value="suprimer un profil "></p>
		</form>
<form action="connect.php" method="post">
        <label for ='retour'></label>
		<p><input type ="submit" value='déconnexion' name='retour'  style="width:130px"></p>
    </form>