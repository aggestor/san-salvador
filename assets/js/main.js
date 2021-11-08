"use strict";
var $ = window.$ || globalThis.$;
(function () {
    var handler = document.querySelector("#menuHandler");
    var menu = document.querySelector("#menu");
    if (handler !== null) {
        handler.addEventListener("click", function () {
            console.log("kay");
            $(menu).slideToggle();
        });
    }
    else {
        console.warn("impossibleClickEvent :  document.querySelector(\"#menuHandler\") returns a null value, this maybe due to a wrong selectedElement or and undefined element ");
    }
})();
