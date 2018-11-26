<?php

require("param.inc.php");
$pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
$pdo ->query("SET NAMES utf8");
$pdo ->query("SET CHARACTER SET 'utf-8'");

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
        <title>KLEIZ | INSCRIPTION</title>
        <meta charset="utf-8">
    </head>

    <body>

            <?php
			if(isset($erreur)) 
			{
				echo '<div class="message animated bounceIn"><img class="logoError" src="image/error.svg" width="20" height="20" />' .$erreur.  '</div>';
			}
			?>
                <?php
			if(isset($valide)) 
			{
				echo '<div class="messageV animated bounceIn"><img class="logoError" src="image/valide.svg" width="20" height="20" />' .$valide.  '</div>';
			}
			?>
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
                                <label class="container">J'accepte les <a href="conditionUtilisation.php">conditions générales d'utilisation de Ureka</a>
                                    <input type="checkbox" required>
                                   <span class="checkmark"></span>
                               </label>

                            </div>
                            <li class="centrer">


                                <input type="submit" name="forminscription" value="S'inscrire" class="boutonInput" />


                            </li>
                        </ul>
                    </form>









        </div>

    </body>

    </html>