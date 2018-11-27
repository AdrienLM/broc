<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>KLEIZ | ARBRE D'OR | MODE AVENTURE</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleAventure.css">
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
        <header>
           <a href="accueil.php"><img src="images/logo.png" alt="logo Kleiz" id="logo"></a>
            <nav>
                <a href="guide.html">accueil</a>
                <a href="choixModes.html">guide</a>
                <a href="profil.html">modes</a>
                <a href="profil.html"><img src="images/imgProfil.png" alt="image profil"></a>
                <img src="images/depliant.png" alt="dépliant">
                <!--
                <ul id="menuFlottant">
                    <li>
                       <a href="deconnexion.php">
                           <img src="images/quitter.png" alt="quitter">
                       </a>
                        <p>Quitter</p>
                    </li>
                    <li>
                       <a href="parametres.html">
                           <img src="images/param.png" alt="engrenage">
                       </a>
                        <p>Paramètres</p>
                    </li>
                    <li>
                       <a href="carte.html">
                           <img src="images/carte.png" alt="pointeur">
                       </a>
                        <p>Carte</p>
                    </li>
                </ul>
                -->
            </nav>
        </header>
        <main>
            <div id="texte">
                <h2>Scene 2</h2>
                <h1>L'arbre d'or</h1>
                <audio controls>
                  <source src="sons/arbreOr.wav" type="audio/wav">
                  <p>Votre navigateur ne prend pas en charge l'audio HTML. Voici un
                     un <a href="sons/arbreOr.wav">lien vers le fichier audio</a> pour le 
                     télécharger.</p>
                </audio>
                <p>Paramètres</p>
                <div id="param">
                    <div>
                        <img src="images/pleinEcran.svg" alt="icone plein écran">
                        <p>Plein écran</p>
                    </div>
                    <div>
                        <img src="images/flecheD.svg" alt="flèche vers la droite">
                        <p>Découvrir</p>
                    </div>
                    <div>
                        <img src="images/croix.svg" alt="croix">
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
                <a href="accueil.php">
                    <img src="images/flecheG.svg" alt="flèche vers la gauche">
                </a>
            </div>
        </main>
        <footer>
           <p>KLEIZ | Projet MMI2 2018-2019</p>
            <div class="reseaux">
               <a href="https://www.facebook.com/kleiz3" target="_blank">
                   <img src="images/fb.png" alt="logo Facebook">
               </a>
                <a href="https://twitter.com/Kleizbro" target="_blank">
                   <img src="images/twitter.png" alt="logo Twitter">
               </a>
               <a href="https://www.instagram.com/kleiz3" target="_blank">
                   <img src="images/insta.png" alt="logo Instagram">
               </a>
               <a href="images/snapchat.jpg" target="_blank">
                   <img src="images/snap.png" alt="logo Snapchat">
               </a>
            </div>
        </footer>
    </body>
</html>