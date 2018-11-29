    $(document).ready(function(){
        $("#param div:first-child img").click(function(){
            if(!document.fullscreenElement){
                document.documentElement.requestFullscreen();
            })
        }
            
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
        });
    });