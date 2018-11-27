<?php

require 'connexionBDD.php';

if(isset($_POST['forminscription']))
{
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);
	
	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
	{
		$pseudolength = strlen($pseudo);
		if($pseudolength <= 15 AND $pseudolength >= 3) 
		{
			if($mail == $mail2) 
			{
				if(filter_var($mail, FILTER_VALIDATE_EMAIL)) 
				{
                    echo ("SELECT * FROM membres WHERE mail = '".$mail."'");
                    //$reqmail = $pdo->query("SELECT * FROM membres WHERE EmailUser = '".$mail."'");
                    //vérifier existance fonctionne
					$reqmail = $pdo->prepare("SELECT * FROM membres WHERE EmailUser = ?");
					$reqmail->execute(array($mail));
					$mailexist = $reqmail->rowCount();
					if($mailexist == 0) 
					{
						if($mdp == $mdp2) 
						{
							$insertmbr = $pdo->prepare("INSERT INTO membres(PseudoUser, EmailUser, MdpUser, AvatarUser, BanniereUser) VALUES(?, ?, ?, ?, ?)");
							$insertmbr->execute(array($pseudo, $mail, $mdp, "default.jpg", "defaultb.jpg"));
							$valide = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
						} 
						else 
						{
							$erreur = " Vos mots de passes ne correspondent pas !";
						}
					} 
					else 
					{
						$erreur = " Adresse mail déjà utilisée !";
					}
				}
				else
				{
					$erreur = " Votre adresse mail n'est pas valide !";
				}
			}
			else
			{
				$erreur = " Vos adresses mail ne correspondent pas !";
			}
		}
		else
		{
			$erreur = " Votre pseudo doit contenir entre 3 et 15 caractères !";
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
        <title>KLEIZ | INSCRIPTION</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleInscription.css">
        <link rel="stylesheet" href="css/animation.css">
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
            <div class="messageCentre">
           <div id="contenu">
            <?php
			if(isset($erreur)) 
			{
				echo '<div class="message animated fadeInDown"><img class="logoError" src="images/warning.svg" width="20" height="20" />' .$erreur. '</div>';
			}
			?>
                <?php
			if(isset($valide)) 
			{
				echo '<div class="messageV animated fadeInDown"><img class="logoError" src="images/valide.svg" width="20" height="20" />' .$valide. '</div>';
			}
			?>
               </div>
           </div>
               
              <div id="contenu"> 
               
        <div class="conteneur">
            <img src="images/logo.png" alt="logo kleiz" id="logo">
           <div id="titre">
               <h2>Inscription</h2>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do. Consectetur adipiscing elit, sed do.</p>
           </div>
            <form method="POST" action="">
                <ul class="form-style-1">
                    <li><label for="pseudo"></label><input id="pseudo" type="text" name="pseudo" class="field-divided" title="Caractères spéciaux interdits" pattern="^([0-9a-zA-Z]{3,15})$" placeholder="Pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" /></li>
                    <li>
                        <label for="mail"></label>
                        <input id="email" type="email" name="mail" class="field-long" placeholder="Email" onpaste="return false;" required="required" pattern="^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$" title="Adresse mail trop courte" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                    </li>
                    <li>
                        <label for="mail2"></label>
                        <input id="email" type="email" name="mail2" class="field-long" placeholder="Confirmation Email" onpaste="return false;" required="required" pattern="^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$" title="Adresse mail trop courte" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
                    </li>
                    <li>
                        <label for="mdp"></label>
                        <input id="mdp" type="password" name="mdp" minlength="6" maxlength="32" class="field-long" onpaste="return false;" required="required" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,32}$" placeholder="Mot de passe" title="Votre mot de passe doit contenir au moins une majuscule, une miniscule et un chiffre" />
                    </li>
                    <li>
                        <label for="mdp2"></label>
                        <input id="mdp2" type="password" name="mdp2" minlength="6" maxlength="32" class="field-long" onpaste="return false;" required="required" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,32}$" placeholder="Confirmation du mot de passe" title="Votre mot de passe doit contenir au moins une majuscule, une miniscule et un chiffre" />
                    </li>
                    <div class="check">
                        <label class="container">J'accepte les <a href="conditionUtilisation.php">conditions générales d'utilisation de Kleiz</a>
                            <input type="checkbox" required>
                           <span class="checkmark"></span>
                       </label>

                    </div>
                    <li class="centrer">
                        <input type="submit" name="forminscription" value="S'inscrire" class="boutonInput" />
                    </li>
                </ul>
            </form>
            <div class="reseaux">
               <a href="https://www.facebook.com/kleiz3" target="_blank">
                   <img src="images/facebook.svg" alt="logo Facebook">
               </a>
                <a href="https://twitter.com/Kleizbro" target="_blank">
                   <img src="images/twitter.svg" alt="logo Twitter">
               </a>
               <a href="https://www.instagram.com/kleiz3" target="_blank">
                   <img src="images/instagram.svg" alt="logo Instagram">
               </a>
               <a href="images/snapchat.jpg" target="_blank">
                   <img src="images/snapchat.svg" alt="logo Snapchat">
               </a>
            </div>
            <p class="footer">KLEIZ | Projet MMI2 2018-2019</p>
            </div>
            <div id="retour">
            <p>Retour</p>
            <a href="accueil.html">
                <img src="images/flecheG.svg" alt="flèche vers la gauche">
            </a>
        </div>
        </section>
        <section>
            <h1>Les legendes de <br><span>Broceliande</span></h1>
        </section>
            </div>   
    </body>
</html>