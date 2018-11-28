<?php

$idCompte = $_SESSION['id'];
//echo '$idCompte '.$idCompte.'  '.'<br />';

$requete = "SELECT AvancementUser FROM membres WHERE idCompte = ".$idCompte;
//echo $requete;
$ifAvancementUserExist = $pdo->query($requete);
$AvancementUserExist = $ifAvancementUserExist->fetch(PDO::FETCH_ASSOC);



if($AvancementUserExist)
{
 echo 'existe dans if ';
    
}else{
 echo 'existe pas else';
    
}

?>