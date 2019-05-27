<header>

    <nav>
        <a href="index.php">accueil</a>
        <a href="soon.php">guide</a>
        <a href="choixModes.php">modes</a>







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
                    <a href="connexion.php">
                        <div class="profil">
                            <p>Connexion</p>
                        </div>
                    </a>
                    <?php
            }
            ?>






                        <img src="images/iconeMenu.svg" alt="icone menu" id="depliant">
                        <ul id="menuFlottant">
                            <li>
                                <a href="carte.php">
                           <img src="images/carte.svg" alt="carte">
                       </a>
                                <p>Carte</p>
                            </li>
                            <li>
                                
                                
                                
                                <?php
            if(isset($_SESSION['id']) AND $userinfo['IdUser'] == $_SESSION['id']) 
            {
            ?>
<li>
                                <a href="deconnexion.php">
                           <img src="images/power.svg" alt="quitter">
                       </a>
                <p>Déconnexion</p>
</li>
                <?php
            }else{
            ?>
                            <li>
                                <a href="inscription.php">
                           <img src="images/userNonCompte.svg" alt="quitter">
                       </a>
                    <p>Inscription</p>
                                </li>
                    <?php
            }
            ?>
                                
                                
                                
                            
                            <li>
                                <!-- <a href="parametres.php"> -->
                                <a href="soon.php">
                           <img src="images/engrenage.svg" alt="engrenage">
                       </a>
                                <p>Paramètres</p>
                            </li>
                        </ul>
    </nav>
</header>
