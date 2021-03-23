"use strict";

function showTerms() {
    if (document.getElementById("DonorBox").checked && !document.getElementById("BankBox").checked) {
        document.getElementById("terms_agreement").style.display = "inline-block";
        document.getElementById("terms_agreement_label").style.display = "inline-block";
    } else {
        document.getElementById("terms_agreement").style.display = "none";
        document.getElementById("terms_agreement_label").style.display = "none";
    }
}

function chbx(obj) {
    var that = obj;
    if (document.getElementById(that.id).checked == true) {
        document.getElementById('DonorBox').checked = false;
        document.getElementById('BankBox').checked = false;
        document.getElementById(that.id).checked = true;
    }
}

function createEventListeners() {
    if (document.getElementById('DonorBox').addEventListener) {
        document.getElementById('DonorBox').addEventListener("click", chbx(document.getElementById('DonorBox')), false);
        document.getElementById('DonorBox').addEventListener("click", showTerms, false);
    } else if (document.getElementById('DonorBox').attachEvent) {
        document.getElementById('DonorBox').attachEvent("onclick", chbx(document.getElementById('DonorBox')));
        document.getElementById('DonorBox').attachEvent("onclick", showTerms);
    }
    if (document.getElementById('BankBox').addEventListener) {
        document.getElementById('BankBox').addEventListener("click", chbx(document.getElementById('BankBox')), false);
        document.getElementById('BankBox').addEventListener("click", showTerms, false);
    } else if (document.getElementById('BankBox').attachEvent) {
        document.getElementById('BankBox').attachEvent("onclick", chbx(document.getElementById('BankBox')));
        document.getElementById('BankBox').attachEvent("onclick", showTerms);
    }
}


function setUpPage() {
    createEventListeners();
    showTerms();
}

if (window.addEventListener) {
    window.addEventListener("load", setUpPage, false);
} else if (window.attachEvent) {
    window.attachEvent("onload", setUpPage);
}