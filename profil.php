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


?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>KLEIZ | PROFIL :
            <?php echo $userinfo['PseudoUser']; ?>
        </title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleProfil.css">
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
        <?php
            require 'header.php'; 
            require 'initCompteGrimoire.php'; 
        ?>
        <div class="conteneur">
            <div class="partie1">

                <div class="banniere">

                    <div class="imageProfil"><img class="imgProfil" src="membres/avatars/<?php echo $userinfo['AvatarUser']; ?>" alt="image du profil utilisateur"></div>
                    <div class="nomProfil">
                        <h4 class="nomProfil">
                            <?php echo $userinfo['PseudoUser']; ?>
                        </h4>
                    </div>
                    
                    <div class="roleProfil">  <img class="imgRole" src="images/icoRole.svg" alt="image du profil utilisateur"> <?php if($userinfo['GroupeUser'] != null){
      ///////////////////////////////////groupeUser de l'utilisateur////////////////////////////////////////////////////
     if($debugQWMain)   var_dump ($userinfo['GroupeUser']);
    echo '<p>'.$userinfo['GroupeUser'].'</p>';
    
    }else{
          echo ' Non attribué';
    }
    
        ?>.</div>
                    <div class="descriptionProfil">

                        <?php   if($userinfo['DescriptionUser'] != null){
          ///////////////////////////////////DescriptionUser de l'utilisateur////////////////////////////////////////////////////
         if($debugQWMain)    var_dump ($userinfo['DescriptionUser']);
                        echo '<p>'.$userinfo['DescriptionUser'].'</p>'; 
    
   }else{
        echo '<p>Editer description ?</p>';
    }
            ?>       
                    </div>
                    <img class="imgBan" src="membres/banniere/<?php echo $userinfo['BanniereUser']; ?>" alt="banniere utilisateur">  
                </div>
                <div class="succesCont">
                    <p>Succès obtenus</p>
                    <div class="succes">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="progresCont">
                    <p>Progression du jeu</p>
                    <div>
                        <div class="anecdotes">
                            <div>
                                <p>Anecdotes</p>
                                <p>7</p>
                            </div>
                        </div>
                        <div class="avancement">
                            <div>
                                <p>Avancement</p>
                                <p>100%</p>
                            </div>
                        </div>
                        <div class="stickers">
                            <div>
                                <p>Stickers</p>
                                <p>4</p>
                            </div>
                        </div>
                    </div>
                </div>
                <a id="btnGrim" href="grimBestiaire.php">Mon grimoire</a>
            </div>
            <div class="partie2">nav</div>
        </div>
        <?php require 'footer.php'; ?>
    </body>
</html>
    <?php

}else{
  header('Location: connexion.php');
}
?>
