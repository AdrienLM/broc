<?php
session_start();
require 'connexionBDD.php';

$debugQWMain = false;





if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
	$getid = intval($_SESSION['id']);
	$requser = $pdo->prepare('SELECT * FROM membres WHERE IdUser = ?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch(PDO::FETCH_ASSOC);
    $_SESSION['val1'] = 0;



if($debugQWMain == true){

        $_SESSION['aventureSur'] = 1;
        $_SESSION['antiRep'] = 1;
        //$_SESSION['AventureProv'] = 1;
       // $_SESSION['addStick1'] = 311;
       //  $_SESSION['addStick2'] = 211;

}




?>

<?php

    if(isset($_SESSION['AventureProv'])){


        if($_SESSION['antiRep'] == 1){

            if($_SESSION['aventureSur'] == 1){
                    echo '      dans if aventure sur        ';
                    //echo 'debut';
                    //var_dump($debugQWClass) ;



                    $avantureProv =  $_SESSION['AventureProv'];

                    if($avantureProv == 1){
                        $_SESSION['addStick1'] = 211;
                        $_SESSION['addStick2'] = 311;

                    }else if($avantureProv == 2){
                        $_SESSION['addStick1'] = 221;
                        $_SESSION['addStick2'] = 321;

                    }else if($avantureProv == 3){
                        $_SESSION['addStick1'] = 231;
                        $_SESSION['addStick2'] = 331;

                    }


                    //$idCompte = 1;



                    $codeGrimoire = $_SESSION['addStick1'];
                    require 'updateAventureGrimoire.php';
                     $codeGrimoire = $_SESSION['addStick2'];
                    require 'updateAventureGrimoire.php';

                    $_SESSION['antiRep'] = 0;
                    $boolAventureUp = true;
                    require 'avancementAventure.php';

                }else{
                     echo ' dans else ';


                     $_SESSION['antiRep'] = 0;
                     $boolAventureUp = true;
                    require 'avancementAventure.php';
                }

            }else{
                header('Location: CheminAventure.php');
                //redirection page choix mode ou accueil a voir
            }

    }else{
        header('Location: CheminAventure.php');
      //  require 'avancementAventure.php';

    }
?>

 <?php
}else{
    header('Location: CheminAventure.php');
}

?>
