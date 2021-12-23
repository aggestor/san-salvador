"use strict";
var $;
//handling image uploader by clicking image holder
$("#imageHolder").click(function (e) {
    e.preventDefault();
    $("#packImageUploader").click();
    e.stopImmediatePropagation();
});
$("#packImageUploader").on("change", function (e) {
    var imgTempURL = URL.createObjectURL(e.target.files[0]);
    $("#imageHolder")
        .html("<img src=\"" + imgTempURL + "\" class=\"object-cover h-52\"  alt=\"Some package image example\">");
});
var adminPaths = document.querySelectorAll("[data-path]");
adminPaths && adminPaths.forEach(function (path) {
    var pathname = path.dataset["path"];
    $(path).click(function () {
        if (pathname) {
            window.location.pathname = "/admin" + pathname;
        }
    });
});
console.log(window.location.pathname);
