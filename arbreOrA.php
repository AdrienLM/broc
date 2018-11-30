<?php 
session_start();
require 'connexionBDD.php';



if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
	$getid = intval($_SESSION['id']);
	$requser = $pdo->prepare('SELECT * FROM membres WHERE IdUser = ?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch(PDO::FETCH_ASSOC);   
    $_SESSION['val1'] = 0;

           
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>KLEIZ | ARBRE D'OR | MODE AVENTURE</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleMenu.css">
        <link rel="stylesheet" href="css/styleAventure.css">
        <link rel="stylesheet" href="css/styleArbreOr.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
        <link rel="manifest" href="images/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <script src="js/jquery.js"></script>
        <script src="js/scriptMenuFlottant.js"></script>
        <script src="js/scriptArbreOr.js"></script>
        <script src="js/audio.js"></script>
    </head>
    <body>
        <?php require 'header.php';
            $_SESSION['aventureSur'] = 1;  
            $_SESSION['antiRep'] = 1;
            $_SESSION['AventureProv'] = 1;
        ?>
        <main>
            <div id="texte">
                <h2>Scene 2</h2>
                <h1>L'arbre d'or</h1>
                <audio id="playerAudioConteur">
                      <source src="./sons/aventureArbreOr.mp3">
                      <source src="./sons/aventureArbreOr.ogg">
                </audio>
                <p>Paramètres</p>
                <div id="param">
                    <div>
                        <img src="images/pleinEcran.svg" alt="icone plein écran">
                        <p>Plein écran</p>
                    </div>
                    <div>
                        <img src="images/flecheD.svg" alt="flèche vers la droite" class="decouvrir">
                        <p>Découvrir</p>
                    </div>
                    <div>
                        <a href="tombeauMerlinA.php"><img src="images/croix.svg" alt="croix"></a>
                        <p>Passer</p>
                    </div>
                </div>
            </div>
            <div id="carte">
                <h2>Localisation</h2>
                <p>Forêt de Paimpont</p>
                <img src="images/carteArbreOr" alt="carte de Brocéliande">
            </div>
            <div id="retour">
                <p>Retour</p>
                <a href="choixModes.php">
                    <img src="images/flecheG.svg" alt="flèche vers la gauche">
                </a>
            </div>
            <div id="jeu">
                <img src="images/arbreDOr.png" alt="arbre d'or" id="arbreOr">
                <img src="images/petiteFille.png" alt="petite fille" id="fille">
                <img src="images/tronc1.png" alt="tronc d'arbre calciné" id="arbre1">
                <img src="images/tronc2.png" alt="tronc d'arbre calciné" id="arbre2">
                <img src="images/tronc3.png" alt="tronc d'arbre calciné" id="arbre3">
                <img src="images/tronc4.png" alt="tronc d'arbre calciné" id="arbre4">
                <img src="images/feuilleOr.png" alt="feuille d'or" id="feuille1" class="feuilles">
                <img src="images/feuilleOr.png" alt="feuille d'or" id="feuille2" class="feuilles">
                <img src="images/feuilleOr.png" alt="feuille d'or" id="feuille3" class="feuilles">
                <img src="images/pierreLutin.png" alt="pierre" id="pierre1" class="pierres">
                <img src="images/pierreLutin.png" alt="pierre" id="pierre2" class="pierres">
                <img src="images/pierreLutin.png" alt="pierre" id="pierre3" class="pierres">
                <div id="narrateur">
                   <div>
                      <img src="images/casque.svg">
                       <h3>Narrateur</h3> 
                   </div> 
                   <p class="histoire">Dans une petite clairière près de Trehorenteuc, un arbre en or avait prit racine.<br><br> Chaque nuit les branches de cet arbre fabuleux s’ornaient de magnifiques feuilles d’or. <br><br>Les lutins de la forêt venaient chaque matin les récolter pour leurs propriétés magiques.</p>
                   <div>
                       <img src="images/flecheD.svg">
                       <p>Suivant</p>
                   </div>
                </div>
            </div>
        </main>
        <?php require 'footer.php'; ?>
    </body>
</html>


 <?php
}else{
    header('Location: connexion.php');
}

?>