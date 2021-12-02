"use strict";
var $;
(function () {
    var handler = document.querySelector("#menuHandler");
    var menu = document.querySelector("#menu");
    handler &&
        handler.addEventListener("click", function () {
            $("#menuContainer").css("padding", "15px");
            $(menu).slideToggle();
        });
})();
///$("[data-aos]").parent().addClass("hideOverflowOnMobile");
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
