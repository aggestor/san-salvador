"use strict";
var $;
(function () {
    var handler = document.querySelector("#menuHandler");
    var menu = document.querySelector("#menu");
    if (handler !== null) {
        handler.addEventListener("click", function () {
            $("#menuContainer").css("height", "350px");
            $("#menuContainer").css("padding", "15px");
            $(menu).slideToggle();
        });
    }
    else {
        console.warn("impossibleClickEvent :  document.querySelector(\"#menuHandler\") returns a null value, this maybe due to a wrong selectedElement or and undefined element ");
    }
})();
$("[data-aos]").parent().addClass("hideOverflowOnMobile");
var toggleButton = document.getElementById("toggle-button");
if (toggleButton) {
    var iconButton_1 = toggleButton.querySelector(".fas");
    var navbar_1 = document.getElementById("navbar");
    toggleButton.addEventListener("click", function () {
        navbar_1 && navbar_1.classList.toggle("hidden");
        if (iconButton_1)
            if (iconButton_1.classList.contains("fa-bars")) {
                iconButton_1.classList.remove("fa-bars");
                iconButton_1.classList.add("fa-times");
            }
            else {
                iconButton_1.classList.remove("fa-times");
                iconButton_1.classList.add("fa-bars");
            }
    });
}