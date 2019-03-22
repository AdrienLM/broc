var p1;
var p2;
var p3;
var p4;
var p5;
var p6;
var p7;
let tempsTotal = 128; /* DONNÉE À MODIFIER */
    let tempsPasseS = 0;
    let tempsPasseDS = 0;
    let tempsDePause = new Array(100, 161, 369, 624, 824, 1081, 1277); /* DONNÉE À MODIFIER */
    let tempsDeDepart = new Array(100, 161, 369, 624, 824, 1081); /* DONNÉE À MODIFIER */
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

$(document).ready(function(){
    /*var numero = sessionStorage.getItem("numero");
    if(numero<1||numero>8){
        numero="1";
    }*/
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
    $.ajax({
        url: "aventure.xml",
        dataType: "xml",
        type: "GET",
        success: function(xml){
            var scene = $(xml).find("livre").children(":nth-child("+numero+")"); 
            var titre = scene.children(":first").text();
            $("h1").append(titre);
            var h2 = "scene "+numero;
            $("#texte h2").append(h2);
            //var nbParagraphes = parseInt(scene.children().length) - 1;
            var nbParagraphes = 6;
            p1 = scene.children(":nth-child(2)").text();
            $(".histoire").append(p1);
            p2 = scene.children(":nth-child(3)").text();
            p3 = scene.children(":nth-child(4)").text();
            p4 = scene.children(":nth-child(5)").text();
            p5 = scene.children(":nth-child(6)").text();
            p6 = scene.children(":nth-child(7)").text();
            p6 = scene.children(":nth-child(8)").text();
        }
    });
    var numero="2";
        $("#param div:first-child img").click(function(){
            let booleanPleinEcran = false;
            if(!booleanPleinEcran) {
                booleanPleinEcran = true;
                let html = document.querySelector("html");
                if (html.requestFullscreen) {
                    html.requestFullscreen();
                } else if (html.mozRequestFullScreen) { /* Firefox /
                    html.mozRequestFullScreen();
                } else if (html.webkitRequestFullscreen) { / Chrome, Safari & Opera /
                    html.webkitRequestFullscreen();
                } else if (html.msRequestFullscreen) { / IE/Edge /
                    html.msRequestFullscreen();
                }
            } else {
                booleanPleinEcran = false;
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) { / Firefox /
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) { / Chrome, Safari and Opera /
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) { / IE/Edge */
                    document.msExitFullscreen();
                }
            }
        })
    
        $(".decouvrir").click(function(){
            $("#texte").css("transform", "scale(0.7) translate(-40%, -35%)");
            $("#texte").css("transition", "all 1s linear");
            $("#param div:last-child p").text("Son");
            $("#param div:last-child a").replaceWith('<img src="images/hautParleur1.svg" alt="haut parleur">');
            $("#texte #param>div:nth-child(2)").remove();
            $("#retour").remove();
            $("#carte").css("transform", "scale(0.6) translate(-255%, 40%)");
            $("#carte").css("transition", "all 1s linear");
            setTimeout(function(){
                $("#jeu").fadeIn(500);
            }, 500);
            $("#jeu").css("transition", "all 1s linear");
            $("#playerAudio").css("transform", "scale(1)");
            /*setTimeout(function(){
                $("#arbreOr").css("opacity", "1");    
            }, 3000);
            setTimeout(function(){
                $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles1.png");
            }, 3500);
            setTimeout(function(){
                $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles2.png");
            }, 3600);*/
            //window.setTimeout(apparition, 4000);
            /*if(playerAudio.paused){
                $("#arbreOr").css("display", "block");
                $("#popupArbre").css("display", "block");
                $("#popupArbre img").click(function(){
                    $("#popupArbre").remove();
                });
                $("#arbreOr").click(function(){
                    $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles1.png");
                    $("#arbreOr").click(function(){
                        $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles2.png");
                    })
                });
            }*/
            while(!playerAudio.paused){
                
            }
            $("#arbreOr").css("display", "block");
            $("#popupArbre").css("display", "block");
            $("#popupArbre img").click(function(){
                $("#popupArbre").remove();
            });
            $("#arbreOr").click(function(){
                $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles1.png");
                $("#arbreOr").click(function(){
                    $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles2.png");
                })
            });
        });
    
        function grandirArbre(evt){
            $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles1.png");
            $(this).off("click", grandirArbre);
            $(this).click(function(){
                $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles2.png");
            })
        }
    
        //écouteur sur le bouton suivant
        $("#narrateur div:last-child img").click(function(){
            //changement texte
            /*$(".histoire").replaceWith('<p class="histoire">En les utilisant, ils créaient une potion ramenant à la vie les arbres meurtris par les hommes, brûlés ou déracinés par les tempêtes.<br /><br />Leur recette est toujours secrète. Personne ne peut dire le dosage de cette potion miraculeuse.<br><br>Cependant, nous savons qu’ils faisaient fondre les feuilles merveilleuses dans une eau des plus pure dont personne ne connaît l’origine.</p>');*/
            $("#jeu").css("background-image", "url(images/arbreOr/clairiere.jpg)");
            $(".histoire").empty();
            $(".histoire").append(p2);
            $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles2.png");
            setTimeout(function(){
                $("#lutin2").css("display", "block");
            }, 2000);
            $("#zoom").zoomple({
                offset : {x:10,y:10},
                bgColor : '#839CA1', 
                zoomWidth : 250, 
                showCursor : true, 
                zoomHeight : 250,
                roundedCorners : true
            });
            //écouteur sur le bouton suivant
            $("#narrateur div:last-child img").click(function(){
                //changement texte
                /*$("#narrateur .histoire").replaceWith('<p class="histoire">Par une belle journée de printemps, une petite fille était partie ramasser du bois dans la forêt.<br /><br />Lors de sa recherche, elle trouva l’arbre d’or, brillant et mystérieux.<br><br>Fascinée par cet arbre extraordinaire, elle s’en approcha et le toucha.<br /><br />Malheur ! L’arbre ensorcelle ceux qui le touche, les transformant en arbres calcinés. La petite fille subit ce maléfice et est encore aujourd’hui un simple tronc carbonisé.</p>');*/
                $(".histoire").empty();
                $(".histoire").append(p3);
                //disparition de la petite fille
                setTimeout(function(){
                    $("#fille").css("display", "block");
                }, 1000);
                    //apparition d'un arbre calciné
                    setTimeout(function(){
                        $("#arbre1").css("display", "block");
                    }, 100);
                //écouteur sur le bouton suivant
                $("#narrateur div:last-child img").click(function(){
                    //changement texte
                    /*$("#narrateur .histoire").replaceWith('<p class="histoire">Ne voyant la petite fille revenir, ses trois amis s’inquiétèrent.<br /><br />Les jeunes hommes partirent donc à sa recherche. Après quelques inspections, ils retrouvèrent sa trace.<br><br>C’est ainsi qu’ils virent à leur tour l’incroyable arbre d’or.<br /><br />Hélas, ils firent la même erreur que leur amie et le touchèrent. Ils rejoignirent celle-ci aux côtés de l’arbre magique.</p>');*/
                    $(".histoire").empty();
                    $(".histoire").append(p4);
                    //apparition de la petite fille
                    $("#fille").css("display", "block");
                    //apparition des trois autres arbres calcinés
                    $("#arbre2").css("display", "block");
                    $("#arbre3").css("display", "block");
                    $("#arbre4").css("display", "block");
                    //écouteur sur le bouton suivant
                    $("#narrateur div:last-child img").click(function(){
                        //changement texte
                        /*$("#narrateur .histoire").replaceWith('<p class="histoire">Le lendemain matin, les lutins se rendirent à l’arbre pour leur récolte quotidienne.<br /><br />Ils furent déroutés de ce qu’ils virent : comment étaient apparus ces quatre arbres brûlés ?<br /><br />Malgré leur étonnement, ils ramassèrent les ingrédients nécessaires à leur potion.<br /><br />Soudain, alors que jamais l’arbre n’avait contesté leur présence, il les ensorcela à leur tour.<br /><br />C’est ainsi qu’ils devinrent des pierres et reposèrent aux côtés des quatre enfants et de l’arbre enchanté.</p>');*/
                        $("#jeu").css("background-image", "images/arbreOr/chemin.jpg");
                        $(".histoire").empty();
                        $(".histoire").append(p5);
                        setTimeout(function(){
                            $("#jeu").css("background-image", "url(images/arbreOr/clairiere.jpg)");
                        }, 5000);
                        //apparition des pierres
                        $(".pierres").css("display", "block");
                        //écouteur sur le bouton suivant
                        $("#narrateur div:last-child img").click(function(){
                            //changement texte
                            /*$("#narrateur .histoire").replaceWith('<p class="histoire">Depuis ce jour, le lieu est resté figé. Des arbres calcinés et des pierres entourent un arbre d’or sur lequel plus une seule feuille ne pousse.<br><br>Cependant, il existerait un moyen de conjurer le sort.<br /><br />Si quelqu’un perçait le secret de la potion magique gardé par les lutins, ceux-ci, la petite fille et ses trois amis seraient délivrés.');*/
                            $(".histoire").empty();
                            $(".histoire").append(p6);
                            //écouteur sur le bouton suivant
                            $("#narrateur div:last-child img").click(function(){
                                //changement texte
                                /*$("#narrateur .histoire").replaceWith('<p class="histoire">Voudrais-tu essayer de les libérer ?<br /><br />Si tu le souhaites, des feuilles d’or se trouveraient dans les environs…</p>');*/
                                $(".histoire").empty();
                                $(".histoire").append(p7);
                                //écouteur sur le bouton suivant
                                $("#narrateur div:last-child img").click(function(){
                                    //jeu pour retrouver les feuilles d'or
                                    //changement de la boite de dialogue narrateur
                                    $("#narrateur").css("width", "20%");
                                    $("#narrateur div:first-child").css("width", "30%");
                                    $("#narrateur div:first-child").css("margin-left", "calc(50% - 15%)");
                                    $("#narrateur h3").text("Jeu");
                                    $("#narrateur div:first-child img").attr("src", "images/console.svg");
                                    $("#narrateur div:first-child img").attr("alt", "manette de console");
                                    $("#narrateur .histoire").replaceWith('<p class="histoire">Retrouve les feuilles d\'or dissimulées dans le décor</p>');
                                    //apparition des feuilles d'or
                                    $("#feuille1").css("opacity", "1");
                                    $("#feuille2").css("opacity", "1");
                                    $("#feuille3").css("opacity", "1");
                                    //changement du bouton suivant en passer
                                    $("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/flecheD.svg" alt="flèche vers la droite" /></a>');
                                    $("#narrateur div:last-child p").text("Passer");
                                    //écouteur sur les feuilles d'or
                                   var nbFeuilles = 0; $(".feuilles").click(function(){
                                        $(this).remove();
                                       nbFeuilles++;
                                        
                                    })
                                    //attendre que les feuilles soient ramassées
                                    /*while(nbFeuilles<3){
                                        //ne rien faire
                                        $("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/flecheD.svg" alt="flèche vers la droite"></a>');
                                        $("#narrateur div:last-child p").text("Passer");
                                    }*/
                                    //changement du bouton passer en terminé
                                    $("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/check.svg" alt="icone check" /></a>');
                                    $("#narrateur div:last-child p").text("Terminé");
                                })
                            })
                        })
                    })
                })
            });
        });
    });
function interrupteurSon(evt) {
        for(let unSon of tousLesSons) {
            if(unSon.volume == 1) {
                unSon.volume = 0;
                $("#param div:last-child img").attr("src", "images/hautParleur.svg");
            } else {
                unSon.volume = 1;
                $("#param div:last-child img").attr("src", "images/hautParleur1.svg");
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