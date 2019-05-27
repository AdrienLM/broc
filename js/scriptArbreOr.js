var p1;
var p2;
var p3;
var p4;
var p5;
var p6;
var p7;
var tempsTotal = 128; /* DONNÉE À MODIFIER */
    var tempsPasseS = 0;
    var tempsPasseDS = 0;
    var tempsDePause = new Array(100, 161, 369, 624, 824, 1081, 1277); /* DONNÉE À MODIFIER */
    var tempsDeDepart = new Array(100, 161, 369, 624, 824, 1081); /* DONNÉE À MODIFIER */
    var indiceParagrapheCourant = 0;
    var timerAffichage;
    var timerPause;
    var playerAudio;
    var tousLesSons;

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
    playerAudio = document.getElementById("playerAudioConteur");
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
            p7 = scene.children(":nth-child(8)").text();
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

        $(".decouvrir").click(async function(){
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
            $("#arbreOr").css("display", "block");
            await attendre(8000);
            $("#popupArbre").css("display", "block");
            $("#arbreOr").css("cursor", "pointer");
            $("#popupArbre img").click(function(){
                $("#popupArbre").remove();
            });
            $("#arbreOr").click(function(){
                $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles1.png");
                $("#arbreOr").click(function(){
                    $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles2.png");
                    $("#arbreOr").css("cursor", "default");
                    $("#arbreOr").off("click");
                })
            });
        });

        //écouteur sur le bouton suivant
        $("#narrateur div:last-child img").click(async function(){
            $("#narrateur div:last-child img").off();
            $("#narrateur div:last-child").css("display", "none");
            $("#popupArbre").remove();
            $("#arbreOr").css("cursor", "default");
            $("#arbreOr").off("click");
            //changement texte
            /*$(".histoire").replaceWith('<p class="histoire">En les utilisant, ils créaient une potion ramenant à la vie les arbres meurtris par les hommes, brûlés ou déracinés par les tempêtes.<br /><br />Leur recette est toujours secrète. Personne ne peut dire le dosage de cette potion miraculeuse.<br><br>Cependant, nous savons qu’ils faisaient fondre les feuilles merveilleuses dans une eau des plus pure dont personne ne connaît l’origine.</p>');*/
            $(".fondJeu").attr("src", "images/arbreOr/clairiere.jpg");
            $(".histoire").empty();
            $(".histoire").append(p2);
            $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles2.png");
            await attendre(2000);
            $("#lutin1").fadeIn(500);
            $("#lutin2").fadeIn(500);
            await attendre(2000);
            $("#arbreOr").attr("src", "images/arbreOr/arbreDOr.png");
            await attendre (3000);
            $("#lutin1").fadeOut(500);
            $("#lutin2").fadeOut(500);
            $("#narrateur").css("display", "none");
            jeuFeuilles();
            /*$("#zoom").zoomple({
                offset : {x:10,y:10},
                bgColor : '#839CA1',
                zoomWidth : 250,
                showCursor : true,
                zoomHeight : 250,
                roundedCorners : true
            });*/
            $("#narrateur div:last-child").css("display", "flex");
            //écouteur sur le bouton suivant
            $("#narrateur div:last-child img").click(function(){
                $("#narrateur div:last-child img").off();
                $("#narrateur div:last-child").css("display", "none");
                if($("#popupGagne")){
                    $("#popupGagne").remove;
                };
                //changement texte
                /*$("#narrateur .histoire").replaceWith('<p class="histoire">Par une belle journée de printemps, une petite fille était partie ramasser du bois dans la forêt.<br /><br />Lors de sa recherche, elle trouva l’arbre d’or, brillant et mystérieux.<br><br>Fascinée par cet arbre extraordinaire, elle s’en approcha et le toucha.<br /><br />Malheur ! L’arbre ensorcelle ceux qui le touche, les transformant en arbres calcinés. La petite fille subit ce maléfice et est encore aujourd’hui un simple tronc carbonisé.</p>');*/
                $(".histoire").empty();
                $(".histoire").append(p3);
                //disparition de la petite fille
                /*setTimeout(function(){
                    $("#fille").css("display", "block");
                }, 1000);
                    //apparition d'un arbre calciné
                    setTimeout(function(){
                        $("#arbre1").css("display", "block");
                    }, 100);*/
                //écouteur sur le bouton suivant
                $("#narrateur div:last-child").css("display", "flex");
                $("#narrateur div:last-child img").off();
                $("#narrateur div:last-child img").click(async function(){
                    $("#narrateur div:last-child img").off();
                    $("#narrateur div:last-child").css("display", "none");
                    //changement texte
                    /*$("#narrateur .histoire").replaceWith('<p class="histoire">Ne voyant la petite fille revenir, ses trois amis s’inquiétèrent.<br /><br />Les jeunes hommes partirent donc à sa recherche. Après quelques inspections, ils retrouvèrent sa trace.<br><br>C’est ainsi qu’ils virent à leur tour l’incroyable arbre d’or.<br /><br />Hélas, ils firent la même erreur que leur amie et le touchèrent. Ils rejoignirent celle-ci aux côtés de l’arbre magique.</p>');*/
                    $(".histoire").empty();
                    $(".histoire").append(p4);
                    await attendre(2000);
                    //$("#fille").css("display", "block");
                    $("#fille").fadeIn(500);
                    await attendre(8000);
                    $("#fille").css("opacity", "0");
                    $("#fille").css("left", "30%");
                    $("#fille").attr("src", "images/arbreOr/petiteFille.png");
                    $("#fille").css("opacity", "1");
                    await attendre(4000);
                    $("#fille").attr("src", "images/arbreOr/flammes.png");
                    var sonFlammes = document.createElement("audio");
                      sonFlammes.src = "sons/arbreOr/feu.wav";
                      sonFlammes.volume = 0.1;
                      sonFlammes.autoPlay = false;
                      sonFlammes.preLoad = true;
                      sonFlammes.controls = true;
                    
                    $("#fille").attr("src", "images/arbreOr/tronc3-6.png");
                    await attendre(1000);
                    $("#fille").css("transition", "none");
                    $("#fille").css("height", "20%");
                    $("#fille").css("bottom", "5%");
                    $("#fille").css("left", "35%");
                    sonFlammes.play();
                    await attendre(1000);
                    $("#fille").attr("src", "images/arbreOr/tronc3-5.png");
                    await attendre(1000);
                    $("#fille").attr("src", "images/arbreOr/tronc3-4.png");
                    await attendre(1000);
                    $("#fille").attr("src", "images/arbreOr/tronc3-3.png");
                    await attendre(1000);
                    $("#fille").attr("src", "images/arbreOr/tronc3-2.png");
                    await attendre(1000);
                    $("#fille").attr("src", "images/arbreOr/tronc3-1.png");
                    //apparition de la petite fille
                    /*$("#fille").css("display", "block");
                    //apparition des trois autres arbres calcinés
                    $("#arbre2").css("display", "block");
                    $("#arbre3").css("display", "block");
                    $("#arbre4").css("display", "block");*/
                    //écouteur sur le bouton suivant
                    $("#narrateur div:last-child").css("display", "flex");
                    $("#narrateur div:last-child img").click(async function(){
                        $("#narrateur div:last-child img").off();
                        $("#narrateur div:last-child").css("display", "none");
                        //changement texte
                        /*$("#narrateur .histoire").replaceWith('<p class="histoire">Le lendemain matin, les lutins se rendirent à l’arbre pour leur récolte quotidienne.<br /><br />Ils furent déroutés de ce qu’ils virent : comment étaient apparus ces quatre arbres brûlés ?<br /><br />Malgré leur étonnement, ils ramassèrent les ingrédients nécessaires à leur potion.<br /><br />Soudain, alors que jamais l’arbre n’avait contesté leur présence, il les ensorcela à leur tour.<br /><br />C’est ainsi qu’ils devinrent des pierres et reposèrent aux côtés des quatre enfants et de l’arbre enchanté.</p>');*/
                        $("#fille").css("opacity", "0");
                        $("#arbreOr").css("opacity", "0");
                        $(".fondJeu").attr("src", "images/arbreOr/chemin.jpg");
                        $(".histoire").empty();
                        $(".histoire").append(p5);
                        await attendre(3000);
                        $("#ami1").fadeIn(500);
                        $("#ami2").fadeIn(500);
                        $("#ami3").fadeIn(500);
                        await attendre(5000);
                        /*$(".fondJeu").attr("src", "images/arbreOr/clairiere.jpg");
                        $("#ami1").css("left", "40%");
                        $("#ami1").css("bottom", "0");
                        $("#ami1").css("height", "45%");
                        $("#ami2").css("left", "50%");
                        $("#ami2").css("bottom", "0");
                        $("#ami2").css("height", "45%");
                        $("#ami3").css("left", "60%");
                        $("#ami3").css("bottom", "0");
                        $("#ami3").css("height", "45%");
                        $("#fille").css("opacity", "1");
                        $("#arbreOr").css("opacity", "1");*/
                        $("#ami1").css("opacity", "0");
                        $("#ami2").css("opacity", "0");
                        $("#ami3").css("opacity", "0");
                        $(".fondJeu").attr("src", "images/arbreOr/mains.png");
                        await attendre(1000);
                        $(".fondJeu").css("transform", "scale(1.1)");
                        await attendre(6000);
                        $(".fondJeu").attr("src", "images/arbreOr/clairiere.jpg");
                        $("#fille").css("opacity", "1");
                        $("#arbreOr").css("opacity", "1");
                        await attendre(500);
                        $("#ami1").css("opacity", "1");
                        $("#ami2").css("opacity", "1");
                        $("#ami3").css("opacity", "1");
                        $("#ami1").css("left", "40%");
                        $("#ami1").css("bottom", "0");
                        $("#ami1").css("height", "45%");
                        $("#ami2").css("left", "50%");
                        $("#ami2").css("bottom", "0");
                        $("#ami2").css("height", "45%");
                        $("#ami3").css("left", "60%");
                        $("#ami3").css("bottom", "0");
                        $("#ami3").css("height", "45%");
                        //$("#ami1").attr("src", "images/arbreOr/flammes.png");
                        var sonFlammes = document.createElement("audio");
                          sonFlammes.src = "sons/arbreOr/feu.wav";
                          sonFlammes.volume = 0.5;
                          sonFlammes.autoPlay = false;
                          sonFlammes.preLoad = true;
                          sonFlammes.controls = true;
                        
                        $("#ami2").attr("src", "images/arbreOr/tronc2-5.png");
                        await attendre(1000);
                        $("#ami2").css("height", "20%");
                        $("#ami2").css("bottom", "2%");
                        sonFlammes.play();
                        await attendre(1000);
                        $("#ami2").attr("src", "images/arbreOr/tronc2-4.png");
                        await attendre(1000);
                        $("#ami2").attr("src", "images/arbreOr/tronc2-3.png");
                        await attendre(1000);
                        $("#ami2").attr("src", "images/arbreOr/tronc2-2.png");
                        await attendre(1000);
                        $("#ami2").attr("src", "images/arbreOr/tronc2-1.png");
                        
                        await attendre(500);
                        $("#ami1").attr("src", "images/arbreOr/tronc1-5.png");
                        await attendre(1000);
                        $("#ami1").css("height", "20%");
                        $("#ami1").css("bottom", "5%");
                        sonFlammes.play();
                        await attendre(1000);
                        $("#ami1").attr("src", "images/arbreOr/tronc1-4.png");
                        await attendre(1000);
                        $("#ami1").attr("src", "images/arbreOr/tronc1-3.png");
                        await attendre(1000);
                        $("#ami1").attr("src", "images/arbreOr/tronc1-2.png");
                        await attendre(1000);
                        $("#ami1").attr("src", "images/arbreOr/tronc1-1.png");
                        
                        await attendre(500);
                        $("#ami3").attr("src", "images/arbreOr/tronc4-5.png");
                        await attendre(1000);
                        $("#ami3").css("height", "20%");
                        $("#ami3").css("bottom", "8%");
                        sonFlammes.play();
                        await attendre(1000);
                        $("#ami3").attr("src", "images/arbreOr/tronc4-4.png");
                        await attendre(1000);
                        $("#ami3").attr("src", "images/arbreOr/tronc4-3.png");
                        await attendre(1000);
                        $("#ami3").attr("src", "images/arbreOr/tronc4-2.png");
                        await attendre(1000);
                        $("#ami3").attr("src", "images/arbreOr/tronc4-1.png");
                        //apparition des pierres
                        /*$(".pierres").css("display", "block");*/
                        //écouteur sur le bouton suivant
                        $("#narrateur div:last-child").css("display", "flex");
                        $("#narrateur div:last-child img").click(async function(){
                            $("#narrateur div:last-child img").off();
                            $("#narrateur div:last-child").css("display", "none");
                            //changement texte
                            /*$("#narrateur .histoire").replaceWith('<p class="histoire">Depuis ce jour, le lieu est resté figé. Des arbres calcinés et des pierres entourent un arbre d’or sur lequel plus une seule feuille ne pousse.<br><br>Cependant, il existerait un moyen de conjurer le sort.<br /><br />Si quelqu’un perçait le secret de la potion magique gardé par les lutins, ceux-ci, la petite fille et ses trois amis seraient délivrés.');*/
                            $(".histoire").empty();
                            $(".histoire").append(p6);
                            $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles2.png");
                            await attendre(2000);
                            $("#lutin1").fadeIn(500);
                            $("#lutin2").fadeIn(500);
                            await attendre(12000);
                            $("#arbreOr").attr("src", "images/arbreOr/arbreOrFeuilles1.png");
                            $("#lutin1").attr("src", "images/arbreOr/lutin1Pierre.png");
                            await attendre(500);
                            $("#lutin2").attr("src", "images/arbreOr/lutin2Pierre.png");
                            await attendre(500);
                            $("#lutin1").css("bottom", "10%");
                            $("#lutin1").css("transform", "rotateZ(50deg)");
                            $("#lutin2").css("transform", "rotateZ(-50deg)");
                            $("#narrateur div:last-child").css("display", "flex");
                            //écouteur sur le bouton suivant
                            $("#narrateur div:last-child img").click(async function(){
                                $("#narrateur div:last-child").css("display", "none");
                                $("#narrateur div:last-child img").off();
                                //changement texte
                                /*$("#narrateur .histoire").replaceWith('<p class="histoire">Voudrais-tu essayer de les libérer ?<br /><br />Si tu le souhaites, des feuilles d’or se trouveraient dans les environs…</p>');*/
                                $(".histoire").empty();
                                $(".histoire").append(p7);
                                await attendre(2000);
                                $("#lutin1").attr("src", "images/arbreOr/lutin1Mousse.png").fadeIn(4000);
                                $("#lutin2").attr("src", "images/arbreOr/lutin2Mousse.png").fadeIn(4000);
                                $("#arbreOr").attr("src", "images/arbreOr/arbreDOr.png").fadeIn(4000);
                                $("#narrateur div:last-child img").replaceWith('<a href="cheminAventure.php"><img src="images/check.svg" alt="icone check" /></a>');
                                    $("#narrateur div:last-child p").text("Fin");
                                $("#narrateur div:last-child").css("display", "flex");
                                //écouteur sur le bouton suivant
                                /*$("#narrateur div:last-child img").click(function(){
                                    //jeu pour retrouver les feuilles d'or
                                    //changement de la boite de dialogue narrateur
                                    /*$("#narrateur").css("width", "20%");
                                    $("#narrateur div:first-child").css("width", "30%");
                                    $("#narrateur div:first-child").css("margin-left", "calc(50% - 15%)");
                                    $("#narrateur h3").text("Jeu");
                                    $("#narrateur div:first-child img").attr("src", "images/console.svg");
                                    $("#narrateur div:first-child img").attr("alt", "manette de console");
                                    $("#narrateur .histoire").replaceWith('<p class="histoire">Retrouve les feuilles d\'or dissimulées dans le décor</p>');*/
                                    //apparition des feuilles d'or
                                    /*$("#feuille1").css("opacity", "1");
                                    $("#feuille2").css("opacity", "1");
                                    $("#feuille3").css("opacity", "1");*/
                                    //changement du bouton suivant en passer
                                    /*$("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/flecheD.svg" alt="flèche vers la droite" /></a>');
                                    $("#narrateur div:last-child p").text("Passer");*/
                                    //écouteur sur les feuilles d'or
                                   /*var nbFeuilles = 0; $(".feuilles").click(function(){
                                        $(this).remove();
                                       nbFeuilles++;

                                    })*/
                                    //attendre que les feuilles soient ramassées
                                    /*while(nbFeuilles<3){
                                        //ne rien faire
                                        $("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/flecheD.svg" alt="flèche vers la droite"></a>');
                                        $("#narrateur div:last-child p").text("Passer");
                                    }*/
                                    //changement du bouton passer en terminé
                                    /*$("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/check.svg" alt="icone check" /></a>');
                                    $("#narrateur div:last-child p").text("Terminé");*/
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
function attendreFinSon() {
    return new Promise(function(resolve) {
        while(!playerAudio.paused) {
            resolve()
        }
    })
}

function attendre(temps) {
    return new Promise(function(resolve) {
        setTimeout(function () {
            resolve()
        }, temps);
    })
}

function jeuFeuilles(){
    if($("#popupFeuilles")){
        $("#popupFeuilles").css("display", "block");
        $("#popupFeuilles img").click(function(){
            $(".fondJeu").attr("src", "images/arbreOr/clairiereFeuilles.jpg");
            $(".feuilles").css("display", "block");
            $("#popupJeu").css("display", "block");
            $("#popupFeuilles").remove();
            var f1 = true;
            var f2 = true;
            var f3 = true;

            $("#popupJeu div:last-child img").click(function(){
                $("#popupJeu").remove();
                $("#popupGagne").remove();
                $("#narrateur").css("display", "block");
                $(".feuilles").remove();
                f1 = false;
                f2 = false;
                f3 = false;
                $(".fondJeu").attr("src", "images/arbreOr/clairiere.jpg");
            });
            
            $("#popupJeu div:first-child").click(loupe);
            
            $("#feuille1").click(async function(){
                f1 = false;
                var obj = document.createElement("audio");
                  obj.src = "sons/arbreOr/pickingFlower.wav";
                  obj.volume = 0.5;
                  obj.autoPlay = false;
                  obj.preLoad = true;
                  obj.controls = true;
                obj.play();
                $("#feuille1").remove();
                if(f2 && f3){
                    $(".fondJeu").attr("src", "images/arbreOr/clairiereF23.jpg");
                    $("#zoom img").attr("src", "images/arbreOr/clairiereF23.jpg");
                }else if(f2 && !f3){
                    $(".fondJeu").attr("src", "images/arbreOr/clairiereF2.jpg");
                    $("#zoom img").attr("src", "images/arbreOr/clairiereF2.jpg");
                }else if(!f2 && f3){
                    $(".fondJeu").attr("src", "images/arbreOr/clairiereF3.jpg");
                   $("#zoom img").attr("src", "images/arbreOr/clairiereF3.jpg");
                }else if(!f2 && !f3){
                    $(".fondJeu").attr("src", "images/arbreOr/clairiere.jpg");
                    $("#zoom img").attr("src", "images/arbreOr/clairiere.jpg");
                    $("#zoom").css("display", "none");
                    await attendre(2000);
                    var obj = document.createElement("audio");
                      obj.src = "sons/arbreOr/magie.wav";
                      obj.volume = 0.1;
                      obj.autoPlay = false;
                      obj.preLoad = true;
                      obj.controls = true;
                    obj.play();
                    $("#popupGagne").css("display", "block");
                    $("#popupGagne img").click(function(){
                        $("#popupGagne").remove();
                        $("#popupJeu").remove();
                        $("#narrateur").css("display", "block");
                    });
                }
            });
            $("#feuille2").click(async function(){
                f2 = false;
                var obj = document.createElement("audio");
                  obj.src = "sons/arbreOr/pickingFlower.wav";
                  obj.volume = 0.5;
                  obj.autoPlay = false;
                  obj.preLoad = true;
                  obj.controls = true;
                obj.play();
                $("#feuille2").remove();
                if(f1 && f3){
                    $(".fondJeu").attr("src", "images/arbreOr/clairiereF13.jpg");
                    $("#zoom img").attr("src", "images/arbreOr/clairiereF13.jpg");
                }else if(f1 && !f3){
                   $(".fondJeu").attr("src", "images/arbreOr/clairiereF1.jpg");
                   $("#zoom img").attr("src", "images/arbreOr/clairiereF1.jpg");
                }else if(!f1 && f3){
                    $(".fondJeu").attr("src", "images/arbreOr/clairiereF3.jpg");
                    $("#zoom img").attr("src", "images/arbreOr/clairiereF3.jpg");
                }else if(!f1 && !f3){
                    $(".fondJeu").attr("src", "images/arbreOr/clairiere.jpg");
                    $("#zoom img").attr("src", "images/arbreOr/clairiere.jpg");
                    $("#zoom").css("display", "none");
                    await attendre(2000);
                    var obj = document.createElement("audio");
                      obj.src = "sons/arbreOr/magie.wav";
                      obj.volume = 0.1;
                      obj.autoPlay = false;
                      obj.preLoad = true;
                      obj.controls = true;
                    obj.play();
                    $("#popupGagne").css("display", "block");
                    $("#popupGagne img").click(function(){
                        $("#popupGagne").remove();
                        $("#popupJeu").remove();
                        $("#narrateur").css("display", "block");
                    });
                }
            });
            $("#feuille3").click(async function(){
                f3 = false;
                var obj = document.createElement("audio");
                  obj.src = "sons/arbreOr/pickingFlower.wav";
                  obj.volume = 0.5;
                  obj.autoPlay = false;
                  obj.preLoad = true;
                  obj.controls = true;
                obj.play();
                $("#feuille3").remove();
                if(f1 && f2){
                   $(".fondJeu").attr("src", "images/arbreOr/clairiereF12.jpg");
                   $("#zoom img").attr("src", "images/arbreOr/clairiereF12.jpg");
                }else if(f1 && !f2){
                   $(".fondJeu").attr("src", "images/arbreOr/clairiereF1.jpg");
                   $("#zoom img").attr("src", "images/arbreOr/clairiereF1.jpg");
                }else if(!f1 && f2){
                   $(".fondJeu").attr("src", "images/arbreOr/clairiereF2.jpg");
                   $("#zoom img").attr("src", "images/arbreOr/clairiereF2.jpg");
                }else if(!f1 && !f2){
                    $(".fondJeu").attr("src", "images/arbreOr/clairiere.jpg");
                    $("#zoom img").attr("src", "images/arbreOr/clairiere.jpg");
                    $("#zoom").css("display", "none");
                    await attendre(2000);
                    var obj = document.createElement("audio");
                      obj.src = "sons/arbreOr/magie.wav";
                      obj.volume = 0.1;
                      obj.autoPlay = false;
                      obj.preLoad = true;
                      obj.controls = true;
                    obj.play();
                    $("#popupGagne").css("display", "block");
                    $("#popupGagne img").click(function(){
                        $("#popupGagne").remove();
                        $("#popupJeu").remove();
                        $("#narrateur").css("display", "block");
                    });
                }
            });
        });
    }

}

function loupe(){
    $("#zoom").css("display", "block");
    $("#zoom").zoomple({
        offset : {x:10,y:10},
        bgColor : '#839CA1',
        zoomWidth : 250,
        showCursor : true,
        zoomHeight : 250,
        roundedCorners : true
    });
    $("#popupJeu div:first-child").off("click");
    $("#popupJeu div:first-child").click(pasLoupe);
    $("#popupJeu div:last-child img").click(pasLoupe);
}

function pasLoupe(){
    $("#zoom").css("display", "none");
    $("#popupJeu div:first-child").off("click");
    $("#popupJeu div:first-child").click(loupe);
}
