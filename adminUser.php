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
			if($repAdmin['isAdmin'] >= 1){

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


////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////Utilisateur/////////////////////////////////
////////////////////////////////////////////////////////////////////////////////


			foreach($listeUserAAdminIdUser as $cle => $valeur){
// Pseudo -- aze
					echo 	"Pseudo -- ".$listeUserAAdminPseudoUser[$cle]."</br>";

// Mail -- a@aa.com
					echo 	"Mail -- ".$listeUserAAdminEmailUser[$cle]."</br>";

// Description --
					//echo 	"Description -- ".$listeUserAAdminDescriptionUser[$cle]."</br>";
					if ($listeUserAAdminDescriptionUser[$cle] == null) {
						echo " pas de description </br>";
					}else if($listeUserAAdminDescriptionUser[$cle] != null){
						echo " ".$listeUserAAdminDescriptionUser[$cle]." </br> ";
					}

// Groupe --
					//echo 	"Groupe -- ".$listeUserAAdminGroupeUser[$cle]."</br>";
					if ($listeUserAAdminGroupeUser[$cle] == null) {
						echo " pas de groupe </br> ";
					}else if($listeUserAAdminGroupeUser[$cle] == 1){
						// farfadet
						echo " Groupe farfadet </br> ";
					}else {
						echo "groupe non existant </br>";
					}

// Avatar -- default.jpg
					//echo 	"Avatar -- ".$listeUserAAdminAvatarUser[$cle]."</br>";
					echo "<img src='membres/avatars/".$listeUserAAdminAvatarUser[$cle]."' /> ";

//Banniere -- defaultb.jpg
					// echo 	"Banniere -- ".$listeUserAAdminBanniereUser[$cle]."</br>";
					echo "<img src='membres/banniere/".$listeUserAAdminBanniereUser[$cle]."' /> </br>";

//Creation -- 2019-03-18
				  //echo 	"Creation -- ".$listeUserAAdminDateCreation[$cle]."</br>";
					if ($listeUserAAdminDateCreation[$cle] == null){
						//Premiere Connexion Avant Maj 2019-03-19 et Non ReCo Depuis
						echo " PCAM 2019-03-19 NRCD </br>";
					}else{
						echo " premiere connexion ".$listeUserAAdminDateCreation[$cle]." </br>";
					}

// Droit --
					//echo 	"Rôle -- ".$listeUserAAdminIsAdmin[$cle]."</br>";
					//////////////////// Si MODO //////////////////////
					if($repAdmin['isAdmin'] == 1){
							if($listeUserAAdminIsAdmin[$cle] == null){	echo " Membre </br>";
							}else if($listeUserAAdminIsAdmin[$cle] == 1){	echo " Modo </br>";
							}else if ($listeUserAAdminIsAdmin[$cle] == 2) {		echo " Admin </br>"; }



				  //////////////////// Sinon Admin //////////////////////
					}else if($repAdmin['isAdmin'] == 2){
						if($listeUserAAdminIsAdmin[$cle] < 2){
							if($listeUserAAdminIsAdmin[$cle] == null){	echo " Membre </br>";
							}else if($listeUserAAdminIsAdmin[$cle] == 1){ 	echo " Modo </br>";
							}else if ($listeUserAAdminIsAdmin[$cle] == 2) { 	echo " Admin </br>";}
?>

						<form method="POST" action="">
							<select name="Droit<?php echo "".$cle."" ?>" size="1">
								<option>membre
								<option>modo
								<option>admin
							</select>
							<input type="submit" name="EnvDroit<?php echo "".$cle."" ?>" value="ModifierDroit" class="boutonInput" />
						</form>
<?php
						if(isset($_POST['EnvDroit'.$cle])){
								if ($_POST['Droit'.$cle] == "membre" ) {
									echo "membre";
									$calcDroit = "NULL";
								}else if($_POST['Droit'.$cle] == "modo" ){
									echo "modo";
									$calcDroit = 1;
								}else if($_POST['Droit'.$cle] == "admin" ){
									echo "admin";
									$calcDroit = 2;
								}

						  $sqlAdminUserRole = "UPDATE membres
																		 SET isAdmin = ".$calcDroit."
																		 WHERE IdUser = ".$cle."";
							echo $sqlAdminUserRole;
							$requserAdminUserRole = $pdo->prepare($sqlAdminUserRole);
							$requserAdminUserRole->execute();
							header('Location: adminUser.php');

				     }
				  }
				 }




// Bloquer --
					//echo 	"Bloquer -- ".$listeUserAAdminEtatCompte[$cle]."</br>";
					if ($listeUserAAdminEtatCompte[$cle] == null) {
						echo " non bloquer </br>";
?>
						<form method="POST" action="">
									<ul>
										<li>
                        <input type="text" name="Motif<?php echo "".$cle."" ?>" class="field-long" placeholder="Motif de bloquage" required="required" />
                    </li>
										<li class="centrer">
												<input type="submit" name="Bloquer<?php echo "".$cle."" ?>" value="bloquer" class="boutonInput" />
										</li>
									</ul>
						</form>
<?php
						if(isset($_POST['Bloquer'.$cle])){
							echo "compte".$cle."";
							$motif = $_POST['Motif'.$cle];
							echo $motif;
							$sqlAdminUserBloque = "UPDATE membres
							 											 SET EtatCompte = '1',
																		 		 MotifBloque = '".$motif."'
																		 WHERE IdUser = ".$cle."";
							echo $sqlAdminUserBloque;
							$requserAdminUserBloque = $pdo->prepare($sqlAdminUserBloque);
							$requserAdminUserBloque->execute();
							header('Location: adminUser.php');
						}
?>
<?php

					}else if( $listeUserAAdminEtatCompte[$cle] == 1 ){
						echo " compte bloquer  </br>";
						echo " motif de bloquage ".$listeUserAAdminMotifBloque[$cle]." </br>";
					}

					echo "</br>---------------------------------------------------------------------------------------------------------------------------</br>";
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
