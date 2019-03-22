<?php
session_start();
require 'connexionBDD.php';
unset($_SESSION['aventureSur']);
unset($_SESSION['antiRep']);
unset($_SESSION['AventureProv']);


if(isset($_SESSION['id']) && $_SESSION['id'] > 0) {
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
        <link rel="stylesheet" href="css/styleCheminAventure.css">
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


        <?php require 'header.php';
				 			require 'initCompteGrimoire.php'; ?>

        <div class="positionementGraphique">

            <img src="images/avancement.svg" class="boutonAvancerIcon avancementGraphique" alt="icone" />
            <div class="positionTitreAvancement">
                <h2>MODE</h2>
                <h1>AVENTURE</h1>
            </div>
        </div>

        <div class="container">
            <div class="colonne1">
                <ul>
                    <a href="#" class="bientot"><li>SCÈNE 7 : LE ROCHER DES FAUX AMANTS</li></a>
                    <a href="#" class="bientot"><li>SCÈNE 8 : L'ÉGLISE DU GRAAL</li></a>
                    <a href="#" class="bientot"><li>SCÈNE 9 : EN DLC</li></a>
                </ul>
            </div>
            <div class="colonne2">
                <ul>
                    <a href="miroirFeesA.php"><li>SCÈNE 1 : LE MIROIR AUX FÉES</li></a>
                    <a href="arbreOrA.php"><li>SCÈNE 2 : L’ARBRE D’OR</li></a>
                    <a href="#"><li>SCÈNE 3 : LE TOMBEAU DE MERLIN</li></a>
                </ul>
            </div>
            <div class="colonne3">
                <ul>
                    <a href="#" class="bientot"><li>SCÈNE 4 : LA FONTAINE DE BARENTON</li></a>
                    <a href="#" class="bientot"><li>SCÈNE 5 : LA MARIÉE DE TRÉCESSON</li></a>
                    <a href="#" class="bientot"><li>SCÈNE 6 : LES TROIS ROCHES DE TRÉBAN</li></a>


                </ul>
            </div>
        </div>

        <?php require 'footer.php'; ?>

        <script src="js/jquery.js"></script>
        <script src="js/scriptMenuFlottant.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
        <script src="js/index.js"></script>
    </body>

    </html>
