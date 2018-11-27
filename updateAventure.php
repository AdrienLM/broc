<?php 
try
{
	// On se connecte à la base de donnée
	$bdd = new PDO('mysql:host=localhost;dbname=18mmi2pj02;charset=utf8','root', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}


/////////////////////////////////////////////////////////////////////////////////
/*
///////////////////Code Des Retour Ajout Utilisateur grimoire////////////////////
1xx = tabresume
2xx = tabherbier
3xx = tabbestiaire

x1x = stick1
x2x = stick2
x3x = stick3

11x = tabresume Resume1

xx1 = Unlock
xx0 = Lock



Posibilité apres le projet de mettre en alphanumérique pour etre a plus que 9 image
*/
////////////////////////////////////////////////////////////////////////////////

$codeGrimoire = 111;
//////////////////////////////////////////////variable a modif//////////////////////////////////////////

//////////////////////////////table à modifié//////////////////////////
//$tabUpdate = "tabresume";
//$tabUpdate = "tabherbier";
//$tabUpdate = "tabbestiaire";





//////////////////////////////image à modif////////////////////////////
//$imageModif = "stick1";
//$imageModif = "stick2";
//$imageModif = "stick3";
//$imageModif = "stick4";
//$imageModif = "stick5";



////////////////////////////image lock unlock//////////////////////////
//$ajoutImage = 1 ;



//////////////////////////////Id du compte////////////////////////////
$idCompteUp = 1 ;

////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////UNLOCK//////////////////////////////////////////////////////
////////////////////////////////////////IF TAB RESUME Unlock////////////////////////////////////////////
if($codeGrimoire == 111){ $tabUpdate = "tabresume";     $imageModif = "Resume1";    $ajoutImage = 1 ;}
if($codeGrimoire == 121){ $tabUpdate = "tabresume";     $imageModif = "Resume2";    $ajoutImage = 1 ;}
if($codeGrimoire == 131){ $tabUpdate = "tabresume";     $imageModif = "Resume3";    $ajoutImage = 1 ;}
if($codeGrimoire == 141){ $tabUpdate = "tabresume";     $imageModif = "Resume4";    $ajoutImage = 1 ;}
if($codeGrimoire == 151){ $tabUpdate = "tabresume";     $imageModif = "Resume5";    $ajoutImage = 1 ;}
////////////////////////////////////////IF TAB HERBIER Unlock///////////////////////////////////////////
if($codeGrimoire == 211){ $tabUpdate = "tabherbier";     $imageModif = "stick1";    $ajoutImage = 1 ;}
if($codeGrimoire == 221){ $tabUpdate = "tabherbier";     $imageModif = "stick2";    $ajoutImage = 1 ;}
if($codeGrimoire == 231){ $tabUpdate = "tabherbier";     $imageModif = "stick3";    $ajoutImage = 1 ;}
if($codeGrimoire == 241){ $tabUpdate = "tabherbier";     $imageModif = "stick4";    $ajoutImage = 1 ;}
if($codeGrimoire == 251){ $tabUpdate = "tabherbier";     $imageModif = "stick5";    $ajoutImage = 1 ;}
////////////////////////////////////////IF TAB Bestiaire Unlock/////////////////////////////////////////
if($codeGrimoire == 311){ $tabUpdate = "tabbestiaire";     $imageModif = "stick1";    $ajoutImage = 1 ;}
if($codeGrimoire == 321){ $tabUpdate = "tabbestiaire";     $imageModif = "stick2";    $ajoutImage = 1 ;}
if($codeGrimoire == 331){ $tabUpdate = "tabbestiaire";     $imageModif = "stick3";    $ajoutImage = 1 ;}
if($codeGrimoire == 341){ $tabUpdate = "tabbestiaire";     $imageModif = "stick4";    $ajoutImage = 1 ;}
if($codeGrimoire == 351){ $tabUpdate = "tabbestiaire";     $imageModif = "stick5";    $ajoutImage = 1 ;}

////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////LOCK//////////////////////////////////////////////////////
////////////////////////////////////////IF TAB RESUME Unlock////////////////////////////////////////////
if($codeGrimoire == 110){ $tabUpdate = "tabresume";     $imageModif = "Resume1";    $ajoutImage = 0 ;}
if($codeGrimoire == 120){ $tabUpdate = "tabresume";     $imageModif = "Resume2";    $ajoutImage = 0 ;}
if($codeGrimoire == 130){ $tabUpdate = "tabresume";     $imageModif = "Resume3";    $ajoutImage = 0 ;}
if($codeGrimoire == 140){ $tabUpdate = "tabresume";     $imageModif = "Resume4";    $ajoutImage = 0 ;}
if($codeGrimoire == 150){ $tabUpdate = "tabresume";     $imageModif = "Resume5";    $ajoutImage = 0 ;}
////////////////////////////////////////IF TAB HERBIER Unlock///////////////////////////////////////////
if($codeGrimoire == 210){ $tabUpdate = "tabherbier";     $imageModif = "stick1";    $ajoutImage = 0 ;}
if($codeGrimoire == 220){ $tabUpdate = "tabherbier";     $imageModif = "stick2";    $ajoutImage = 0 ;}
if($codeGrimoire == 230){ $tabUpdate = "tabherbier";     $imageModif = "stick3";    $ajoutImage = 0 ;}
if($codeGrimoire == 240){ $tabUpdate = "tabherbier";     $imageModif = "stick4";    $ajoutImage = 0 ;}
if($codeGrimoire == 250){ $tabUpdate = "tabherbier";     $imageModif = "stick5";    $ajoutImage = 0 ;}
////////////////////////////////////////IF TAB Bestiaire Unlock/////////////////////////////////////////
if($codeGrimoire == 310){ $tabUpdate = "tabbestiaire";     $imageModif = "stick1";    $ajoutImage = 0 ;}
if($codeGrimoire == 320){ $tabUpdate = "tabbestiaire";     $imageModif = "stick2";    $ajoutImage = 0 ;}
if($codeGrimoire == 330){ $tabUpdate = "tabbestiaire";     $imageModif = "stick3";    $ajoutImage = 0 ;}
if($codeGrimoire == 340){ $tabUpdate = "tabbestiaire";     $imageModif = "stick4";    $ajoutImage = 0 ;}
if($codeGrimoire == 350){ $tabUpdate = "tabbestiaire";     $imageModif = "stick5";    $ajoutImage = 0 ;}



//requete pour mettre a jour les compte//
$requser = $bdd->prepare("UPDATE ".$tabUpdate." SET ".$imageModif." = ".$ajoutImage." WHERE idCompte = ".$idCompteUp);


//echo 'UPDATE tabherbier SET stick2 = 1 WHERE idCompte = 1';//
$requser->execute();
//UPDATE tabherbier SET stick2 = '1' WHERE idCompte = 1;//
/*UPDATE tabherbier
SET stick2 = '1'
WHERE idCompte = 1*///