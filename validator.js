var valueX = document.getElementById("valueX");
var valueR = document.getElementById("valueR");

var x_validated = false, y_validated = false;

butSend = document.getElementById("butSend");

document.querySelector("#butSend").onclick = function (e) {
    e.preventDefault()
    if (!isNumber(text_field.value) || Math.abs(+text_field.value) > 5 || text_field.value === "") {
        errorY.hidden = false;
    } else if (!isChecked(checkboxes)) {
        errorX.hidden = false;
    } else {
        document.forms.item(0).requestSubmit()
    }
}

function isChecked(massive) {
    // console.log(massive)
    for (let i = 0; i < massive.length; i++) {
        // console.log(massive.item(i))
        if (massive.item(i).checked) {
            return true
        }
    }
    return false
}

var errorX = document.getElementById("errorX");
var errorY = document.getElementById("errorY");

var checkboxes = document.getElementsByClassName("checkbox");

var text_field = document.getElementById("paramY");
text_field.addEventListener("input", validateY);

var r_but_1_0 = document.getElementById("rBut1_0");
var r_but_1_5 = document.getElementById("rBut1_5");
var r_but_2_0 = document.getElementById("rBut2_0");
var r_but_2_5 = document.getElementById("rBut2_5");
var r_but_3_0 = document.getElementById("rBut3_0");
var butSend = document.getElementById("butSend");

var r_buttons = document.getElementsByClassName("r_button");


function isNumber(n) {
    return !isNaN(parseFloat(n)) && !isNaN(n - 0)
}

function validate() {
    if (x_validated && y_validated) {
        butSend.disabled = false;
    } else {
        butSend.disabled = true;
        if (!x_validated) {
            errorX.hidden = false;
        }
        if (!y_validated) {
            errorY.hidden = false;
        }
    }
}

function validateY() {
    if (!isNumber(text_field.value) ||
        text_field.value >= 5 || text_field.value <= -5) {
        y_validated = false;
        errorY.hidden = false;
    } else {
        y_validated = true;
        errorY.hidden = true;
    }
   // validate();
}


function refresh_button_selection() {
    let index, len;
    for (index = 0, len = r_buttons.length; index < len; ++index) {
        let element = r_buttons[index];
        console.log(len + " length")
        console.log(element, index);
        console.log(element.classList.contains("selected"));
        if (element.classList.contains('selected')) {
            element.classList.remove('selected');
        }
    }
}

function r1_0() {
    valueR.value = "1.0";
    refresh_button_selection();
    r_but_1_0.classList.add('selected');
}

function r1_5() {
    valueR.value = "1.5";
    refresh_button_selection();
    r_but_1_5.classList.add('selected');
}

function r2_0() {
    valueR.value = "2.0";
    refresh_button_selection();
    r_but_2_0.classList.add('selected');
}

function r2_5() {
    valueR.value = "2.5";
    refresh_button_selection();
    r_but_2_5.classList.add('selected');
}

function r3_0() {
    valueR.value = "3.0";
    refresh_button_selection();
    r_but_3_0.classList.add('selected');
}



