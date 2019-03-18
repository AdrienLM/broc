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
			if(isset($idCompte)){
					$requete = "SELECT isAdmin FROM membres WHERE IdUser = ".$idCompte;
					$isAdmin = $pdo->query($requete);
					$repAdmin = $isAdmin->fetch(PDO::FETCH_ASSOC);

			}else{
					$idCompte = $_SESSION['id'];
					$requete = "SELECT isAdmin FROM membres WHERE IdUser = ".$idCompte;
					$isAdmin = $pdo->query($requete);
					$repAdmin = $isAdmin->fetch(PDO::FETCH_ASSOC);

			}

	if($repAdmin['isAdmin'] == 2){


    function chargerClasse($classname)
        {
          require 'class/'.$classname.'.php';
        }
        spl_autoload_register('chargerClasse');


				$sqlReq = "SELECT * FROM membres";
        $execSqlReq = $pdo->query($sqlReq);
				while($donneesUserAdmin = $execSqlReq->fetch()){
					$listeUserAAdmin[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['IdUser'];
					$listeUserAAdmin[$donneesUserAdmin['EmailUser']] =  $donneesUserAdmin['EmailUser'];
				}

				var_dump( $listeUserAAdmin);













			}else{
			    header('Location: index.php');
			}


      ?>
    </body>






</html>

 <?php
}else{
    header('Location: connexion.php');
}

?>
