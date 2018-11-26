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
        <title>KLEIZ | CONNEXION</title>
        <meta charset="utf-8">
    </head>

    <body>



      

            <?php
			if(isset($erreur)) 
			{
				echo '<div class="message animated bounceIn"><img class="logoError" src="image/error.svg" width="20" height="20" />' .$erreur. '</div>';
			}
			?>
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

                        <li class="centrer">


                            <input type="submit" name="formconnexion" value="Se connecter" class="boutonInput" />


                        </li>
                    </ul>
                </form>



    </body>

    </html>