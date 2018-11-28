<?php

$idCompte = $_SESSION['id'];
$debugQWMain = false;

    //echo '$idCompte '.$idCompte.'  '.'<br />';
    $requete = "SELECT AvancementUser FROM membres WHERE IdUser = ".$idCompte;
    if($debugQWMain) echo $requete;
    $ifAvancementUserExist = $pdo->query($requete);
    //echo ''.$ifAvancementUserExist.'';
    $AvancementUserExist = $ifAvancementUserExist->fetch(PDO::FETCH_ASSOC);
    if($debugQWMain) echo '<br />'.$AvancementUserExist["AvancementUser"];



if($AvancementUserExist["AvancementUser"] != null)
{   
    if($debugQWMain) echo '<br />'.'existe dans if ';
}else{
    if($debugQWMain) echo '<br />'.'existe pas else';
    
    $modifdata = $pdo->prepare('UPDATE membres SET AvancementUser= :numAvance WHERE IdUser= :idCompte');
try
{
    $numAvancement = 1;
	//$modifdata->bindParam(':datedec', $_POST['datedec'], PDO:: PARAM_STR); // date
	$modifdata->bindParam(':numAvance', $numAvancement, PDO:: PARAM_INT); // entier
	$modifdata->bindParam(':idCompte', $idCompte, PDO:: PARAM_INT); // entier
	$modifdata->execute();
	//header ('location: avancementAventure.php');
}
catch ( Exception $e )
{
	if($debugQWMain) echo 'Erreur de requête : ', $e->getMessage();
    //header ('location: accueil.php');
}

    
    
    $requete = "SELECT AvancementUser FROM membres WHERE IdUser = ".$idCompte;
    if($debugQWMain) echo $requete;
    $ifAvancementUserExist = $pdo->query($requete);
    if($debugQWMain) echo ''.$ifAvancementUserExist.'';
    $AvancementUserExist = $ifAvancementUserExist->fetch(PDO::FETCH_ASSOC);
    if($debugQWMain) echo '<br />'.$AvancementUserExist["AvancementUser"];
}
    
if($AvancementUserExist["AvancementUser"] > 0)
{ 
    
    if($debugQWMain) echo '<br />deuxième boucle > 0';
    
    if($AvancementUserExist["AvancementUser"] == 1){
        //redirection première
    }
    
    
/*
$initAvance = $pdo->prepare("UPDATE AvancementUser SET numAvance = 'numDeAvance' WHERE idCompte = (idCompte) VALUES (:idCompte)");
$initAvance->bindParam(':idCompte', $idCompte);
$initAvance->bindParam(':idCompte', $idCompte);  
 echo '<br />'.$ifGrimoireExist.'';
$ifGrimoireExist = $grimExiste->execute();
 echo '<br />'.$ifGrimoireExist.'';
*/
    
    
}

?>