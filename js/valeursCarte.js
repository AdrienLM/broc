"use strict";
$(document).ready(initialiser);

function initialiser(evt) {
    $(".pointeur").click(function(){
        var numero = $(this).data("numero");
        sessionStorage.clear();
        sessionStorage.setItem("numero", numero);
    });
}
