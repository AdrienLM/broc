<?php
session_start();

require("param.inc.php");
$pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
$pdo ->query("SET NAMES utf8");
$pdo ->query("SET CHARACTER SET 'utf-8'");

if(isset($_POST['formconnexion']))
{
	if(!empty($_POST['mailconnect']) AND !empty($_POST['mdpconnect']))
	{	
		$mailconnect = htmlspecialchars($_POST['mailconnect']);
		$mdpconnect = sha1($_POST['mdpconnect']);
		if(!empty($mailconnect) AND !empty($mdpconnect))
		{
			$requser = $pdo->prepare("SELECT * FROM membres WHERE EmailUser = ? AND MdpUser = ?");
			$requser->execute(array($mailconnect, $mdpconnect));
			$userexist = $requser->rowCount();
			if($userexist == 1 )
			{
				$userinfo = $requser->fetch();
				$_SESSION['id'] = $userinfo['IdUser']; 
				$_SESSION['pseudo'] = $userinfo['PseudoUser'];
				$_SESSION['mail'] = $userinfo['EmailUser'];
                header("Location: accueil.php?id=".$_SESSION['id']);
            }
			else
			{
				$erreur = " Email ou mot de passe incorrect !";
			}
		}
		else
		{
			$erreur =  " Tous les champs doivent être complétés !";
		}
	}
	else
	{
		$erreur = " Tous les champs doivent être complétés !";
	}
}

?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>KLEIZ | CONNEXION</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleInscription.css">
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
       <section>
          <div id="contenu">
              <?php
                if(isset($erreur)) 
                {
                    echo '<div class="message animated bounceIn"><img class="logoError" src="image/error.svg" width="20" height="20" />' .$erreur. '</div>';
                }
                ?>
            <img src="images/logo.png" alt="logo kleiz" id="logo">
           <div id="titre">
               <h2>Connexion</h2>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do. Consectetur adipiscing elit, sed do.</p>
           </div>
            <form method="POST" action="">
                <ul class="form-style-1">
                    <li>
                        <label for="inputEmail3"></label>
                        <input id="inputEmail3" type="email" name="mailconnect" class="field-long" placeholder="Email" onpaste="return false;" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                    </li>
                    <li>
                        <label for="inputPassword3"></label>
                        <input id="inputPassword3" type="password" name="mdpconnect" class="field-long" onpaste="return false;" placeholder="Mot de passe" />
                    </li>
                    <div class="check">
                        <label class="container">Rester connecté avec ces identifiants
                            <input type="checkbox" required>
                           <span class="checkmark"></span>
                       </label>
                    </div>
                    <li class="centrer">
                        <input type="submit" name="formconnexion" value="Connexion" class="boutonInput" />
                    </li>
                </ul>
            </form>
            <div id="ou">
                <div></div>
                <p>OU</p>
                <div></div>
            </div>
            <p id="sous-titre">Inscrivez-vous dès à présent</p>
              <a href=""><p>Mot de passe perdu ?</p></a>
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
            <p class="footer">KLEIZ | Projet MMI2 2018-2019</p>
          </div>
       </section>
        <section>
            <h1>Les legendes de <br><span>Broceliande</span></h1>
        </section>
    </body>
</html>