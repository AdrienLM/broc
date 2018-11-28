<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>KLEIZ | BESTIAIRE | GRIMOIRE OUBLIÉ</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="./css/styleGrimoire.css">
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
        <?php 
            require 'connexionBDD.php';
            $_SESSION['id'] = 2;
            require 'collecteDataGrim.php';
        ?>
        <header>
           <a href="accueil.html"><img src="images/logo.png" alt="logo Kleiz" id="logo"></a>
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
            <a href="herbier.html"> <!-- Flèche page précédente -->
                <div>
                    <p>Page précédente</p>
                    <img src="images/flecheG.png" alt="flèche vers la gauche">
                </div>
            </a>
            <section id="pageGrimoire">
                <header> <!-- Titre de la page -->
                    <h1>Le Grimoire Oublié</h1>
                    <h2>L'Herbier</h2>
                </header>                
                
                
                
                
                 <?php ////Affichage Herbier////
                    for($i=1;$i<=5;$i++) 
                    { ?>
                
                
                <article class="<?php echo $cadnasHerbier[$i] ?>"> <!-- Chaque <article> est un des éléments du grimoire -->
                    <div>
                        <h3> <?php echo $nomHerbier[$i] ?></h3>
                        <p> <?php echo $descriptionHerbier[$i] ?></p>
                    </div>
                    <img src = <?php echo '"'.$imageHerbier[$i].'"' ?> alt="image" />
                </article>

                  <?php } ?>
                

                <div> <!-- Languettes -->
                    <a href="#">Résumé</a>
                    <a href="#">Herbier</a>
                    <a href="#" class="pageActiveGrimoire">Bestiaire</a>
                </div>
            </section>

            <a href="#"> <!-- Flèche page suivante -->
                <div class="nonCliquable">
                    <p>Page suivante</p>
                    <img src="images/flecheD.png" alt="flèche vers la droite">
                </div>
            </a>
        </main>
    </body>
</html>