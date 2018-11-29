<?php
/*
function chargerClasse($classname)
{
  require 'class/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');

require 'connexionBDD.php';
*/


        $idCompte = $_SESSION['id'];
        $requete = "SELECT isAdmin FROM membres WHERE IdUser = ".$idCompte;
        $isAdmin = $pdo->query($requete);
        $repAdmin = $isAdmin->fetch(PDO::FETCH_ASSOC);



if($repAdmin['isAdmin'] == 1){


        $manager = new BestiaireManage($pdo);   // creation de la gestion des bestiaires pour la table de la pdo
        $manager->deleteAll();

        $Bestiaire[1] = new Bestiaire([  // mise en mémoire de l'instant $Bestiaire[1]
          'nom' => 'Lutin',
          'image' => 'images/lutin.png',
          'description' => 'Les lutins sont des êtres de petite taille réputés pour leur espièglerie. Très présent dans de nombreux récits et notamment dans la légende de l’arbre d’Or, il possède souvent divers dons tels que l’invisibilité ou la métamorphose. Il est parfois assimilé au Korrigan dans les légendes Bretonnes',
          'position' => 1,
          'imageUnlock' => 'images/lutinUnlock.png',
          ]);


        $manager->add($Bestiaire[1]);	// Ajout d'une Bestaire dans la table de la pdo



        $Bestiaire[2] = new Bestiaire([  // mise en mémoire de l'instant $Bestiaire[2]
          'nom' => 'Korrigan',
          'image' => 'images/korrigan.png',
          'description' => 'Les Korrigans ou “lutins Bretons” font partie du petit peuple de la forêt de Brocéliande avec les fées  ou encore les gnomes. Ils vivent cachés, en harmonie avec la nature et ont pour passe-temps favori de faire des farces aux humains. Ils hantent les sources, les landes et les fontaines.',
          'position' => 2,
          'imageUnlock' => 'images/korriganUnlock.png',
          ]);


        $manager->add($Bestiaire[2]);	// Ajout d'une Bestaire dans la table de la pdo



        $Bestiaire[3] = new Bestiaire([  // mise en mémoire de l'instant $Bestiaire[3]
          'nom' => 'Taureau',
          'image' => 'images/taureau.png',
          'description' => 'Ce Dieu Cornu apporta son aide à une petite fille de Saint-Lévy et se sacrifia pour la sauver. Elle lui construisit une tombe de pierres bleues où elle vient prier pour que le taureau exauce ses souhaits. On pourrait encore aujourd\'hui l\'apercevoir à genoux les soirs de pleine lune. ',
          'position' => 3,
          'imageUnlock' => 'images/taureauUnlock.png',
          ]);


        $manager->add($Bestiaire[3]);	// Ajout d'une Bestaire dans la table de la pdo



        $Bestiaire[4] = new Bestiaire([  // mise en mémoire de l'instant $Bestiaire[4]
          'nom' => 'A venir',
          'image' => 'images/aVenir.png',
          'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
        aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          'position' => 4,
          'imageUnlock' => 'images/aVenir.png',
          ]);


        $manager->add($Bestiaire[4]);	// Ajout d'une Bestaire dans la table de la pdo



        $Bestiaire[5] = new Bestiaire([  // mise en mémoire de l'instant $Bestiaire[5]
          'nom' => 'A venir',
          'image' => 'images/aVenir.png',
          'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
        aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          'position' => 5,
          'imageUnlock' => 'images/aVenir.png',
          ]);


        $manager->add($Bestiaire[5]);	// Ajout d'une Bestaire dans la table de la pdo


        var_dump($manager->getList());  // list des Bestaire;



}else{
    header('Location: index.php');
}






?>
