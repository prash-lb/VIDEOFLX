<?php


include("connexion.inc.php");


$pdostat=$cnx-> prepare('INSERT INTO client (id_client , nom, prenom,courriel,adresse,abonnement,date_de_fin_abonnement) VALUES( :id_client, :nom, :prenom, :courriel, :adresse, :abonnement, :date_de_fin_abonnement )');
$id = 0;
$p=$cnx->query("SELECT nom FROM client");
foreach($p as $ligne)
{
    $id+=1;
}	

if ( empty($_POST['lastname'])or empty($_POST['firstname']) or empty($_POST['mail']) or empty($_POST['adress']) or empty($_POST['abonnée'])or empty($_POST['expirer']) ){
    echo 'Vous avez laissé  un champ d information vide';?>
    <form action="index.php " method="post">
	<p><input type ="submit" value="<---"></p>
	</form><?php
    exit(); 
}
/** on lie les valeurs*/
$pdostat-> bindValue(':id_client',$id,PDO::PARAM_INT);
$pdostat-> bindValue(':nom',$_POST['lastname'],PDO::PARAM_STR);
$pdostat-> bindValue(':prenom',$_POST['firstname'] ,PDO::PARAM_STR);
$pdostat-> bindValue(':courriel',$_POST['mail'],PDO::PARAM_STR);
$pdostat-> bindValue(':adresse',$_POST['adress'],PDO::PARAM_STR);
$pdostat-> bindValue(':abonnement',$_POST['abonnée'],PDO::PARAM_STR);
$pdostat-> bindValue(':date_de_fin_abonnement',$_POST['expirer'],PDO::PARAM_STR);
$test = $pdostat->execute();

if($pdostat->errorCode()==23505 and  $pdostat->execute() == 0){
    echo 'Ce mail est déja utilisé.';
    echo  $test;
    exit();
};

if ($pdostat->execute() == 0) {

    echo"contact ajouter";?>
    <form action="connect.php " method="post">
		<p><input type ="submit" value="connecter vous"></p>
	</form><?php
    exit();
}

?>




	
