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
        <title>KLEIZ | BESTIAIRE | ADMIN GRIMOIRE</title>

    </head>
    <body>






        <?php



                function chargerClasse($classname)
        {
          require 'class/'.$classname.'.php';
        }

        spl_autoload_register('chargerClasse');

        require 'genererBestiaire.php';
        require 'genererHerbier.php';
        require 'genererResume.php';




      ?>
    </body>






</html>

 <?php
}else{
    header('Location: connexion.php');
}

?>
