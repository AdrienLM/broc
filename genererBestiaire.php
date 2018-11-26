<?php

function chargerClasse($classname)
{
  require 'class/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');

 try
{
  // On se connecte à MySQL
  $bdd = new PDO('mysql:host=localhost;dbname=18mmi2pj02;charset=utf8', 'root', '');
}
catch(Exception $e)
{
  // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$manager = new BestiaireManage($bdd);   // creation de la gestion des bestiaires pour la table de la bdd
$manager->deleteAll();

$Bestiaire[1] = new Bestiaire([  // mise en mémoire de l'instant $Bestiaire[1]
  'nom' => 'Taureau',
  'image' => 'images/taureau.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 1,
  'imageUnlock' => 'images/taureauUnlock.png',
  ]);


$manager->add($Bestiaire[1]);	// Ajout d'une Bestaire dans la table de la bdd


var_dump($manager->getList());  // list des Bestaire;



?>
