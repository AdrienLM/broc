<?php

session_start();
require 'connexionBDD.php';

$debugQWMain = false;

if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
	$getid = intval($_SESSION['id']);
	$requser = $pdo->prepare('SELECT * FROM membres WHERE IdUser = ?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch(PDO::FETCH_ASSOC);   
    $_SESSION['val1'] = 0;

   // require ' initCompteGrimoire.php';
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>KLEIZ | FONTAINE DE BARENTON | MODE DÉCOUVERTE</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleDecouverte.css">
        <link rel="stylesheet" href="css/styleMenuDecouverte.css">
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
    </head>
    <body>
        <?php require 'headerDecouverte.php'; ?>

        <main id="fontaineBarenton">
            <div class="partGauche">
                <a href="index.php"><img src="images/logo.png" alt="logo Kleiz" id="logo"></a>
                <div>
                    <h1>UNE SOURCE D’EAU NATURELLE AU CŒUR DE LA FORÊT</h1>
                    <div class="avis">
                        <p>Forêt de Paimpont</p>
                        <p>Avis visiteurs (12)</p>
                    </div>
                </div>
                <p class="desc">Viviane et Merlin se sont rencontrés près de cette fontaine. Merlin avait pris l’apparence d’un bel écuyer et donna à Viviane sa première leçon de magie. Depuis, les femmes se rendent à la fontaine pour faire le voeu de se marier. Si des bulles apparaissent, elles seront mariées avant Pâques.</p>
                <h2>fontaine de</h2>
                <h3>Barenton</h3>
                <img src="images/boussole.png" alt="boussole" class="imageFond">
                <p class="pied">KLEIZ | Projet MMI2 2018-2019</p>
                <img src="images/coeur.png" alt="coeur" class="coeur">
            </div>
            <div class="partDroite">
                <img src="images/fontaineBarenton.jpg" alt="fontaine de Barenton">
                <div></div>
                <img src="images/carteFontaineBarentonD.svg" alt="carte de Brocéliande" class="carte">
            </div>
            <div>
                <p>Retour</p>
                <a href="tombeauMerlin.php">
                    <img src="images/flecheG.svg" alt="flèche vers la gauche">
                </a>
            </div>
            <div>
                <p>Suivant</p>
                <a href="chateauTrecesson.php">
                    <img src="images/flecheG.svg" alt="flèche vers la droite">
                </a>
            </div>
        </main>
        <?php require 'footerDecouverte.php'; ?>
    </body>
</html>