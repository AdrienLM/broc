<?php
session_start();
require 'connexionBDD.php';



if(isset($_SESSION['id']) && $_SESSION['id'] > 0){
		$getid = intval($_SESSION['id']);
		$requser = $pdo->prepare('SELECT * FROM membres WHERE IdUser = ?');
		$requser->execute(array($getid));
		$userinfo = $requser->fetch(PDO::FETCH_ASSOC);
  	$_SESSION['val1'] = 0;

//////////////////////////// FORMULAIRE ROLE ///////////////////////////
				if(isset($_POST['EnvDroit'])){

            $cleRole = $_POST['cleRole'];

						if ($_POST['Droit'] == "Membre" ) {
						//	echo "membre";
							$calcDroit = "NULL";
						}else if($_POST['Droit'] == "Modérateur" ){
						//	echo "modo";
							$calcDroit = 1;
						}else if($_POST['Droit'] == "Admininistrateur" ){
						//	echo "admin";
							$calcDroit = 2;
						}

					$sqlAdminUserRole = "UPDATE membres
																 SET isAdmin = ".$calcDroit."
																 WHERE IdUser = ".$cleRole."";
				 //	echo $sqlAdminUserRole;
					$requserAdminUserRole = $pdo->prepare($sqlAdminUserRole);
					$requserAdminUserRole->execute();
					unset($_POST['EnvDroit']);
				  header('Location: adminUser.php');
			}
///////////////////////////////////////////////////////////////////

//////////////////////// FORMULAIRE BLOQUER //////////////////////
			if(isset($_POST['Bloquer'])){

				$motif = $_POST['Motif'];
				//	echo $motif;
				$cleMotif = $_POST['cleMotif'];

				$sqlAdminUserBloque = "UPDATE membres
															 SET EtatCompte = '1',
																	 MotifBloque = '".$motif."'
															 WHERE IdUser = ".$cleMotif."";
				//echo $sqlAdminUserBloque;
				$requserAdminUserBloque = $pdo->prepare($sqlAdminUserBloque);
				$requserAdminUserBloque->execute();
				unset($_POST['Bloquer']);
				unset($_POST['Motif']);
				header('Location: adminUser.php');
			}
//////////////////////////////////////////////////////////////////

?>

    <!DOCTYPE html>
    <!DOCTYPE html>
    <html lang="fr">

    <!--en-tete de la page: titre et sous-titre-->

    <head>
        <meta charset="utf-8">
        <title>KLEIZ | PANNEL ADMIN</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/styleMenu.css">
        <link rel="stylesheet" href="css/styleAdmin.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
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
        <link rel="manifest" href="images/favicon/manifest.json">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>

    <body>
        <div id="barreNav">

<!-- DEBUT HEADER ADMIN  -->
<header>
    <a href="index.php"><img src="images/logo.png" alt="logo Kleiz" id="logo"></a>
    <nav>
        <a href="index.php">accueil</a>

<?php
            if(isset($_SESSION['id']) AND $userinfo['IdUser'] == $_SESSION['id'])
            {
?>
            <a href="profil.php">
                <div class="profil">
                      <p>Profil</p>
                    <img class="imgUser" src="membres/avatars/<?php echo $userinfo['AvatarUser']; ?>" alt="image du profil utilisateur">
                </div>
            </a>
<?php
            }else{
?>
            <a href="connexion.php" class="co">
                <div class="profil">
                    <p>Connexion</p>
                </div>
            </a>
<?php
            }
?>
           
    </nav>
</header>
<!-- FIN HEADER ADMIN  -->
            
            
            <?php
            if($userinfo['isAdmin'] == 2){
            ?>
            <h1>PANNEL ADMININISTRATEUR</h1>
            <?php
            }else{
            ?>
            <h1>PANNEL MODÉRATEUR</h1>
            <?php
            }
            ?>

            
            
            
        </div>

        <div class="containerTitreUser"><img src="images/laptop.svg" class="" alt="">
            <h1>UTILISATEURS INSCRITS</h1>
        </div>
         <div class="displayGrille">
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



// réinitialisation //


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

                ?>

            <div class="containerUser">

                <?php
// Avatar -- default.jpg
					//echo 	"Avatar -- ".$listeUserAAdminAvatarUser[$cle]."</br>";
					echo "<img class=\"imgProfil fondLogo\" src='membres/avatars/".$listeUserAAdminAvatarUser[$cle]."'/>";

//Banniere -- defaultb.jpg
					// echo 	"Banniere -- ".$listeUserAAdminBanniereUser[$cle]."</br>";
					echo "<img class=\"imgBanniere\" src='membres/banniere/".$listeUserAAdminBanniereUser[$cle]."'/> </br>";
                ?>

                    <div class="fondProfil">


                <?php


                // Pseudo -- aze
					echo 	"Pseudo : ".$listeUserAAdminPseudoUser[$cle]."</br>";

// Mail -- a@aa.com
					echo 	"Mail : ".$listeUserAAdminEmailUser[$cle]."</br>";

// Groupe --
                    // Description --
					//echo 	"Description -- ".$listeUserAAdminDescriptionUser[$cle]."</br>";
					if ($listeUserAAdminDescriptionUser[$cle] == null) {
						echo "Description : aucune</br>";
					}else if($listeUserAAdminDescriptionUser[$cle] != null){
						echo "Description : ".$listeUserAAdminDescriptionUser[$cle]." </br> ";
					}
					//echo 	"Groupe -- ".$listeUserAAdminGroupeUser[$cle]."</br>";
					if ($listeUserAAdminGroupeUser[$cle] == null) {
						echo " Groupe : aucun </br> ";
					}else if($listeUserAAdminGroupeUser[$cle] == 1){
						// farfadet
						echo " Groupe : Korrigan </br> ";
					}else {
						echo "Groupe : non existant </br>";
					}


//Creation -- 2019-03-18
				  //echo 	"Creation -- ".$listeUserAAdminDateCreation[$cle]."</br>";
					if ($listeUserAAdminDateCreation[$cle] == null){
						//Premiere Connexion Avant Maj 2019-03-19 et Non ReCo Depuis
						echo " Inscription : non connecté</br>";
					}else{
						echo " Inscription : ".$listeUserAAdminDateCreation[$cle]." </br>";
					}
?> <hr> <?php
// Droit --
					//echo 	"Rôle -- ".$listeUserAAdminIsAdmin[$cle]."</br>";
					//////////////////// Si MODO //////////////////////
					if($repAdmin['isAdmin'] == 1){
							if($listeUserAAdminIsAdmin[$cle] == null){	echo " Rôle : membre </br>";
							}else if($listeUserAAdminIsAdmin[$cle] == 1){	echo "Rôle :  modérateur </br>";
							}else if ($listeUserAAdminIsAdmin[$cle] == 2) {		echo "Rôle :  admininistrateur </br>"; }



				  //////////////////// Sinon Admin //////////////////////
					}else if($repAdmin['isAdmin'] == 2){
						if($listeUserAAdminIsAdmin[$cle] < 2){
							if($listeUserAAdminIsAdmin[$cle] == null){	echo "Rôle : membre </br>";
							}else if($listeUserAAdminIsAdmin[$cle] == 1){ 	echo "Rôle : modérateur </br>";
							}else if ($listeUserAAdminIsAdmin[$cle] == 2) { 	echo "Rôle : admininistrateur </br>";}
?>

                    <form method="POST" action="">
                        <select name="Droit" size="1">
														<option>Membre</option>
														<option>Modérateur</option>
														<option>Admininistrateur</option>
												</select>
                        <input name="cleRole" value="<?php echo $cle ; ?>" type="hidden" />
                        <input type="submit" name="EnvDroit" value="Modifier les droits" class="boutonInput" />
                    </form>
                    <?php
				  }
				 }

// Bloquer --
					//echo 	"Bloquer -- ".$listeUserAAdminEtatCompte[$cle]."</br>";
					if ($listeUserAAdminEtatCompte[$cle] == null) {
						echo "Statut : non bloqué </br>";
?>
                        <form method="POST" action="">
                            <ul>
                                <li>
                                    <input type="text" name="Motif" class="field-long" placeholder="Motif de bloquage" required="required" />
                                </li>
																<input name="cleMotif" value="<?php echo $cle ; ?>" type="hidden" />
                                <li class="centrer">
                                    <input type="submit" name="Bloquer" value="bloquer" class="boutonInput" />
                                </li>
                            </ul>
                        </form>



<?php

					  }else if( $listeUserAAdminEtatCompte[$cle] == 1 ){
						  echo " Statut : compte bloqué  </br>";
					  	echo " Motif de bloquage : ".$listeUserAAdminMotifBloque[$cle]." </br>";
					  }
                        ?></div><?php
				    	echo "</br></br>";?>
              </div>

<?php
			}


			}else{
			    header('Location: index.php');
			}
      ?>
        </div>
    </body>

    </html>
    <?php
}else{
    header('Location: connexion.php');
}

?>
