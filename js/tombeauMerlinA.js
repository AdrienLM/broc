/*$(document).ready(function(){
        /$("#param div:first-child img").click(function(){
            if(!document.fullscreenElement){
                document.documentElement.requestFullscreen();
            })
        }/

        $(".decouvrir").click(function(){
            $("#texte").css("transform", "scale(0.7) translate(-40%, -35%)");
            $("#texte").css("transition", "all 1s linear");
            $("#param div:last-child p").text("Son");
            $("#param div:last-child img").attr("src", "images/hautParleur.svg");
            $("#texte div:nth-child(2)").remove();
            $("#retour").remove();
            $("#carte").css("transform", "scale(0.6) translate(-255%, 40%)");
            $("#carte").css("transition", "all 1s linear");
            setTimeout(function(){
                $("#jeu").fadeIn(500);
            }, 500);
            $("#jeu").css("transition", "all 1s linear");
            $("#playerAudio").css("transform", "scale(1)");
        });
    });*/



(function() {
    "use strict";
    window.addEventListener("DOMContentLoaded", initialiser);

    function initialiser(evt) {
        document.querySelector("#param>div:first-child>img").addEventListener("click", pleinEcran);
        document.querySelector("#param>div:nth-child(2)").addEventListener("click", transitionDebut);
    }

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

    function pleinEcran(evt) {
         if(!document.fullscreenElement){
                document.documentElement.requestFullscreen();
            }
    }

    function fondu() {
        let divJeu = document.getElementById("jeu");
        divJeu.style.display = "block";
        divJeu.style.opacity = "1";
        divJeu.style.transition = "all 1s linear";
    }
}());