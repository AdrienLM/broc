! function () {
    "use strict";

    function i(i) {
        $("#menuFlottant").css("display", "block");
        $("#depliant").off().on("click", n), $("main").css("opacity", "0.3")
    }

    function n(n) {
        $("#menuFlottant").css("display", "none");
        $("#depliant").off().on("click", i), $("main").css("opacity", "1")
    }
    $("document").ready(function (n) {
        $(".depliant").on("click", i)
    })
}();
