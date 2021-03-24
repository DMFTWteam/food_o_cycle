"use strict";

function showTerms() {
    if (document.getElementById("cb1").checked && !document.getElementById("cb2").checked) {
        document.getElementById("terms_agreement").style.display = "inline-block";
        document.getElementById("terms_agreement_label").style.display = "inline-block";
    } else {
        document.getElementById("terms_agreement").style.display = "none";
        document.getElementById("terms_agreement_label").style.display = "none";
    }
}

function cbclick(e) {
    e = e || event;
    var cb = e.srcElement || e.target;
    if (cb.type !== 'checkbox') { return true; }
    var cbxs = document.getElementById('radiocb').getElementsByTagName('input'),
        i = cbxs.length;
    cbxs.splice(1, 1);
    i = i--;
    while (i--) {
        if (cbxs[i].type && cbxs[i].type == 'checkbox' && cbxs[i].id !== cb.id) {
            cbxs[i].checked = false;
        }
    }
}

function createEventListeners() {
    if (document.getElementById('cb1').addEventListener) {
        document.getElementById('cb1').addEventListener("click", showTerms, false);
    } else if (document.getElementById('cb1').attachEvent) {
        document.getElementById('cb1').attachEvent("onclick", showTerms);
    }
    if (document.getElementById('cb2').addEventListener) {
        document.getElementById('cb2').addEventListener("click", showTerms, false);
    } else if (document.getElementById('cb2').attachEvent) {
        document.getElementById('cb2').attachEvent("onclick", showTerms);
    }
}


function setUpPage() {
    showTerms();
    createEventListeners();
}

if (window.addEventListener) {
    window.addEventListener("load", setUpPage, false);
} else if (window.attachEvent) {
    window.attachEvent("onload", setUpPage);
}