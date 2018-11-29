<?php
/*
function chargerClasse($classname)
{
  require 'class/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');

require 'connexionBDD.php';
*/
if

        $idCompte = $_SESSION['id'];
        $requete = "SELECT isAdmin FROM membres WHERE IdUser = ".$idCompte;
        $isAdmin = $pdo->query($requete);
        $repAdmin = $isAdmin->fetch(PDO::FETCH_ASSOC);



if($repAdmin['isAdmin'] == 1){
    
        $manager = new HerbierManage($pdo);   // creation de la gestion des Herbiers pour la table de la pdo
        $manager->deleteAll();

        $Herbier[1] = new Herbier([   // Mise en mémoire de l'instant 
          'nom' => 'Feuille d\'or',
          'image' => 'images/feuille1Or.png',
          'description' => 'Les feuilles d’or apparaissent chaque nuit sur les branches de l’arbre d’or. Les lutins venaient chaque matin le récolter pour leurs propriétés magiques. Cette potion permettrait notamment de ramener à la vie les arbres meurtris.',
          'position' => 1,
          'imageUnlock' => 'images/feuille1OrUnlock.png',
          ]);


        $manager->add($Herbier[1]);	// Ajout d'une Herbier



        $Herbier[2] = new Herbier([
          'nom' => 'Fougère',
          'image' => 'images/fougerre.png',
          'description' => 'L’Osmonde royale est une fougère que l’on peut trouver en abondance en Bretagne. Ses plus grandes feuilles peuvent former des touffes jusqu’à deux mètres. Elle tient son nom de l’histoire d’Osmund le batelier et de sa famille, sauvés durant l’invasion danoise en se cachant dans ses feuilles.',
          'position' => 2,
          'imageUnlock' => 'images/fougerreUnlock.png',
          ]);


        $manager->add($Herbier[2]); // Ajout d'une Herbier



        $Herbier[3] = new Herbier([
          'nom' => 'Gentiane',
          'image' => 'images/gentiane.png',
          'description' => 'Les gentianes sont des fleurs sauvages vivaces et rustiques. Étant principalement des fleurs de montagne, elles poussent dans les endroits frais. La gentiane offre de nombreux bienfaits, c’est un tonifiant efficace qui prévient le vieillissement et maintient le bon état du système immunitaire.',
          'position' => 3,
          'imageUnlock' => 'images/gentianeUnlock.png',
          ]);


        $manager->add($Herbier[3]); // Ajout d'une Herbier



        $Herbier[4] = new Herbier([
          'nom' => 'A venir',
          'image' => 'images/aVenir.png',
          'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
        aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          'position' => 4,
          'imageUnlock' => 'images/aVenir.png',
          ]);


        $manager->add($Herbier[4]); // Ajout d'une Herbier



        $Herbier[5] = new Herbier([
          'nom' => 'A venir',
          'image' => 'images/aVenir.png',
          'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna 
        aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
          'position' => 5,
          'imageUnlock' => 'images/aVenir.png',
          ]);


        $manager->add($Herbier[5]); // Ajout d'une Herbier




        var_dump($manager->getList());  // liste des Herbier;


}else{
    header('Location: index.php');
}



?>
