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

/////////////////////////// formulaires//////////////////////////////




if(isset($_POST['Bloquer'])){
	echo "HAAAAAAAAAAAAAAAAAAAAAAA";

}







/////////////////////////////////////////////////////////////////////


















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
					// Pseudo -- aze
					echo 	"Pseudo -- ".$listeUserAAdminPseudoUser[$cle]."</br>";

					// Mail -- a@aa.com
					echo 	"Mail -- ".$listeUserAAdminEmailUser[$cle]."</br>";

					// Description --
					//echo 	"Description -- ".$listeUserAAdminDescriptionUser[$cle]."</br>";
					if ($listeUserAAdminDescriptionUser[$cle] == null) {
						echo " pas de description ";
					}else if($listeUserAAdminDescriptionUser[$cle] != null){
						echo " ".$listeUserAAdminDescriptionUser[$cle]." ";
					}

					// Groupe --
					//echo 	"Groupe -- ".$listeUserAAdminGroupeUser[$cle]."</br>";
					if ($listeUserAAdminGroupeUser[$cle] == null) {
						echo " pas de groupe ";
					}else if($listeUserAAdminGroupeUser[$cle] == 1){
						// farfadet
						echo " Groupe farfadet ";
					}else {
						echo "groupe non existant";
					}

					// Avatar -- default.jpg
					//echo 	"Avatar -- ".$listeUserAAdminAvatarUser[$cle]."</br>";
					echo "<img src='membres/avatars/".$listeUserAAdminAvatarUser[$cle]."' />";

					//Banniere -- defaultb.jpg
					// echo 	"Banniere -- ".$listeUserAAdminBanniereUser[$cle]."</br>";
					echo "<img src='membres/banniere/".$listeUserAAdminBanniereUser[$cle]."' />";

					//Creation -- 2019-03-18
				  //echo 	"Creation -- ".$listeUserAAdminDateCreation[$cle]."</br>";
					if ($listeUserAAdminDateCreation[$cle] == null){
						//Premiere Connexion Avant Maj 2019-03-19 et Non ReCo Depuis
						echo " PCAM 2019-03-19 NRCD ";
					}else{
						echo " premiere connexion ".$listeUserAAdminDateCreation[$cle]." ";
					}

					// Droit --
					//echo 	"Rôle -- ".$listeUserAAdminIsAdmin[$cle]."</br>";
					if($listeUserAAdminIsAdmin[$cle] == null){
							echo " Membre ";
					}else if($listeUserAAdminIsAdmin[$cle] == 1){
							echo " Modo ";
					}else if ($listeUserAAdminIsAdmin[$cle] == 2) {
							echo " Admin ";
					}

					// Bloquer --
					//echo 	"Bloquer -- ".$listeUserAAdminEtatCompte[$cle]."</br>";
					if ($listeUserAAdminEtatCompte[$cle] == null) {
						echo " non bloquer ";
?>



						<form method="POST" action="">
									<ul>
										<li class="centrer">
												<input type="submit" name="Bloquer<?php echo "".$cle."" ?>" value="bloquer" class="boutonInput" />
										</li>
									</ul>
						</form>

<?php
						if(isset($_POST['Bloquer'.$cle])){
							echo "compte".$cle."";

						}

?>
<?php










					}else if( $listeUserAAdminEtatCompte[$cle] == 1 ){
						echo " compte bloquer";
						echo " motif de bloquage ".$listeUserAAdminMotifBloque[$cle]."";
					}

					// Motif Bloquer --
					//echo 	"Motif Bloquer -- ".$listeUserAAdminMotifBloque[$cle]."</br>";
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
