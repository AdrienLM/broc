<?php

function chargerClasse($classname)
{
  require 'class/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');

 try
{
	// On se connecte à la base de donnée
    require("param.inc.php");
	$bdd = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
    $bdd ->query("SET NAMES utf8");
    $bdd ->query("SET CHARACTER SET 'utf-8'");
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



$Bestiaire[2] = new Bestiaire([  // mise en mémoire de l'instant $Bestiaire[2]
  'nom' => 'Taureau',
  'image' => 'images/taureau.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 2,
  'imageUnlock' => 'images/taureauUnlock.png',
  ]);


$manager->add($Bestiaire[2]);	// Ajout d'une Bestaire dans la table de la bdd



$Bestiaire[3] = new Bestiaire([  // mise en mémoire de l'instant $Bestiaire[3]
  'nom' => 'Taureau',
  'image' => 'images/taureau.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 3,
  'imageUnlock' => 'images/taureauUnlock.png',
  ]);


$manager->add($Bestiaire[3]);	// Ajout d'une Bestaire dans la table de la bdd



$Bestiaire[4] = new Bestiaire([  // mise en mémoire de l'instant $Bestiaire[4]
  'nom' => 'Taureau',
  'image' => 'images/taureau.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 4,
  'imageUnlock' => 'images/taureauUnlock.png',
  ]);


$manager->add($Bestiaire[4]);	// Ajout d'une Bestaire dans la table de la bdd



$Bestiaire[5] = new Bestiaire([  // mise en mémoire de l'instant $Bestiaire[5]
  'nom' => 'Taureau',
  'image' => 'images/taureau.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 5,
  'imageUnlock' => 'images/taureauUnlock.png',
  ]);


$manager->add($Bestiaire[5]);	// Ajout d'une Bestaire dans la table de la bdd


var_dump($manager->getList());  // list des Bestaire;



?>
