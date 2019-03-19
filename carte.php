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
        <title>KLEIZ | CARTE</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleCarte.css">
        <link rel="stylesheet" href="css/styleMenu.css">
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
         <?php require 'header.php'; ?>
        <main>
           <h1>La carte de <br><span>Broceliande</span></h1>
           <section>
               <a href="decouverte.php" class="pointeur" data-numero="8" id="rochesTreban"></a>
                <a href="decouverte.php" class="pointeur" data-numero="5" id="tombeauMerlin"></a>
                <a href="decouverte.php" class="pointeur" data-numero="4" id="egliseGraal"></a>
                <a href="decouverte.php" class="pointeur" data-numero="1" id="arbreOr"></a>
                <a href="decouverte.php" class="pointeur" data-numero="6" id="fontaineBarenton"></a>
                <a href="decouverte.php" class="pointeur" data-numero="3" id="fauxAmants"></a>
                <a href="decouverte.php" class="pointeur" data-numero="7" id="chateauTrecesson"></a>
                <a href="decouverte.php" class="pointeur" data-numero="2" id="miroirFees"></a>
           </section>
           <div id="retour">
            <p>Retour</p>
            <a href="javascript:history.go(-1)">
                <img src="images/flecheG.svg" alt="flèche vers la gauche">
            </a>
        </div>
        </main>
        <?php require 'footer.php'; ?>
        <script src="js/jquery.js"></script>
        <script src="js/valeursCarte.js"></script>
    </body>
</html>
