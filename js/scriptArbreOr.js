    $(document).ready(function(){
        /*$("#param div:first-child img").click(function(){
            if(!document.fullscreenElement){
                document.documentElement.requestFullscreen();
            })
        }*/
            
        $(".decouvrir").click(function(){
            $("#texte").css("transform", "scale(0.7) translate(-40%, -35%)");
            $("#texte").css("transition", "all 1s linear");
            $("#param div:last-child p").text("Son");
            $("#param div:last-child img").attr("src", "images/hautParleur.svg");
            $("#param div:last-child img").attr("alt", "haut parleur");
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
        $("#narrateur div:last-child img").click(function(){
            $(".histoire").replaceWith('<p class="histoire">En les utilisant, ils créaient une potion ramenant à la vie les arbres meurtris par les hommes, brûlés ou déracinés par les tempêtes.<br><br>Leur recette est toujours secrète. Personne ne peut dire le dosage de cette potion miraculeuse.<br><br>Cependant, nous savons qu’ils faisaient fondre les feuilles merveilleuses dans une eau des plus pures dont personne ne connaît l’origine.</p>');
            $("#narrateur div:last-child img").click(function(){
                $("#narrateur .histoire").replaceWith('<p class="histoire">Par une belle journée de printemps, une petite fille était partie ramasser du bois dans la forêt.<br><br>Lors de sa recherche, elle trouva l’arbre d’or, brillant et mystérieux.<br><br>Fascinée par cet arbre extraordinaire, elle s’en approcha et le toucha.<br><br>Malheur ! L’arbre ensorcelle ceux qui le touche, les transformant en arbres calcinés. La petite fille subit ce maléfice et est encore aujourd’hui un simple tronc carbonisé.</p>');
                //ajout de la petite fille
                
                $("#narrateur div:last-child img").click(function(){
                    $("#narrateur .histoire").replaceWith('<p class="histoire">Ne la voyant pas revenir, ses trois amis s’inquiétèrent.<br><br>Les jeunes hommes partirent donc à sa recherche. Après quelques inspections, ils retrouvèrent sa trace.<br><br>C’est ainsi qu’ils virent à leur tour l’incroyable arbre d’or.<br><br>Hélas, ils firent la même erreur que leur amie et le touchèrent. Ils rejoignirent celle-ci aux côtés de l’arbre magique.</p>');
                    //ajout d'un arbre calciné
                    $("#narrateur div:last-child img").click(function(){
                        $("#narrateur .histoire").replaceWith('<p class="histoire">Depuis ce jour, le lieu est resté figé. Des arbres calcinés et des pierres entourent un arbre d’or sur lequel plus une seule feuille ne pousse.<br><br>Cependant, il existerait un moyen de conjurer le sort.<br><br>Si quelqu’un perçait le secret de la potion magique (gardé par les lutins), la petite fille et ses trois amis seraient délivrés.');
                        //ajout des trois autres arbres calcinés
                        $("#narrateur div:last-child img").click(function(){
                            $("#narrateur .histoire").replaceWith('<p class="histoire">Voudrais-tu essayer de les libérer ?<br><br>Si tu le souhaites, des feuilles d’or se trouvent dans les environs…</p>');
                            $("#narrateur div:last-child img").click(function(){
                                //jeu pour retrouver les feuilles d'or
                            })
                        })
                    })
                })
            });
        });
    });