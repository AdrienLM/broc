<?php 
session_start();
require 'connexionBDD.php';
    
$debugQWMain = true;


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
        <title>KLEIZ | BESTIAIRE | EXEMPLE PHP PROFIl</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="./css/styleGrimoire.css">
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
        
        <?php require 'header.php'; 
    
    
    
    ///////////////////////////////////Pseudo de l'utilisateur////////////////////////////////////////////////////
     if($debugQWMain)    var_dump ($userinfo['PseudoUser']);  
    echo $userinfo['PseudoUser'];
    
    
    
    
    //si pas de description profose de faire une description
    
    if($userinfo['DescriptionUser'] != null){
          ///////////////////////////////////DescriptionUser de l'utilisateur////////////////////////////////////////////////////
         if($debugQWMain)    var_dump ($userinfo['DescriptionUser']);
        echo $userinfo['DescriptionUser'];
    }else{
        echo 'Vous n\'avez pas de description pour le moment ';
    }
    
    
    
    
    
    
      ///////////////////////////////////AvatarUser de l'utilisateur////////////////////////////////////////////////////
     if($debugQWMain)   var_dump ($userinfo['AvatarUser']);
    echo $userinfo['AvatarUser'];
      ///////////////////////////////////BanniereUser de l'utilisateur////////////////////////////////////////////////////
     if($debugQWMain)   var_dump ($userinfo['BanniereUser']);
        echo $userinfo['BanniereUser'];        
        
    
    
      
    if($userinfo['GroupeUser'] != null){
      ///////////////////////////////////groupeUser de l'utilisateur////////////////////////////////////////////////////
     if($debugQWMain)   var_dump ($userinfo['GroupeUser']);
    echo $userinfo['GroupeUser'];
    
    }else{
          echo 'Vous n\'avez pas encore passer le test de personnalité ';
    }
    
        ?>
       

        <main>
     

          
        </main>
        <?php require 'footer.php'; ?>
    </body>
    
    
    
    
    
    
</html>

 <?php
}else{
    header('Location: connexion.php');
}

?>