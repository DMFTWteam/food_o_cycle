
"use strict";

function showContent(elem) {
	// Get the checkbox
	var checkBox = document.getElementById(elem);
	// Get the output text
	var content = document.getElementById("content");

	// If the checkbox is checked, display the output text
	if (checkBox.checked == true){
		text.style.display = "block";
	} else {
		text.style.display = "none";
	}
}


