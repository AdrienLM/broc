"use strict";
$(document).ready(initialiser);
var numero = sessionStorage.getItem("numero");
if(numero<1||numero>8){
    numero="1";
}

function initialiser(evt) {
    $("h1").empty();
    $("h2").empty();
    $("h3").empty();
    $(".desc").empty();
    $.ajax({
        url: "decouverte.xml",
        dataType: "xml",
        type: "GET",
        success: function(xml){
            var lieu = $(xml).find("lieux").children(":nth-child("+numero+")"); 
            var titre = lieu.children(":first").text();
            $("h1").append(titre);
            var h2 = lieu.children(":nth-child(2)").text();
            $("h2").append(h2);
            var h3 = lieu.children(":nth-child(3)").text();
            $("h3").append(h3);
            var img = lieu.children(":nth-child(4)").text();
            $(".partDroite img:first-child").attr("src", img);
            $(".partDroite img:first-child").attr("alt", h2+h3);
            var desc = lieu.children(":nth-child(5)").text();
            $(".desc").append(desc);
            var carte = lieu.children(":nth-child(6)").text();
            $(".partDroite img:last-child").attr("src", carte);
            var couleur = lieu.children(":nth-child(7)").text();
            $(".partGauche").css("background-color", couleur);
        }
    });
    
    $("#suivant").click(changerPage);
    
    function changerPage(evt){
        var numero2 = parseInt(sessionStorage.getItem("numero")) + 1;
        if(numero2==9){
            numero2 = 1;
        }
        sessionStorage.clear();
        sessionStorage.setItem("numero", numero2);
        $("h1").empty();
        $("h2").empty();
        $("h3").empty();
        $(".desc").empty();
        $.ajax({
            url: "decouverte.xml",
            dataType: "xml",
            type: "GET",
            success: function(xml){
                var lieu = $(xml).find("lieux").children(":nth-child("+numero2+")"); 
                var titre = lieu.children(":first").text();
                $("h1").append(titre);
                var h2 = lieu.children(":nth-child(2)").text();
                $("h2").append(h2);
                var h3 = lieu.children(":nth-child(3)").text();
                $("h3").append(h3);
                var img = lieu.children(":nth-child(4)").text();
                $(".partDroite img:first-child").attr("src", img);
                $(".partDroite img:first-child").attr("alt", h2+h3);
                var desc = lieu.children(":nth-child(5)").text();
                $(".desc").append(desc);
                var carte = lieu.children(":nth-child(6)").text();
                $(".partDroite img:last-child").attr("src", carte);
                var couleur = lieu.children(":nth-child(7)").text();
                $(".partGauche").css("background-color", couleur);
            }
        });
    }
}
