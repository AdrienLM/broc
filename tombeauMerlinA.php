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
}
?>

<!DOCTYPE html>
<html allowfullscreen>
    <head>
        <meta charset="utf-8">
        <title>KLEIZ | TOMBEAU DE MERLIN | MODE AVENTURE</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleMenu.css">
        <link rel="stylesheet" href="css/styleAventureV2.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
        <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png" />
        <link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png" />
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png" />
        <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png" />
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png" />
        <link rel="manifest" href="images/favicon/manifest.json" />
        <meta name="msapplication-TileColor" content="#ffffff" />
        <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png" />
        <meta name="theme-color" content="#ffffff" />
    </head>
    <body>
        <?php include("header.php");

            $_SESSION['aventureSur'] = 1;
            $_SESSION['antiRep'] = 1;
            $_SESSION['AventureProv'] = 3;
        ?>
        <main>
            <div id="texte">
                <h2>Scene 3</h2>
                <h1>Le tombeau de Merlin</h1>
                <audio id="playerAudioConteur">
                    <source src="./sons/aventureTombeauMerlin.mp3" />
                    <source src="./sons/aventureTombeauMerlin.ogg" />
                </audio>

								<audio loop>
                    <source src="./sons/ambianceForet.mp3" />
                    <source src="./sons/ambianceForet.ogg" />
								</audio>

                <audio id="playerAudioRep0">
                    <source src="./sons/reponsesEnigmes/morgane.mp3" />
                    <source src="./sons/reposesEnigmes/morgane.ogg" />
                </audio>
                <audio id="playerAudioRep1">
                    <source src="./sons/reponsesEnigmes/viviane.mp3" />
                    <source src="./sons/reponsesEnigmes/viviane.ogg" />
                </audio>
                <audio id="playerAudioRep2">
                    <source src="./sons/reponsesEnigmes/guenievre.mp3" />
                    <source src="./sons/reponsesEnigmes/guenievre.ogg" />
                </audio>
                <audio id="playerAudioRep3">
                    <source src="./sons/reponsesEnigmes/melusine.mp3" />
                    <source src="./sons/reponsesEnigmes/melusine.ogg" />
                </audio>
                <p>Paramètres</p>
								<div id="param">
				          <div>
				            <img src="images/pleinEcran.svg" alt="icone plein écran" />
				            <p>Plein écran</p>
				          </div>
				          <div>
				            <img src="images/play.svg" alt="flèche vers la droite" class="decouvrir">
				            <p>Découvrir</p>
				          </div>
				          <div>
				            <img src="images/croix.svg" alt="croix" />
				            <p>Passer</p>
				          </div>
				        </div>
            </div>
            <div id="carte">
                <h2>Localisation</h2>
                <p>Forêt de Paimpont</p>
                <img src="images/carteTombeauMerlin.svg" alt="Carte de Brocéliande" />
            </div>
            <div id="jeu">
							<div id="wrapperJeu">
								<div id="narrateur">
                   <div>
                        <img src="images/casque.svg" alt="Casque" />
                        <h3>Narrateur</h3>
                   </div>
                   <p class="histoire">Lance un sort pour dissiper le brouillard.</p>
                   <div>
                       <img src="images/flecheD.svg" alt="Flèche vers la droite" />
                       <p>Répondre</p>
                   </div>
                </div>
							</div>
            </div>
            <div id="retour">
                <p>Retour</p>
                <a href="javascript:history.go(-1)">
                    <img src="images/flecheG.svg" class="rectif" alt="flèche vers la gauche">
                </a>
            </div>
        </main>
        <?php include("./footer.php"); ?>
        <script type="text/javascript" src="js/audioTombeauMerlin.js"></script>
    </body>
</html>
