<?php
session_start();
require 'connexionBDD.php';



if(isset($_SESSION['id']) && $_SESSION['id'] > 0){
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

    	function chargerClasse($classname){
        	require 'class/'.$classname.'.php';
      }
	        spl_autoload_register('chargerClasse');


			$sqlReq = "SELECT * FROM membres";
      $execSqlReq = $pdo->query($sqlReq);
			while($donneesUserAdmin = $execSqlReq->fetch()){
					$listeUserAAdminIdUser[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['IdUser'];
					$listeUserAAdminPseudoUser[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['PseudoUser'];
					$listeUserAAdminEmailUser[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['EmailUser'];
					$listeUserAAdminDescriptionUser[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['DescriptionUser'];
					$listeUserAAdminGroupeUser[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['GroupeUser'];
					$listeUserAAdminAvatarUser[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['AvatarUser'];
					$listeUserAAdminBanniereUser[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['BanniereUser'];
					$listeUserAAdminDateCreation[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['DateCreation'];
					$listeUserAAdminIsAdmin[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['isAdmin'];
					$listeUserAAdminEtatCompte[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['EtatCompte'];
					$listeUserAAdminMotifBloque[$donneesUserAdmin['IdUser']] =  $donneesUserAdmin['MotifBloque'];
			}

			foreach($listeUserAAdminIdUser as $cle => $valeur){

					echo 	"Pseudo -- ".$listeUserAAdminPseudoUser[$cle]."</br>";
					echo 	"Mail -- ".$listeUserAAdminEmailUser[$cle]."</br>";
					echo 	"Description -- ".$listeUserAAdminDescriptionUser[$cle]."</br>";
					echo 	"Groupe -- ".$listeUserAAdminGroupeUser[$cle]."</br>";
					echo 	"Avatar -- ".$listeUserAAdminAvatarUser[$cle]."</br>";
					echo 	"Banniere -- ".$listeUserAAdminBanniereUser[$cle]."</br>";
				  echo 	"Creation -- ".$listeUserAAdminDateCreation[$cle]."</br>";
					echo 	"Droit -- ".$listeUserAAdminIsAdmin[$cle]."</br>";
					echo 	"Bloquer -- ".$listeUserAAdminEtatCompte[$cle]."</br>";
					echo 	"Motif Bloquer -- ".$listeUserAAdminMotifBloque[$cle]."</br>";
					echo "</br>";
			}

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
