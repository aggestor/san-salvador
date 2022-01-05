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
    $("#imageHolder").html("<img src=\"" + imgTempURL + "\" class=\"object-cover h-52\"  alt=\"Some package image example\">");
});
var adminPaths = document.querySelectorAll("[data-path]");
adminPaths &&
    adminPaths.forEach(function (path) {
        var pathname = path.dataset["path"];
        $(path).click(function () {
            if (pathname) {
                window.location.pathname = "/admin" + pathname;
            }
        });
    });
var showPackAdminSection = $("#showPackAdminSection");
var addPackAdminSection = $("#addPackAdminSection");
var showAdminAdminSection = $("#showAdminAdminSection");
var addAdminAdminSection = $("#addAdminAdminSection");
$("#closeShowPackAdmin").click(function () {
    showPackAdminSection.slideUp();
});
$("#closeAddPackAdmin").click(function () {
    addPackAdminSection.slideUp();
});
$("#btnShowPackSection").click(function () {
    showAll();
});
$("#btnAddPackSection").click(function () {
    showAdd();
});
$("#closeShowAdminAdmin").click(function () {
    showAdminAdminSection.slideUp();
});
$("#closeAddAdminAdmin").click(function () {
    addAdminAdminSection.slideUp();
});
$("#btnShowAdminSection").click(function () {
    showAllAdmin();
});
$("#btnAddAdminSection").click(function () {
    showAddAdmin();
});
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
function showAllAdmin() {
    window.localStorage.setItem("curren_admin_admin_window", "show");
    showAdminAdminSection.slideDown();
    addAdminAdminSection.slideUp();
}
function showAddAdmin() {
    window.localStorage.setItem("curren_admin_admin_window", "add");
    addAdminAdminSection.slideDown();
    showAdminAdminSection.slideUp();
}
$(document).ready(function () {
    var currentPackWindow = window.localStorage.getItem("current_admin_pack_window");
    var currentAdminWindow = window.localStorage.getItem("curren_admin_admin_window");
    if (currentPackWindow == "show") {
        showAll();
    }
    else if (currentPackWindow === "add") {
        showAdd();
    }
    else {
        showAll();
    }
    if (currentAdminWindow == "show") {
        showAllAdmin();
    }
    else if (currentAdminWindow === "add") {
        showAddAdmin();
    }
    else {
        showAllAdmin();
    }
});
