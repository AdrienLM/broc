<?php

function chargerClasse($classname)
{
  require 'class/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');

require 'connexionBDD.php';

$manager = new ResumeManage($pdo);   // creation de la gestion des Resume
$manager->deleteAll();


$Resume[1] = new Resume([
  'nom' => 'Le chêne à Guillotin',
  'image' => 'images/imageresume1.png',
  'description' => 'Ce chêne majestueux et quasi millénaire se situe en bordure de la voie menant à Tréhorenteuc. On raconte qu’un abbé traqué par les sans-culottes s’est caché à l’intérieur de l’arbre.',
  'position' => 1,
  'imageUnlock' => 'images/imageresume1Unlock.png',
  ]);


$manager->add($Resume[1]);	// Ajout d'une Resume



$Resume[2] = new Resume([
  'nom' => 'Hôtié de Viviane',
  'image' => 'images/imageresume2.png',
  'description' => 'L’Hôtié de Viviane est un coffre funéraire se trouvant à l’est du Val sans retour. Ce serait la demeure de la fée Viviane où elle retiendrait Merlin dans une prison d’air. Auparavant, le monument était situé près du tombeau de Merlin.',
  'position' => 2,
  'imageUnlock' => 'images/imageresume2Unlock.png',
  ]);


$manager->add($Resume[2]);	// Ajout d'une Resume



$Resume[3] = new Resume([
  'nom' => 'Menhirs de Monteneuf',
  'image' => 'images/imageresume3.png',
  'description' => 'Les Menhirs de Monteneuf est un site archéologique composé de 443 menhirs. Tous les menhirs ont été décrits, photographiés puis photographiés. Le site peut être visité par le biais d’un sentier de découverte.',
  'position' => 3,
  'imageUnlock' => 'images/imageresume3Unlock.png',
  ]);


$manager->add($Resume[3]);	// Ajout d'une Resume



$Resume[4] = new Resume([
  'nom' => 'A Venir',
  'image' => 'images/aVenir.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
  'position' => 4,
  'imageUnlock' => 'images/aVenir.png',
  ]);


$manager->add($Resume[4]);	// Ajout d'une Resume



$Resume[5] = new Resume([
  'nom' => 'A Venir',
  'image' => 'images/aVenir.png',
  'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
  'position' => 5,
  'imageUnlock' => 'images/aVenir.png',
  ]);


$manager->add($Resume[5]);	// Ajout d'une Resume


var_dump($manager->getList());  // liste des Resume;



?>
