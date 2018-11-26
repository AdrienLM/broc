
<?php
$debugQWMain = false;
global $debugQWClass;
  $debugQWClass = false;


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

$idCompte=1;
$managerTabBestiaire = new TabBestiaireManage($bdd);   // creation de la gestion des Bestaire
$managerTabBestiaire->deleteAll();

$managerTabHerbier = new TabHerbierManage($bdd);   // creation de la gestion des herbier
$managerTabHerbier->deleteAll();

$managerTabResume = new TabResumeManage($bdd);   // creation de la gestion des Resume
$managerTabResume->deleteAll();

/* Ajout du nouveau idCompte en tant ligne à la table */
$managerTabBestiaire->add($idCompte);
$managerTabHerbier->add($idCompte);
$managerTabResume->add($idCompte);

// Pour test création d'un état du jeux bidon pour le test
$EtatstickBestaire[1]='1';
$EtatstickHerbier[1]='1';
$EtatResume[1]='1';
for($i=2;$i<=5;$i++) {
$EtatstickBestaire[$i]='0';
$EtatstickHerbier[$i]='0';
$EtatResume[$i]='0';
}

/* Mise à jour de la ligne idCompte de la table */
$managerTabBestiaire->updates($idCompte,$EtatstickBestaire);
$managerTabHerbier->updates($idCompte,$EtatstickHerbier);
$managerTabResume->updates($idCompte,$EtatResume);

var_dump($managerTabBestiaire->getEtatSticks($idCompte));
var_dump($managerTabHerbier->getEtatSticks($idCompte));
var_dump($managerTabResume->getEtatResumes($idCompte));
 

?>
