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
        .html("<img src=\"" + imgTempURL + "\" class=\"object-cover\"  alt=\"Some package image example\">");
});
