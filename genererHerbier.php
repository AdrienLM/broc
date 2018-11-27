<?php

function chargerClasse($classname)
{
  require 'class/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');

require 'connexionBDD.php';

$manager = new HerbierManage($pdo);   // creation de la gestion des Herbiers pour la table de la pdo
$manager->deleteAll();

$Herbier[1] = new Herbier([   // Mise en mémoire de l'instant 
  'nom' => 'Fougère',
  'image' => 'images/fougerre.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 1,
  'imageUnlock' => 'images/fougerreUnlock.png',
  ]);


$manager->add($Herbier[1]);	// Ajout d'une Herbier



$Herbier[2] = new Herbier([
  'nom' => 'gantiane',
  'image' => 'images/gantiane.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 2,
  'imageUnlock' => 'images/gantianeUnlock.png',
  ]);


$manager->add($Herbier[2]); // Ajout d'une Herbier



$Herbier[3] = new Herbier([
  'nom' => 'gantiane',
  'image' => 'images/gantiane.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 3,
  'imageUnlock' => 'images/gantianeUnlock.png',
  ]);


$manager->add($Herbier[3]); // Ajout d'une Herbier



$Herbier[4] = new Herbier([
  'nom' => 'gantiane',
  'image' => 'images/gantiane.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 4,
  'imageUnlock' => 'images/gantianeUnlock.png',
  ]);


$manager->add($Herbier[4]); // Ajout d'une Herbier



$Herbier[5] = new Herbier([
  'nom' => 'gantiane',
  'image' => 'images/gantiane.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 5,
  'imageUnlock' => 'images/gantianeUnlock.png',
  ]);


$manager->add($Herbier[5]); // Ajout d'une Herbier




var_dump($manager->getList());  // liste des Herbier;



?>
