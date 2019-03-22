<!DOCTYPE html>
<html lang="fr">

<!--en-tete de la page: titre et sous-titre-->

    <head>
        <meta charset="utf-8">
        <title>KLEIZ | CONDITIONS D'UTILISATION</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleMenu.css">
        <link rel="stylesheet" href="css/stylePlan.css">
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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>

<body>
    <div id="barreNav">
        <?php include("header.php") ?>
        <h1>PLAN DU SITE KLEIZ</h1>
    </div>
    <main>
        <section id="plan">
            <div>
                <h2>Application</h2>
                <hr>
                <a href="index.php">Introduction</a>
                <a href="soon.php">Guide</a>
                <a href="cheminAventure.php">Aventure - Introduction</a>
                <a href="arbreOrA.php.php">Aventure - Scène 1</a>
                <a href="soon.php">Aventure - Scène 2</a>
                <a href="soon.php">Aventure - Scène 3</a>
                <a href="carte.php">Déouverte - Carte</a>
                <a href="decouverte.php" class="pointeur" data-numero="1">Découverte - L'arbre d'or</a>
                <a href="decouverte.php" class="pointeur" data-numero="2">Découverte - Le miroir aux fées</a>
                <a href="decouverte.php" class="pointeur" data-numero="3">Découverte - Le rocher des faux amants</a>
                <a href="decouverte.php" class="pointeur" data-numero="4">Découverte - L'église du Graal</a>
                <a href="decouverte.php" class="pointeur" data-numero="5">Découverte - Le tombeau de Merlin</a>
                <a href="decouverte.php" class="pointeur" data-numero="6">Découverte - La fontaine de Barenton</a>
                <a href="decouverte.php" class="pointeur" data-numero="7">Découverte - Le chateau de Trecesson</a>
                <a href="decouverte.php" class="pointeur" data-numero="8">Découverte - Les trois roches de Treban</a>
                <a href="grimResume.php">Grimoire - Résumé</a>
                <a href="grimHerbier.php">Grimoire - Herbier</a>
                <a href="grimBestiaire.php">Grimoire - Bestiaire</a>
            </div>
            <div>
                <h2>Compte</h2>
                <hr>
                <a href="connexion.php">Connexion</a>
                <a href="inscription.php">Inscription</a>
                <a href="profil.php">Profil Utilisateur</a>
                <a href="editionProfil.php">Paramètres Utilisateur</a><br><br>
                <h2>Mentions légales</h2>
                <hr/>
                <a href="cgu.php#CGU">Conditions générales d'utilisation</a>
                <a href="cgu.php#cookies">Précisions sur les cookies</a>
                <a href="cgu.php#RGPD">Règlement sur la protection des données</a>
            </div>
            <div>
                <h2>Autres</h2>
                <hr>
                <a href="equipe.php">L'équipe</a>
                <a href="https://www.facebook.com/kleiz3/">Facebook</a>
                <a href="https://twitter.com/Kleizbro">Twitter</a>
                <a href="https://www.instagram.com/kleiz3">Instagram</a>
                <a href="http://localhost/broc%202/images/snapchat.jpg">Snapchat</a>
            </div>
        </section>
        <div id="retour">
            <p>Retour</p>
            <a href="index.php">
                <img src="images/flecheG.svg" alt="flèche vers la gauche">
            </a>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/valeursCarte.js"></script>
    </main>
    <?php include("footer.php") ?>
</body>
</html>