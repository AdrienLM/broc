
<?php

// a avoir en page au dessus pour que la page marche la varible $_SESSION['id'] 


//query

$idCompte = $_SESSION['id'];
//echo '$idCompte '.$idCompte.'  '.'<br />';

$requete = "SELECT idCompte FROM tabbestiaire WHERE idCompte = ".$idCompte;
//echo $requete;
$ifGrimoireExist = $pdo->query($requete);
$grimExiste = $ifGrimoireExist->fetch(PDO::FETCH_ASSOC);

//echo '<br />'.$grimExiste["idCompte"];


/*
//prepare
$idCompte = $_SESSION['id'];
$grimExiste = $pdo->prepare("SELECT idCompte FROM tabbestiaire WHERE idCompte = (idCompte) VALUES (:idCompte)");
$grimExiste->bindParam(':idCompte', $idCompte);
 echo '<br />'.$ifGrimoireExist.'';
$ifGrimoireExist = $grimExiste->execute();
 echo '<br />'.$ifGrimoireExist.'';
*/









if($grimExiste)
{
 //echo 'existe dans if ';
    
}else{
 //echo 'existe pas else';
    
//}

//if(1 == 1){
    
    $debugQWMain = false;
    global $debugQWClass;
      $debugQWClass = false;


    function chargerClasse($classname)
    {
      require 'class/'.$classname.'.php';
    }

    spl_autoload_register('chargerClasse');

    //require 'connexionBDD.php';

    //valeur test à modifié par la id de la session
    //$idCompte = 1;
    
    //$idCompte = $_SESSION['id'];
    $managerTabBestiaire = new TabBestiaireManage($pdo);   // creation de la gestion des Bestaire
    //$managerTabBestiaire->deleteAll();

    $managerTabHerbier = new TabHerbierManage($pdo);   // creation de la gestion des herbier
    //$managerTabHerbier->deleteAll();

    $managerTabResume = new TabResumeManage($pdo);   // creation de la gestion des Resume
    //$managerTabResume->deleteAll();

    // Ajout du nouveau idCompte en tant ligne à la table 
    $managerTabBestiaire->add($idCompte);
    $managerTabHerbier->add($idCompte);
    $managerTabResume->add($idCompte);

    // Pour test création d'un état du jeux bidon pour le test
    //$EtatstickBestaire[1]='1';
    //$EtatstickHerbier[1]='1';
    //$EtatResume[1]='1';
        for($i=1;$i<=3;$i++) {
            $EtatstickBestaire[$i]='0';
            $EtatstickHerbier[$i]='0';
            $EtatResume[$i]='0';
    }
    //en attendant le mise a jour de plus de trois histoire.
    for($i=4;$i<=5;$i++) {
            $EtatstickBestaire[$i]='1';
            $EtatstickHerbier[$i]='1';
            $EtatResume[$i]='1';
    }

    // Mise à jour de la ligne idCompte de la table 
    $managerTabBestiaire->updates($idCompte,$EtatstickBestaire);
    $managerTabHerbier->updates($idCompte,$EtatstickHerbier);
    $managerTabResume->updates($idCompte,$EtatResume);

    if($debugQWMain) var_dump($managerTabBestiaire->getEtatSticks($idCompte));
    if($debugQWMain) var_dump($managerTabHerbier->getEtatSticks($idCompte));
    if($debugQWMain) var_dump($managerTabResume->getEtatResumes($idCompte));

}


?>
