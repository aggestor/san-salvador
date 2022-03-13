"use strict";
var $;
//handling image uploader by clicking image holder
$("#imageHolder").click((e) => {
    e.preventDefault();
    $("#packImageUploader").click();
    e.stopImmediatePropagation();
});
$("#packImageUploader").on("change", (e) => {
    let imgTempURL = URL.createObjectURL(e.target.files[0]);
    $("#imageHolder").html(`<img src="${imgTempURL}" class="object-cover h-52"  alt="Some package image example">`);
});
const adminPaths = document.querySelectorAll("[data-path]");
adminPaths &&
    adminPaths.forEach((path) => {
        const pathname = path.dataset["path"];
        $(path).click(() => {
            if (pathname) {
                if (pathname == "local") {
                    window.location.pathname = "/";
                }
                else {
                    window.location.pathname = "/admin" + pathname;
                }
            }
        });
    });
const showPackAdminSection = $("#showPackAdminSection");
const addPackAdminSection = $("#addPackAdminSection");
const showAdminAdminSection = $("#showAdminAdminSection");
const addAdminAdminSection = $("#addAdminAdminSection");
$("#closeShowPackAdmin").click(() => {
    showPackAdminSection.slideUp();
});
$("#closeAddPackAdmin").click(() => {
    addPackAdminSection.slideUp();
});
$("#btnShowPackSection").click(() => {
    showAll();
});
$("#btnAddPackSection").click(() => {
    showAdd();
});
$("#closeShowAdminAdmin").click(() => {
    showAdminAdminSection.slideUp();
});
$("#closeAddAdminAdmin").click(() => {
    addAdminAdminSection.slideUp();
});
$("#btnShowAdminSection").click(() => {
    showAllAdmin();
});
$("#btnAddAdminSection").click(() => {
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
$(document).ready(() => {
    const currentPackWindow = window.localStorage.getItem("current_admin_pack_window");
    const currentAdminWindow = window.localStorage.getItem("curren_admin_admin_window");
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
/**
 * This function handles the admin time each minutes.
 */
const timeHandler = () => {
    const time = new Date;
    const adminTimer = document.querySelector("#adminTimer");
    const hours = time.getHours() < 10 ? "0" + time.getHours() : time.getHours();
    const minutes = time.getMinutes() < 10 ? "0" + time.getMinutes() : time.getMinutes();
    if (adminTimer) {
        adminTimer.textContent = `${hours} : ${minutes}`;
    }
};
setInterval(() => timeHandler(), 5000);
const showers = document.querySelectorAll(".showModal");
showers &&
    showers.forEach((shower) => {
        shower.addEventListener("click", (e) => {
            e.preventDefault();
            const target = e.target;
            if (target) {
                $(".modal").attr("action", shower.dataset["act"]);
                if (shower.dataset['act'])
                    window.location.hash = shower.dataset["act"];
                $(".modal").slideDown();
            }
        });
    });
const hiders = document.querySelectorAll(".hideModal");
hiders && hiders.forEach(hider => {
    hider.addEventListener("click", () => {
        $(".modal").slideUp();
        window.location.href = "/admin/validate/cashout-" + $(hider).data("page");
    });
});
(function () {
    const hash = window.location.hash;
    if (hash) {
        const data = hash.split("#")[1];
        console.log(data);
        $(`[data-act="${data}"]`).click();
    }
})();
