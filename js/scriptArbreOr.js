    $(document).ready(function(){
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
            $("#param div:last-child a").replaceWith('<img src="images/hautParleur.svg" alt="haut parleur">');
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
        //écouteur sur le bouton suivant
        $("#narrateur div:last-child img").click(function(){
            //changement texte
            $(".histoire").replaceWith('<p class="histoire">En les utilisant, ils créaient une potion ramenant à la vie les arbres meurtris par les hommes, brûlés ou déracinés par les tempêtes.<br><br>Leur recette est toujours secrète. Personne ne peut dire le dosage de cette potion miraculeuse.<br><br>Cependant, nous savons qu’ils faisaient fondre les feuilles merveilleuses dans une eau des plus pures dont personne ne connaît l’origine.</p>');
            //apparition de la petite fille
                $("#fille").css("opacity", "1");
            //écouteur sur le bouton suivant
            $("#narrateur div:last-child img").click(function(){
                //changement texte
                $("#narrateur .histoire").replaceWith('<p class="histoire">Par une belle journée de printemps, une petite fille était partie ramasser du bois dans la forêt.<br><br>Lors de sa recherche, elle trouva l’arbre d’or, brillant et mystérieux.<br><br>Fascinée par cet arbre extraordinaire, elle s’en approcha et le toucha.<br><br>Malheur ! L’arbre ensorcelle ceux qui le touche, les transformant en arbres calcinés. La petite fille subit ce maléfice et est encore aujourd’hui un simple tronc carbonisé.</p>');
                //disparition de la petite fille
                    $("#fille").css("opacity", "0");
                    //apparition d'un arbre calciné
                    setTimeout(function(){
                        $("#arbre1").css("opacity", "1");
                    }, 100);
                //écouteur sur le bouton suivant
                $("#narrateur div:last-child img").click(function(){
                    //changement texte
                    $("#narrateur .histoire").replaceWith('<p class="histoire">Ne voyant la petite fille revenir, ses trois amis s’inquiétèrent.<br><br>Les jeunes hommes partirent donc à sa recherche. Après quelques inspections, ils retrouvèrent sa trace.<br><br>C’est ainsi qu’ils virent à leur tour l’incroyable arbre d’or.<br><br>Hélas, ils firent la même erreur que leur amie et le touchèrent. Ils rejoignirent celle-ci aux côtés de l’arbre magique.</p>');
                    //apparition des trois autres arbres calcinés
                    $("#arbre2").css("opacity", "1");
                    $("#arbre3").css("opacity", "1");
                    $("#arbre4").css("opacity", "1");
                    //écouteur sur le bouton suivant
                    $("#narrateur div:last-child img").click(function(){
                        //changement texte
                        $("#narrateur .histoire").replaceWith('<p class="histoire">Le lendemain matin, les lutins se rendirent à l’arbre pour leur récolte quotidienne.<br><br>Ils furent déroutés de ce qu’ils virent : comment étaient apparus ces quatre arbres brûlés ?<br><br>Malgré leur étonnement, ils ramassèrent les ingrédients nécessaires à leur potion.<br><br>Soudain, alors que jamais l’arbre n’avait contesté leur présence, il les ensorcela à leur tour.<br><br>C’est ainsi qu’ils devinrent des pierres et reposèrent aux côtés des quatre enfants et de l’arbre enchanté.</p>');
                        //apparition des pierres
                        $(".pierres").css("opacity", "1");
                        //écouteur sur le bouton suivant
                        $("#narrateur div:last-child img").click(function(){
                            //changement texte
                            $("#narrateur .histoire").replaceWith('<p class="histoire">Depuis ce jour, le lieu est resté figé. Des arbres calcinés et des pierres entourent un arbre d’or sur lequel plus une seule feuille ne pousse.<br><br>Cependant, il existerait un moyen de conjurer le sort.<br><br>Si quelqu’un perçait le secret de la potion magique (gardé par les lutins), la petite fille et ses trois amis seraient délivrés.');
                            //écouteur sur le bouton suivant
                            $("#narrateur div:last-child img").click(function(){
                                //changement texte
                                $("#narrateur .histoire").replaceWith('<p class="histoire">Voudrais-tu essayer de les libérer ?<br><br>Si tu le souhaites, des feuilles d’or se trouveraient dans les environs…</p>');
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
                                    $("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/flecheD.svg" alt="flèche vers la droite"></a>');
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
                                    $("#narrateur div:last-child img").replaceWith('<a href="lancementAventure.php"><img src="images/check.svg" alt="icone check"></a>');
                                    $("#narrateur div:last-child p").text("Terminé");
                                })
                            })
                        })
                    })
                })
            });
        });
    });