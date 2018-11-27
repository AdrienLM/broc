<?php

try
{
	// On se connecte à la base de donnée
    require("param.inc.php");
	$pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
    $pdo ->query("SET NAMES utf8");
    $pdo ->query("SET CHARACTER SET 'utf-8'");
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
    
}

?>