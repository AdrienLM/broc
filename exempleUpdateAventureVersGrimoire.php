<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
        <title class="titre">EXEMPLE</title>
  </head>



<body>
    <?php
     

    //echo 'debut';
    //var_dump($debugQWClass) ;


    require 'connexionBDD.php';

    $_SESSION['id'] = 2;
    //$idCompte = 1;
    $codeGrimoire = 321;
    require 'updateAventureGrimoire.php';
    $codeGrimoire = 331;
    require 'updateAventureGrimoire.php';
    ?>

    


</body>
</html>
