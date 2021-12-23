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
var showPackAdminSection = $("#showPackAdminSection");
var addPackAdminSection = $("#addPackAdminSection");
$("#closeShowPackAdmin").click(function () { return showPackAdminSection.slideUp(); });
$("#closeAddPackAdmin").click(function () { return addPackAdminSection.slideUp(); });
$("#btnShowPackSection").click(function () { return showAll(); });
$("#btnAddPackSection").click(function () { return showAdd(); });
function showAll() {
    window.localStorage.setItem("current_admin_pack_window", "show");
    showPackAdminSection.slideDown();
    addPackAdminSection.slideUp();
}
function showAdd() {
    window.localStorage.setItem("current_admin_pack_window", "add");
    addPackAdminSection.slideDown();
    showPackAdminSection.slideUp();
}
$(document).ready(function () {
    var currentPackWindow = window.localStorage.getItem("current_admin_pack_window");
    if (currentPackWindow == "show") {
        showAll();
    }
    else if (currentPackWindow === "add") {
        showAdd();
    }
    else {
        showAll();
    }
});
