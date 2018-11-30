(function() {
    "use strict";
    window.addEventListener("DOMContentLoaded", initialiser);

    let tempsTotal = 137; /* DONNÉE À MODIFIER */
    let tempsPasseS = 0;
    let tempsPasseDS = 0;
    let tempsDePause = new Array(174, 404, 687, 919, 1192, 1409, 1499); /* DONNÉE À MODIFIER */
    let tempsDeDepart = new Array(174, 404, 687, 919, 1192, 1409); /* DONNÉE À MODIFIER */
    let indiceParagrapheCourant = 0;
    let timerAffichage;
    let timerPause;
    let playerAudio;
    let tousLesSons;

    /* Visualisation des éléments dans le DOM :
        <div nomJS="divPlayer" class="player">
            <span nomJS="containerTexte">Lecture : 0:00  2:02</span>
            <div nomJS="barreTemps" class="barreTemps">
                <div nomJS="divTempsPasse" class="tempsPasse"></div>
                <div nomJS="curseur" class="curseur"></div>
            </div>
        </div>
    */
        /* Créer les éléments, leurs attribuer un style (dynamique) et une calsse si besoin */
    let divPlayer = document.createElement("div");
    divPlayer.classList.add("player");
    let containerTexte = document.createElement("span");
    let barreTemps = document.createElement("div");
    barreTemps.classList.add("barreTemps");
    let divTempsPasse = document.createElement("div");
    divTempsPasse.classList.add("tempsPasse");
    divTempsPasse.style.width = "0";
    let curseur = document.createElement("div");
    curseur.classList.add("curseur");
    curseur.style.left = "0";
function initialiser(evt) {
            /* Placer les éléments dans le DOM */
        containerTexte.appendChild(document.createTextNode("Lecture : 0:00 / "+transformerSecondesEnMinutesSecondes(tempsTotal)));
        divPlayer.appendChild(containerTexte);
        barreTemps.appendChild(divTempsPasse);
        barreTemps.appendChild(curseur);
        divPlayer.appendChild(barreTemps);
        document.getElementById("texte").insertBefore(divPlayer, document.getElementById("texte").querySelector("p"));


        tousLesSons = document.querySelectorAll("audio");
            / Ajouter les écouteurs d'événements */
        document.querySelector("#param>div:nth-child(2)").addEventListener("click", lancementSon);
        document.querySelector("#narrateur>div:last-child").addEventListener("click", paragrapheSuivantEvt);


    }

    function interrupteurSon(evt) {
        for(let unSon of tousLesSons) {
            if(unSon.volume == 1) {
                unSon.volume = 0;
            } else {
                unSon.volume = 1;
            }
        }
    }
function lancementSon(evt) {
        window.setTimeout(timerLancementSon, 1000);
        document.querySelector("#param>div:last-child").addEventListener("click", interrupteurSon);
    }

    function timerLancementSon() {
            /* Lancer le son */
        playerAudio = document.getElementById("playerAudioConteur");
        playerAudio.play();
            /* Lancer les timers */
        timerAffichage = window.setInterval(affichageTemps, 1000);
        timerPause = window.setInterval(arretSon, 100);
    }

    function affichageTemps() {
        tempsPasseS = Math.floor(playerAudio.currentTime);
            /* Arrêter le timer à la fin */
        if(tempsPasseS > tempsTotal) {
            window.clearInterval(timerAffichage);
        }
            /* Mettre à jour le texte affiché */
        containerTexte.textContent = "Lecture : "+transformerSecondesEnMinutesSecondes(tempsPasseS)+" / "+transformerSecondesEnMinutesSecondes(tempsTotal);
            /* Calculer le pourcentage de temps passé et agrandir/déplacer les éléments dynamiques en conséquence */
        let pourcentage = (tempsPasseS * 100 / tempsTotal);
        divTempsPasse.style.width = pourcentage+"%";
        curseur.style.left = pourcentage+"%";
    }
function transformerSecondesEnMinutesSecondes(tempsInitial) {
        let minutes = Math.floor(tempsInitial / 60);
        let secondes = Math.floor(tempsInitial - 60 * minutes);
        if(secondes<10) {
            var tempsTransforme = minutes+":0"+secondes;
        } else {
            var tempsTransforme = minutes+":"+secondes;
        }
        return tempsTransforme;
    }

    function arretSon() {
        tempsPasseDS++;
        if(tempsPasseDS == tempsDePause[indiceParagrapheCourant]) {
            playerAudio.pause();
            indiceParagrapheCourant++;
            window.clearInterval(timerAffichage);
            window.clearInterval(timerPause);
        }
    }

    function paragrapheSuivantEvt(evt) {
        paragrapheSuivant();
    }
function paragrapheSuivant() {
        if(!playerAudio.paused) {
            window.clearInterval(timerPause);
            playerAudio.pause();
            indiceParagrapheCourant++;
        }
        playerAudio.currentTime = (tempsDeDepart[indiceParagrapheCourant - 1] / 10);
        tempsPasseDS = tempsDeDepart[indiceParagrapheCourant - 1];
        playerAudio.play();
        timerAffichage = window.setInterval(affichageTemps, 1000);
        timerPause = window.setInterval(arretSon, 100);
    }
}());