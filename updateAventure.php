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




UPDATE tabherbier
SET stick2 = '1'
WHERE idCompte = 1