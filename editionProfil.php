<?php
session_start();
require 'connexionBDD.php';
    
$debugQWMain = false;
    
if(isset($_SESSION['id']) AND $_SESSION['id'] > 0)
{
	$getid = intval($_SESSION['id']);
	$requser = $pdo->prepare('SELECT * FROM membres WHERE IdUser = ?');
	$requser->execute(array($getid));
	$userinfo = $requser->fetch(PDO::FETCH_ASSOC);
    $_SESSION['val1'] = 0;
}

if(isset($_SESSION['id'])) 
{
   $requser = $pdo->prepare("SELECT * FROM membres WHERE IdUser = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   
   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['PseudoUser']) 
   {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $pdo->prepare("UPDATE membres SET PseudoUser = ? WHERE IdUser = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: profil.php');
   }
    
    if(isset($_POST['newdescription']) AND !empty($_POST['newdescription']) AND $_POST['newdescription'] != $user['DescriptionUser']) 
   {
      $newdescription = htmlspecialchars($_POST['newdescription']);
      $insertdescription = $pdo->prepare("UPDATE membres SET DescriptionUser  = ? WHERE IdUser = ?");
      $insertdescription->execute(array($newdescription, $_SESSION['id']));
      header('Location: profil.php');
   }
	
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['EmailUser']) 
   {
		$newmail = htmlspecialchars($_POST['newmail']);
		$insertmail = $pdo->prepare("UPDATE membres SET EmailUser = ? WHERE IdUser = ?");
		$insertmail->execute(array($newmail, $_SESSION['id']));
		header('Location: profil.php');
   }
   
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
   {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      
	  if($mdp1 == $mdp2) 
	  {
         $insertmdp = $pdo->prepare("UPDATE membres SET MdpUser = ? WHERE IdUser = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: profil.php');
      } 
	  else 
	  {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
}

if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
{
	$tailleMax = 2097152;
	$extentionsValides = array('jpg', 'jpeg', 'gif', 'png');
	if($_FILES['avatar']['size'] <= $tailleMax)
	{
		$extentionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
		if(in_array($extentionUpload, $extentionsValides))
		{
			$chemin = "membres/avatars/".$_SESSION['id'].".".$extentionUpload;
			$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin);
			if($resultat)
			{
				$updateavatar = $pdo->prepare('UPDATE membres SET AvatarUser = :avatar WHERE IdUser = :id');
				$updateavatar->execute(array(
					'avatar' => $_SESSION['id'].".".$extentionUpload,
					'id' => $_SESSION['id']
					));
				header('Location: profil.php');
			}
			else
			{
				$msg = "Erreur durant l'importation de votre photo de profil";
			}
		}
		else
		{
			$msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
		}
	}
	else
	{
		$msg = "Votre photo de profil ne doit pas dépasser 2Mo";
	}
}
    
if(isset($_FILES['banniere']) AND !empty($_FILES['banniere']['name']))
{
	$tailleMax = 2097152;
	$extentionsValides = array('jpg', 'jpeg', 'png');
	if($_FILES['banniere']['size'] <= $tailleMax)
	{
		$extentionUpload = strtolower(substr(strrchr($_FILES['banniere']['name'], '.'), 1));
		if(in_array($extentionUpload, $extentionsValides))
		{
			$chemin = "membres/banniere/".$_SESSION['id'].".".$extentionUpload;
			$resultat = move_uploaded_file($_FILES['banniere']['tmp_name'],$chemin);
			if($resultat)
			{
				$updateavatar = $pdo->prepare('UPDATE membres SET BanniereUser = :banniere WHERE IdUser = :id');
				$updateavatar->execute(array(
					'banniere' => $_SESSION['id'].".".$extentionUpload,
					'id' => $_SESSION['id']
					));
				header('Location: profil.php');
			}
			else
			{
				$msg = "Erreur durant l'importation de votre bannière";
			}
		}
		else
		{
			$msg = "Votre bannière doit être au format jpg, jpeg ou png";
		}
	}
	else
	{
		$msg = "Votre bannière ne doit pas dépasser 2Mo";
	}
}


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
            <div class="partie3">
                <h3>Modifier les informations</h3>
                <h2>PARAMETRES</h2>
                <form method="POST" action="" enctype="multipart/form-data">

                    <ul class="form-style-1">
                        <li>
                            
                            <input class="champFormulaire" type="text" name="newpseudo" minlength="3" maxlength="15" title="Caractères spéciaux interdits" pattern="^([0-9a-zA-Z]{3,15})$" placeholder="Pseudo" class="field-long" value="<?php echo $user['PseudoUser']; ?>" />
                        </li>
                        <li>
                            
                            <input class="champFormulaire" type="text" name="newdescription" minlength="1" maxlength="300" title="Caractères spéciaux interdits"  placeholder="Description" class="field-long" value="<?php echo $user['DescriptionUser']; ?>" />
                        </li>
                        <li>
                            
                            <input class="champFormulaire" type="email" name="newmail" placeholder="Email" class="field-long" onpaste="return false;" pattern="^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$" title="Adresse mail trop courte" value="<?php echo $user['EmailUser']; ?>" />
                        </li>
                        <li>
                            
                            <input class="champFormulaire" type="password" name="newmdp1" minlength="6" maxlength="32" class="field-long" onpaste="return false;" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,32}$" placeholder="Mot de passe" title="Votre mot de passe doit contenir au moins une majuscule, une miniscule et un chiffre" />
                        </li>
                        <li>
                        
                            <input class="champFormulaire" type="password" name="newmdp2" minlength="6" maxlength="32" class="field-long" onpaste="return false;" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,32}$" placeholder="Confirmation Mot de passe" title="Votre mot de passe doit contenir au moins une majuscule, une miniscule et un chiffre" />
                        </li>
                        <div class="contenu">
                            <li>
                            
                                <input type="file" class="btnInput" name="avatar" />
                            </li>
                            <li>
                            
                                <input type="file" class="btnInput" name="banniere" />
                            </li>
                        </div>
                        <li>
                            <input type="submit" value="Mettre à jour" class="btnGrim2" />
                        </li>

                </form>
            </div>
                <div class="partie4">
                <h3>TESTEZ VOTRE </h3>
                <h2>PERSONNALITE</h2>
                     <a id="btnGrim2" href="#">RECOMMENCER</a>
                    
                </div>
        </div>
        <?php require 'footer.php'; ?>
    </body>
</html>
    <?php

}else{
  header('Location: connexion.php');
}
?>
