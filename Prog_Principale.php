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

 try
{
	// On se connecte à la base de donnée
	$bdd = new PDO('mysql:host=localhost;dbname=kleiz;charset=utf8', 'root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

/*****************************/
/* Ajout du compte à la base */
/*****************************/

$idCompte=1;  // valeur fixée pour le test
$managerTabBestiaire = new TabBestiaireManage($bdd);  // Connexion à la bdd
$managerTabHerbier = new TabHerbierManage($bdd);  // Connexion à la bdd
$managerTabResume = new TabResumeManage($bdd);  // Connexion à la bdd
//if(!$managerTabBestiaire->add($idCompte)) echo 'cette id existe déjà'.'<br>';            // Ajout d'une ligne pour le compte $idCompte
//else echo 'nouvelle table Bestaire créé avec succès'.'<br>';
$managerBestiaire = new BestiaireManage($bdd);
$managerHerbier = new HerbierManage($bdd);
$managerResume = new ResumeManage($bdd);


$stickBestiaireCompte=$managerTabBestiaire->getEtatSticks($idCompte); // Récupération dans $stickBestiaireCompte[5] de l'état des sticks
if($debugQWMain) var_dump($stickBestiaireCompte[1]); // Etat du stick 1 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[2]); // Etat du stick 2 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[3]); // Etat du stick 3 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[4]); // Etat du stick 4 Bestiaire
if($debugQWMain) var_dump($stickBestiaireCompte[5]); // Etat du stick 5 Bestiaire

$stickHerbierCompte=$managerTabHerbier->getEtatSticks($idCompte); // Récupération dans $stickBestiaireCompte[5] de l'état des sticks
if($debugQWMain) var_dump($stickHerbierCompte[1]);  // Etat du stick 1 Herbier

$ResumeResumeCompte=$managerTabResume->getEtatResumes($idCompte); // Récupération dans $stickBestiaireCompte[5] de l'état des sticks
if($debugQWMain) var_dump($ResumeResumeCompte[1]);  // Etat du Resume 1

// Selon l'état des sticks on range les tableaux à afficher */
for($i=1;$i<=5;$i++) 
{ 
  if((bool)$stickHerbierCompte[$i]) 
    { 
      $nomHerbier[$i]=$managerHerbier->get($idCompte)->nom(); 
      $imageHerbier[$i]=$managerHerbier->get($idCompte)->imageUnlock(); 
      $descriptionHerbier[$i]=$managerHerbier->get($idCompte)->description(); 
      $positionHerbier[$i]=$managerHerbier->get($idCompte)->position(); 
    }
  else 
    {
      $nomHerbier[$i]='';
      $imageHerbier[$i]=$managerHerbier->get($idCompte)->image();
      $descriptionHerbier[$i]='';
      $positionHerbier[$i]='';
    }

}

// Faire de même pour nomBestiaire en remplaçant Herbier par bestiaire et idem pour resume mais là pas de stick  mais resume
// ligne type ici $i est remplacé par 1 pour l'exemple
if((bool) $stickBestiaireCompte[1] ) $nomBestiaire[$i]=$managerBestiaire->get($idCompte)->nom(); else $nomBestiaire[1]='';
if((bool) $ResumeResumeCompte[1] ) $nomResume[$i]=$managerResume->get($idCompte)->nom(); else $nomResume[1]='';

?>


<body>
<!-- Affichage du cas Herbier -->
<p id="herbier_1">
<?php echo $nomHerbier[1] ?>
<img width="100" src=<?php echo '"'.$imageHerbier[1].'"' ?> /> 
<?php echo $descriptionHerbier[1] ?>
</p>
<p id="herbier_2">
<?php echo $nomHerbier[2] ?>
<img width="100" src=<?php echo '"'.$imageHerbier[2].'"' ?> /> 
<?php echo $descriptionHerbier[2] ?>
</p>
<p id="herbier_3">
<?php echo $nomHerbier[3] ?>
<img width="100" src=<?php echo '"'.$imageHerbier[3].'"' ?> /> 
<?php echo $descriptionHerbier[3] ?>
</p>
<p id="herbier_4">
<?php echo $nomHerbier[4] ?>
<img width="100" src=<?php echo '"'.$imageHerbier[4].'"' ?> /> 
<?php echo $descriptionHerbier[4] ?>
</p>
<p id="herbier_5">
<?php echo $nomHerbier[5] ?>
<img width="100" src=<?php echo '"'.$imageHerbier[5].'"' ?> /> 
<?php echo $descriptionHerbier[5] ?>
</p>


</body>
