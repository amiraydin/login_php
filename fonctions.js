"use strict";
// confirmer pour continuer (je l'ai utlisé pour la plupart des form)
function continueConfirm() {
    return (
        confirm('Êtes vous sûr de vouloir continuer ?')
    )
}
function startDate(id) {
    document.getElementById(id).value = new Date().toISOString().substring(0, 10);
}
function deleteConfirm() {
    return (
        confirm("Êtes vous sûr de vouloir supprimer ? cette information sera supprimer définitivement !")
    )
}
// #####################
//  header
// #####################
const links = [...document.querySelectorAll("nav a")];
links.forEach((link, index) => {
    link.addEventListener("click", () => {
        link.classList.add("active");
        sessionStorage.setItem("activeIndex", index);
    });
});
window.addEventListener("load", () => {
    const storedIndex = sessionStorage.getItem("activeIndex");
    if (storedIndex !== null) {
        const activeIndex = parseInt(storedIndex);
        links.forEach((link) => {
            link.classList.remove("active");
        });
        if (activeIndex >= 0 && activeIndex < links.length) {
            const activeLink = links[activeIndex];
            activeLink.classList.add("active");
        }
    }
});

// ########################################
//  page login et toutes les champ de type password
// #######################################
var passe = document.getElementById('passinput');
var toggEye = document.getElementById('togeye');
if (toggEye) toggEye.onclick = () => {
    if (passe.type == 'password') {
        toggEye.className = toggEye.className.replace('fa-eye-slash', 'fa-eye');
        // toggEye.classList.remove('fa-eye');
        // toggEye.classList.add('fa-eye-slash');
        passe.setAttribute('type', 'text');
    } else {
        toggEye.className = toggEye.className.replace('fa-eye', 'fa-eye-slash');
        // toggEye.classList.remove('fa-eye-slash');
        // toggEye.classList.add('fa-eye');
        passe.setAttribute('type', 'password');
    }
};
// ################
// Page Compte Info
// ###############
const choseImage = document.getElementById("chose_img");
if (choseImage) choseImage.onchange = function () {
    // e.preventDefault();
    // console.log("file is here");
    document.getElementById("img_form").submit();
}
const modifBtn = document.getElementById("edit_btn");
const saveBtn = document.getElementById("save_btn");
const inputDiv = document.querySelectorAll("input");
let isEditMode = false;
if (modifBtn) modifBtn.onclick = (e) => {
    e.preventDefault();
    isEditMode = !isEditMode;
    if (isEditMode) {
        inputDiv.forEach((el) => {
            el.removeAttribute("disabled");
            el.classList.add("border");
        });
        saveBtn.removeAttribute("hidden");
    } else {
        inputDiv.forEach((el) => {
            el.setAttribute("disabled", true);
            el.classList.remove("border");
        });
        saveBtn.setAttribute("hidden", true);
    }
}