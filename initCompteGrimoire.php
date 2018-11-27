
<?php
$debugQWMain = false;
global $debugQWClass;
  $debugQWClass = false;


function chargerClasse($classname)
{
  require 'class/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');

require 'connexionBDD.php';

$idCompte=1;
$managerTabBestiaire = new TabBestiaireManage($pdo);   // creation de la gestion des Bestaire
$managerTabBestiaire->deleteAll();

$managerTabHerbier = new TabHerbierManage($pdo);   // creation de la gestion des herbier
$managerTabHerbier->deleteAll();

$managerTabResume = new TabResumeManage($pdo);   // creation de la gestion des Resume
$managerTabResume->deleteAll();

/* Ajout du nouveau idCompte en tant ligne à la table */
$managerTabBestiaire->add($idCompte);
$managerTabHerbier->add($idCompte);
$managerTabResume->add($idCompte);

// Pour test création d'un état du jeux bidon pour le test
//$EtatstickBestaire[1]='1';
//$EtatstickHerbier[1]='1';
//$EtatResume[1]='1';
    for($i=1;$i<=5;$i++) {
        $EtatstickBestaire[$i]='0';
        $EtatstickHerbier[$i]='0';
        $EtatResume[$i]='0';
}

/* Mise à jour de la ligne idCompte de la table */
$managerTabBestiaire->updates($idCompte,$EtatstickBestaire);
$managerTabHerbier->updates($idCompte,$EtatstickHerbier);
$managerTabResume->updates($idCompte,$EtatResume);

if($debugQWMain) var_dump($managerTabBestiaire->getEtatSticks($idCompte));
if($debugQWMain) var_dump($managerTabHerbier->getEtatSticks($idCompte));
if($debugQWMain) var_dump($managerTabResume->getEtatResumes($idCompte));
 

?>