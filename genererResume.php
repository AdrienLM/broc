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
$manager = new ResumeManage($bdd);   // creation de la gestion des Resume
$manager->deleteAll();


$Resume[1] = new Resume([
  'nom' => 'Korrigan',
  'image' => 'images/korrigan.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 1,
  'imageUnlock' => 'images/korriganUnlock.png',
  ]);


$manager->add($Resume[1]);	// Ajout d'une Resume



$Resume[2] = new Resume([
  'nom' => 'Korrigan',
  'image' => 'images/korrigan.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 2,
  'imageUnlock' => 'images/korriganUnlock.png',
  ]);


$manager->add($Resume[2]);	// Ajout d'une Resume



$Resume[3] = new Resume([
  'nom' => 'Korrigan',
  'image' => 'images/korrigan.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 3,
  'imageUnlock' => 'images/korriganUnlock.png',
  ]);


$manager->add($Resume[3]);	// Ajout d'une Resume



$Resume[4] = new Resume([
  'nom' => 'Korrigan',
  'image' => 'images/korrigan.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 4,
  'imageUnlock' => 'images/korriganUnlock.png',
  ]);


$manager->add($Resume[4]);	// Ajout d'une Resume



$Resume[5] = new Resume([
  'nom' => 'Korrigan',
  'image' => 'images/korrigan.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
, sunt in culpa qui officia deserunt mollit anim id est laborum',
  'position' => 5,
  'imageUnlock' => 'images/korriganUnlock.png',
  ]);


$manager->add($Resume[5]);	// Ajout d'une Resume


var_dump($manager->getList());  // liste des Resume;



?>
