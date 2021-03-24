"use strict";

function showTerms() {
    if (document.getElementById("cb1").checked && !document.getElementById("cb2").checked) {
        document.getElementById("terms_agreement").style.display = "inline-block";
        document.getElementById("terms_agreement_label").style.display = "inline-block";
    } else {
        document.getElementById("terms_agreement").style.display = "none";
        document.getElementById("terms_agreement_label").style.display = "none";
        document.getElementById("terms_agreement").checked = false;
    }
}

function cbclick(e) {
    e = e || event;
    var cb = e.srcElement || e.target;
    if (cb.type !== 'checkbox') { return true; }
    var cbxs = document.getElementById('radiocb').getElementsByTagName('input'),
        i = cbxs.length;
    while (i--) {
        if (cbxs[i].type && cbxs[i].type == 'checkbox' && cbxs[i].id !== cb.id && cbxs[i].id == "terms_agreement") {
            cbxs[i].checked = false;
            showTerms();
        }

    }
}