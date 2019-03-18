    $(document).ready(function(){
        $("#depliant").click(function(){
            $("#menuFlottant").slideToggle();
            var display = $("#menuFlottant").css("display");
            if(display == "block"){
                $("#menuFlottant").css("display", "flex");
            }else if(display == "flex"){
                $("#menuFlottant").css("display", "none");
            }
            $("#menuFlottant").css("display", "flex");
            var image = $(this).attr("src");
            if(image == "images/iconeMenu.svg"){
                $(this).attr("src", "images/croixMenu.svg");
            }else{
                $(this).attr("src", "images/iconeMenu.svg");
            }
            //$("#menuFlottant").css("transition", "all 0.2s linear");
        });
    });
