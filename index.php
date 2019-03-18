<?php

session_start();
require 'connexionBDD.php';
unset($_SESSION['aventureSur']);
unset($_SESSION['antiRep']);
unset($_SESSION['AventureProv']);


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
        <title>KLEIZ | ACCUEIL</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/styleMenu.css">
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
        <link rel="icon" type="image/png" sizes="192x192" href="images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="images/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#837474">
        <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

    </head>

    <body>
        <!-- Loading -->
        <div class="loading">
            <div class="barre"></div>
            <img src="images/logoEtNomB.png" alt="logo Kleiz" class="logoVerti">
            <h1 class="loading-title">CHARGEMENT</h1>
            <p class="loading-title2">BETA V.1.0</p>
            <div class="loading-progress"></div>
            <div class="barreBas"></div>
        </div>
        
        
        
        <div class="fullscreen-bg">
            <video loop muted autoplay poster="video/cover.png" class="fullscreen-bg__video">
        <source src="videos/cover.webm" type="video/webm">
        <source src="videos/cover.mp4" type="video/mp4">
        <source src="videos/cover.ogv" type="video/ogg">
    </video>
        </div>
        <?php require 'header.php'; require 'initCompteGrimoire.php'; ?>


        <main>
            <h1>Les legendes de <br><span>Broceliande</span></h1>
            <p>Découvrez la forêt de Brocéliande à travers ses légendes, ses histoires et ses secrets. Informez-vous, partez à la quête du Graal ou découvrez des créatures fantastiques. A chacun son mode et sa façon de vivre l'aventure.</p>




            <a href="choixModes.php">découvrir &nbsp; &nbsp; &nbsp; &rarr;</a>
        </main>
        <footer>
            <p>KLEIZ | Projet MMI2 2018-2019</p>
            <div>
                <a href="soon.php">Plan du site</a>
                <a href="cgu.php">Conditions d'utilisation</a>
                <a href="soon.php">Notre équipe</a>
            </div>
            <div class="reseaux">
                <a href="https://www.facebook.com/kleiz3" target="_blank">
                   <img src="images/facebook.svg" alt="logo Facebook">
               </a>
                <a href="https://twitter.com/Kleizbro" target="_blank">
                   <img src="images/twitter.svg" alt="logo Twitter">
               </a>
                <a href="https://www.instagram.com/kleiz3" target="_blank">
                   <img src="images/instagram.svg" alt="logo Instagram">
               </a>
                <a href="images/snapchat.jpg" target="_blank">
                   <img src="images/snapchat.svg" alt="logo Snapchat">
               </a>
            </div>
        </footer>
        <script src="js/jquery.js"></script>
        <script src="js/scriptMenuFlottant.js"></script>



        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>



        <script src="js/index.js"></script>


    </body>

    </html>

    <?php


?>
