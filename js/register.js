"use strict";

function createEventListeners(){
	var box = "DonorBox";
    if (form.addEventListener) {
        form.addEventListener("click", showContent(file), false); 
    } else if (form.attachEvent)  {
        form.attachEvent("onclick", showContent(file));
    }
}


function setUpPage(){
    createEventListeners();
}

if (window.addEventListener) {
  window.addEventListener("load", setUpPage, false); 
} else if (window.attachEvent)  {
  window.attachEvent("onload", setUpPage);
}