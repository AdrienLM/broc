(function() {
    "use strict";
    window.addEventListener("DOMContentLoaded", initialiser);

    let divJeu;
    let divNarrateur;
    let brouillard;
    let vivianeEtMerlin;

    function initialiser(evt) {
            /* Ecouteur animation début */
        document.querySelector("#param>div:first-child>img").addEventListener("click", pleinEcran);
        document.querySelector("#param>div:nth-child(2)").addEventListener("click", transitionDebut);

            /*  */
        divJeu = document.getElementById("jeu");
        divNarrateur = document.getElementById("narrateur");
        brouillard = document.createElement("img");
        brouillard.setAttribute("src", "images/brouillardTombeauMerlin.png");
        brouillard.setAttribute("alt", "Brouillard épais");
        /*brouillard.style.width = "100%";*/
        brouillard.style.height = "100%";
        brouillard.style.textAlign = "right";
        divJeu.insertBefore(brouillard, divNarrateur);
    }


        /* Animation début */
    function transitionDebut(evt) {
        let divTexte = document.getElementById("texte");
        divTexte.style.transform = "scale(0.7) translate(-40%, -35%)";
        divTexte.style.transition = "all 1s linear";
        document.querySelector("#param>div:last-child>p").textContent = "Son";
        document.querySelector("#param>div:last-child>img").setAttribute("src", "images/hautParleur.svg");
        document.querySelector("#param>div:last-child>img").setAttribute("alt", "Haut parleur");
        document.querySelector("#param>div:nth-child(2)").remove();
        document.getElementById("retour").remove();
        let divCarte = document.getElementById("carte");
        divCarte.style.transform = "scale(0.6) translate(-255%, 40%)";
        divCarte.style.transition = "all 1s linear";
        window.setTimeout(fondu, 500);
    }

    let booleanPleinEcran = false;
    function pleinEcran(evt) {
        if(!booleanPleinEcran) {
            booleanPleinEcran = true;
            let html = document.querySelector("html");
            if (html.requestFullscreen) {
                html.requestFullscreen();
            } else if (html.mozRequestFullScreen) { /* Firefox */
                html.mozRequestFullScreen();
            } else if (html.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
                html.webkitRequestFullscreen();
            } else if (html.msRequestFullscreen) { /* IE/Edge */
                html.msRequestFullscreen();
            }
        } else {
            booleanPleinEcran = false;
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE/Edge */
                document.msExitFullscreen();
            }
        }
    }

    function fondu() {
        divJeu.style.display = "flex";
        divJeu.style.opacity = "1";
        divJeu.style.transition = "all 1s linear";
    }
}());