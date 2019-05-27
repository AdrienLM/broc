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
                    //echo '      dans if aventure sur        ';
                    //echo 'debut';
                    //var_dump($debugQWClass) ;



                    $avantureProv =  $_SESSION['AventureProv'];

                    if($avantureProv == 1){
												//resumé anecdote
												$_SESSION['addStick1'] = 111;

												//herbier
												$_SESSION['addStick2'] = 221;
												$_SESSION['addStick3'] = 241;

												//bestiaire
												$_SESSION['addStick4'] = 321;
												$_SESSION['addStick5'] = 351;



												$codeGrimoire = $_SESSION['addStick1'];
												require 'updateAventureGrimoire.php';
											  $codeGrimoire = $_SESSION['addStick2'];
												require 'updateAventureGrimoire.php';
												$codeGrimoire = $_SESSION['addStick3'];
											 require 'updateAventureGrimoire.php';
											 $codeGrimoire = $_SESSION['addStick4'];
											 require 'updateAventureGrimoire.php';
											 $codeGrimoire = $_SESSION['addStick5'];
											 require 'updateAventureGrimoire.php';


                    }else if($avantureProv == 2){
											//resumé anecdote
											$_SESSION['addStick1'] = 121;

											//herbier
											$_SESSION['addStick2'] = 211;
											$_SESSION['addStick3'] = 251;

											//bestiaire
											$_SESSION['addStick4'] = 311;
											$_SESSION['addStick5'] = 341;


											$codeGrimoire = $_SESSION['addStick1'];
											require 'updateAventureGrimoire.php';
											$codeGrimoire = $_SESSION['addStick2'];
											require 'updateAventureGrimoire.php';
											$codeGrimoire = $_SESSION['addStick3'];
										 require 'updateAventureGrimoire.php';
										 $codeGrimoire = $_SESSION['addStick4'];
										 require 'updateAventureGrimoire.php';
										 $codeGrimoire = $_SESSION['addStick5'];
										 require 'updateAventureGrimoire.php';

										 
                    }else if($avantureProv == 3){


											//resumé anecdote
											$_SESSION['addStick1'] = 131;


											//herbier
											$_SESSION['addStick2'] = 231;


											//bestiaire
											$_SESSION['addStick3'] = 331;


											$codeGrimoire = $_SESSION['addStick1'];
											require 'updateAventureGrimoire.php';
											$codeGrimoire = $_SESSION['addStick2'];
											require 'updateAventureGrimoire.php';
											$codeGrimoire = $_SESSION['addStick3'];
										 require 'updateAventureGrimoire.php';


                    }


                    //$idCompte = 1;




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
