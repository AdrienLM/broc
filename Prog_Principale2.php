<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
        <title class="titre">EXEMPLE</title>
  </head>




<?php
$debugQWMain = false;
global $debugQWClass;
  $debugQWClass = false;

  //phpinfo();

//echo 'debut';
//var_dump($debugQWClass) ;


function chargerClasse($classname)
{
  require 'class/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');

require 'connexionBDD.php';

/*****************************/
/* Ajout du compte à la base */
/*****************************/

$idCompte=1;  // valeur fixée pour le test//mettre le IdUser
$managerTabBestiaire = new TabBestiaireManage($pdo);  // Connexion à la pdo
$managerTabHerbier = new TabHerbierManage($pdo);  // Connexion à la pdo
$managerTabResume = new TabResumeManage($pdo);  // Connexion à la pdo
//if(!$managerTabBestiaire->add($idCompte)) echo 'cette id existe déjà'.'<br>';            // Ajout d'une ligne pour le compte $idCompte
//else echo 'nouvelle table Bestaire créé avec succès'.'<br>';
$managerBestiaire = new BestiaireManage($pdo);
$managerHerbier = new HerbierManage($pdo);
$managerResume = new ResumeManage($pdo);


$stickBestiaireCompte=$managerTabBestiaire->getEtatSticks($idCompte); // Récupération dans $stickBestiaireCompte[5] de l'état des sticks
if($debugQWMain) var_dump($stickBestiaireCompte[1]); // Etat du stick 1 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[2]); // Etat du stick 2 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[3]); // Etat du stick 3 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[4]); // Etat du stick 4 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[5]); // Etat du stick 5 Bestiaire

//$stickHerbierCompte=$managerTabHerbier->getEtatSticks($idCompte); // Récupération dans $stickBestiaireCompte[5] de l'état des sticks
//if($debugQWMain) var_dump($stickHerbierCompte[1]);  // Etat du stick 1 Herbier

//$stickBestiaireCompte=$managerTabBestiaire->getEtatSticks($idCompte); // Récupération dans $stickBestiaireCompte[5] de l'état des sticks
//if($debugQWMain) var_dump($stickBestiaireCompte[1]);  // Etat du stick 1 Herbier

//$ResumeResumeCompte=$managerTabResume->getEtatResumes($idCompte); // Récupération dans $stickBestiaireCompte[5] de l'état des sticks
//if($debugQWMain) var_dump($ResumeResumeCompte[1]);  // Etat du Resume 1

// Selon l'état des sticks on range les tableaux à afficher */
    
    
    
/////////////////////////////////////////////////////CAS HERBIER////////////////////////////////////////////////////////////////////
    
$stickHerbierCompte=$managerTabHerbier->getEtatSticks($idCompte); // Récupération dans $stickBestiaireCompte[5] de l'état des sticks
//if($debugQWMain) var_dump($stickHerbierCompte[1]);  // Etat du stick 1 Herbier
    
for($i=1;$i<=5;$i++) 
{ 
  if((bool)$stickHerbierCompte[$i]) 
    { 
      $nomHerbier[$i]=$managerHerbier->get($i)->nom(); 
      $imageHerbier[$i]=$managerHerbier->get($i)->imageUnlock(); 
      $descriptionHerbier[$i]=$managerHerbier->get($i)->description(); 
      $positionHerbier[$i]=$managerHerbier->get($i)->position(); 
        
      //  var_dump($stickHerbierCompte[$i]);
      //  var_dump($i);
       
    }
  else 
    {
      $nomHerbier[$i]='???';
      $imageHerbier[$i]=$managerHerbier->get($i)->image();
      $descriptionHerbier[$i]='???';
      $positionHerbier[$i]=$managerHerbier->get($i)->position();
       //  var_dump($i);
        
       // var_dump($stickHerbierCompte[$i]);
   
    }

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////CAS BESTIAIRE///////////////////////////////////////////////////////////////////
    
$stickBestiaireCompte=$managerTabBestiaire->getEtatSticks($idCompte); // Récupération dans $stickBestiaireCompte[5] de l'état des sticks
//if($debugQWMain) var_dump($stickBestiaireCompte[1]);  // Etat du stick 1 Herbier
    
for($i=1;$i<=5;$i++) 
{ 
  if((bool)$stickBestiaireCompte[$i]) 
    { 
      $nomBestiaire[$i]=$managerBestiaire->get($i)->nom(); 
      $imageBestiaire[$i]=$managerBestiaire->get($i)->imageUnlock(); 
      $descriptionBestiaire[$i]=$managerBestiaire->get($i)->description(); 
      $positionBestiaire[$i]=$managerBestiaire->get($i)->position(); 
        
      //  var_dump($stickHerbierCompte[$i]);
      //  var_dump($i);
       
    }
  else 
    {
      $nomBestiaire[$i]='???';
      $imageBestiaire[$i]=$managerBestiaire->get($i)->image();
      $descriptionBestiaire[$i]='???';
      $positionBestiaire[$i]=$managerBestiaire->get($i)->position();
       //  var_dump($i);
        
       // var_dump($stickHerbierCompte[$i]);
   
    }

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  

    
/////////////////////////////////////////////////////CAS RESUME///////////////////////////////////////////////////////////////////
    
$ResumeResumeCompte=$managerTabResume->getEtatResumes($idCompte); // Récupération dans $stickBestiaireCompte[5] de l'état des sticks
//if($debugQWMain) var_dump($stickBestiaireCompte[1]);  // Etat du stick 1 Herbier
    
for($i=1;$i<=5;$i++) 
{ 
  if((bool)$ResumeResumeCompte[$i]) 
    { 
      $nomResume[$i]=$managerResume->get($i)->nom(); 
      $imageResume[$i]=$managerResume->get($i)->imageUnlock(); 
      $descriptionResume[$i]=$managerResume->get($i)->description(); 
      $positionResume[$i]=$managerResume->get($i)->position(); 
        
      //  var_dump($stickHerbierCompte[$i]);
      //  var_dump($i);
       
    }
  else 
    {
      $nomResume[$i]='???';
      $imageResume[$i]=$managerResume->get($i)->image();
      $descriptionResume[$i]='???';
      $positionResume[$i]=$managerResume->get($i)->position();
       //  var_dump($i);
        
       // var_dump($stickHerbierCompte[$i]);
   
    }

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
    

    
    
////////////////////////////////////////////////////////Débug//////////////////////////////////////////////////////////////////////// 
if($debugQWMain) var_dump($ResumeResumeCompte[1]); // Etat du resume 1 Résumé
if($debugQWMain) var_dump($ResumeResumeCompte[2]); // Etat du resume 1 Résumé
if($debugQWMain) var_dump($ResumeResumeCompte[3]); // Etat du resume 1 Résumé
if($debugQWMain) var_dump($ResumeResumeCompte[4]); // Etat du resume 1 Résumé
if($debugQWMain) var_dump($ResumeResumeCompte[5]); // Etat du resume 1 Résumé
    
if($debugQWMain) var_dump($stickHerbierCompte[1]); // Etat du stick 1 Herbier
if($debugQWMain) var_dump($stickHerbierCompte[2]); // Etat du stick 2 Herbier
if($debugQWMain) var_dump($stickHerbierCompte[3]); // Etat du stick 3 Herbier
if($debugQWMain) var_dump($stickHerbierCompte[4]); // Etat du stick 4 Herbier
if($debugQWMain) var_dump($stickHerbierCompte[5]); // Etat du stick 5 Herbier
    
if($debugQWMain) var_dump($stickBestiaireCompte[1]); // Etat du stick 1 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[2]); // Etat du stick 2 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[3]); // Etat du stick 3 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[4]); // Etat du stick 4 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[5]); // Etat du stick 5 Bestiaire
    
    
    
    
// Faire de même pour nomBestiaire en remplaçant Herbier par bestiaire et idem pour resume mais là pas de stick  mais resume
// ligne type ici $i est remplacé par 1 pour l'exemple

//if((bool) $stickBestiaireCompte[1] ) $nomBestiaire[$i]=$managerBestiaire->get($idCompte)->nom(); else $nomBestiaire[1]='';
//if((bool) $ResumeResumeCompte[1] ) $nomResume[$i]=$managerResume->get($idCompte)->nom(); else $nomResume[1]='';

?>


<body>
    <div>
        <?php ////Affichage Herbier////
        for($i=1;$i<=5;$i++) 
        { ?>
        
        <p id="herbier_<?php echo '"'.$i.'"' ?>">
        <?php echo $nomHerbier[$i] ?>
        <img width="100" src=<?php echo '"'.$imageHerbier[$i].'"' ?> /> 
        <?php echo $descriptionHerbier[$i] ?>
        </p>
       <?php } ?>
    </div>

    <div>
    
          <?php ////Affichage Herbier////
        for($i=1;$i<=5;$i++) 
        { ?>
        
        <p id="bestiaire_<?php echo '"'.$i.'"' ?>">
        <?php echo $nomBestiaire[$i] ?>
        <img width="100" src=<?php echo '"'.$imageBestiaire[$i].'"' ?> /> 
        <?php echo $descriptionBestiaire[$i] ?>
        </p>
       <?php } ?>
        

    </div>
    
    <div>
    
          <?php ////Affichage Herbier////
        for($i=1;$i<=5;$i++) 
        { ?>
        
        <p id="Resume_<?php echo '"'.$i.'"' ?>">
        <?php echo $nomResume[$i] ?>
        <img width="100" src=<?php echo '"'.$imageResume[$i].'"' ?> /> 
        <?php echo $descriptionResume[$i] ?>
        </p>
       <?php } ?>
        

    </div>


</body>