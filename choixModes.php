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
        <link rel="stylesheet" href="css/styleChoix.css">
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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <meta name="msapplication-TileColor" content="#837474">
        <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

    </head>

    <body id="choix">
        <div class="fullscreen-bg">
             <video loop muted autoplay poster="video/cover.png" class="fullscreen-bg__video">
                <source src="videos/cover.webm" type="video/webm">
                <source src="videos/cover.mp4" type="video/mp4">
                <source src="videos/cover.ogv" type="video/ogg">
            </video>
            <div></div>
        </div>
        <?php require 'header.php'; require 'initCompteGrimoire.php'; ?>
        <main>
            <?php
            if(isset($_SESSION['id']) AND $userinfo['IdUser'] == $_SESSION['id']) 
            {
            ?>
                <div id="decouverte">
               <a href="carte.php"> 
                   <div id="fondNoir"></div>
                    <h1>Mode<br><span>decouverte</span></h1> 
                    <p class="desc">Si vous souhaitez avoir des informations concises sur un lieu de votre choix, le mode Découverte est fait pour vous. Idéal lors des balades, vous pourrez découvrir la légende derrière chaque lieu en temps voulu.</p> 
                    <div> 
                        <img src="images/flecheDBlanc.svg"> 
                        <p>Découvrir</p> 
                    </div> 
               </a>
            </div> 
            <div id="aventure">
               <a href="cheminAventure.php"> 
                    <h1>Mode<br><span>aventure</span></h1> 
                    <p class="desc">Que vous soyez passionés par les légendes de Brocéliandes ou de simples curieux, le mode Aventure vous permettra de vivre ces récits de façon immersive et divertissante grâce au conteur.</p> 
                    <div> 
                        <img src="images/flecheDBlanc.svg">
                        <p>Découvrir</p> 
                    </div> 
                </a>
            </div>
            <div id="grimoire"> 
               <a href="grimBestiaire.php">
                   <div id="fondNoir"></div>
                    <h1>Consulter le<br><span>grimoire</span></h1> 
                    <p class="desc">A la fin de chaque légende du mode Aventure, le conteur vous offre de nouvelles plantes, créatures et anecdotes collectées dans votre grimoire. Devenez incollables sur Brocéliande et son folklore.</p> 
                    <div> 
                        <a href="grimBestiaire.php"><img src="images/flecheDBlanc.svg"></a>
                        <p>Découvrir</p> 
                    </div>
                </a> 
            </div>
            <?php
            }else{
            ?>
               <div id="decouverteDeco">
                   <a href="carte.php"> 
                       <div id="fondNoir"></div>
                        <h1>Mode<br><span>decouverte</span></h1> 
                        <p class="desc">Si vous souhaitez avoir des informations concises sur un lieu de votre choix, le mode Découverte est fait pour vous. Idéal lors des balades, vous pourrez découvrir la légende derrière chaque lieu en temps voulu.</p> 
                        <div> 
                            <img src="images/flecheDBlanc.svg"> 
                            <p>Découvrir</p> 
                        </div> 
                   </a>
                </div> 
                <div id="aventureDeco">
                   <a href="cheminAventure.php"> 
                        <h1>Mode<br><span>aventure</span></h1> 
                        <p class="desc">Que vous soyez passionés par les légendes de Brocéliandes ou de simples curieux, le mode Aventure vous permettra de vivre ces récits de façon immersive et divertissante grâce au conteur.</p> 
                        <div> 
                            <img src="images/flecheDBlanc.svg">
                            <p>Découvrir</p> 
                        </div> 
                    </a>
                </div>
            <?php
            }
            ?>
            <div id="retour">
                <p>Retour</p>
                <a href="index.php"><img src="images/flecheG.png" alt="flèche vers la gauche"></a>
            </div>
        </main>
        <footer>
            <p>KLEIZ | Projet MMI2 2018-2019</p>
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
