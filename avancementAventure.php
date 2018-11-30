
<?php


    $idCompte = $_SESSION['id'];
    $debugQWMain = false;

        //echo '$idCompte '.$idCompte.'  '.'<br />';
        $requete = "SELECT AvancementUser FROM membres WHERE IdUser = ".$idCompte;
        if($debugQWMain) echo $requete;
        $ifAvancementUserExist = $pdo->query($requete);
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
                //header ('location: index.php');

            }
    }




            $requete = "SELECT AvancementUser FROM membres WHERE IdUser = ".$idCompte;
            if($debugQWMain) echo $requete;
            $ifAvancementUserExist = $pdo->query($requete);

            $AvancementUserExist = $ifAvancementUserExist->fetch(PDO::FETCH_ASSOC);
            if($debugQWMain) echo '<br />'.$AvancementUserExist["AvancementUser"];
    
    
    
  
    
        if(isset($_SESSION['AventureProv'])){

            $modifdata = $pdo->prepare('UPDATE membres SET AvancementUser= :numAvance WHERE IdUser= :idCompte');
                try
                {
                    $numAvancement = $_SESSION['AventureProv']+1;
                    //$modifdata->bindParam(':datedec', $_POST['datedec'], PDO:: PARAM_STR); // date
                    $modifdata->bindParam(':numAvance', $numAvancement, PDO:: PARAM_INT); // entier
                    $modifdata->bindParam(':idCompte', $idCompte, PDO:: PARAM_INT); // entier
                    $modifdata->execute();
                    //header ('location: avancementAventure.php');

                }
                catch ( Exception $e )
                {

                    if($debugQWMain) echo 'Erreur de requête : ', $e->getMessage();
                    //header ('location: index.php');

                }
        
    }




            if($AvancementUserExist["AvancementUser"] >= 0)
            { 
                //re vérif que ou estlejoueur
                
                
                 $requete = "SELECT AvancementUser FROM membres WHERE IdUser = ".$idCompte;
            if($debugQWMain) echo $requete;
            $ifAvancementUserExist = $pdo->query($requete);

            $AvancementUserExist = $ifAvancementUserExist->fetch(PDO::FETCH_ASSOC);
            if($debugQWMain) echo '<br />'.$AvancementUserExist["AvancementUser"];
                
                
                
                
                
                

                if($debugQWMain) echo '<br />deuxième boucle > 0';

                ///////////////////////////redirection avanture/////////////
                if($AvancementUserExist["AvancementUser"] == 1){
                        if($debugQWMain) echo '<br />'.'aventure 1';
                     //echo 'header (location: page1.php)';
                    header ('location: arbreOrA.php');
                }else if($AvancementUserExist["AvancementUser"] == 2){
                        if($debugQWMain) echo '<br />'.'aventure 2';
                    //echo 'header (location: tombeauMerlinA.php)';
                    header ('location: tombeauMerlinA.php');
                }else if($AvancementUserExist["AvancementUser"] == 3){
                        if($debugQWMain) echo '<br />'.'aventure 3';
                    header ('location: soon.php');
                    //echo 'header (location: page3.php)'.'page pas encore présente dévelopement';
                    //header ('location: page3.php');
                }
                else{
                    //echo '<br />'.'aventure pas encore présente';
                    //header ('location: index.php');
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