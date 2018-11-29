<?php

 








    if($boolAventureUp == true){
       
        
        
        $idCompte = $_SESSION['id'];
        $debugQWMain = true;

    //echo '$idCompte '.$idCompte.'  '.'<br />';
    $requete = "SELECT AvancementUser FROM membres WHERE IdUser = ".$idCompte;
        if($debugQWMain) echo $requete;
    $ifAvancementUserExist = $pdo->query($requete);
    $AvancementUserExist = $ifAvancementUserExist->fetch(PDO::FETCH_ASSOC);
        if($debugQWMain) echo '<br />'.$AvancementUserExist["AvancementUser"];


        
        $numAvancementUp = $AvancementUserExist["AvancementUser"] + 1;
            if($debugQWMain) echo '<br />'.$numAvancementUp.' ';
        
        $modifdata = $pdo->prepare('UPDATE membres SET AvancementUser= :numAvance WHERE IdUser= :idCompte');
        try
        {
          
            $modifdata->bindParam(':numAvance', $numAvancementUp, PDO:: PARAM_INT); // entier
            $modifdata->bindParam(':idCompte', $idCompte, PDO:: PARAM_INT); // entier
            $modifdata->execute();
            //header ('location: avancementAventure.php');
              if($debugQWMain) echo '<br /> requete envoyer ';
            
            $boolAventureUp = false;

        }
        catch ( Exception $e )
        {

            if($debugQWMain) echo 'Erreur de requête : ', $e->getMessage();
            //header ('location: accueil.php');

        }
}


?>