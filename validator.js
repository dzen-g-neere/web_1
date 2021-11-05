var valueR = document.getElementById("valueR");

var errorX = document.getElementById("errorX");
var errorY = document.getElementById("errorY");

var checkboxes = document.getElementsByClassName("checkbox");

var text_field = document.getElementById("paramY");

var r_but_1_0 = document.getElementById("rBut1_0");
var r_but_1_5 = document.getElementById("rBut1_5");
var r_but_2_0 = document.getElementById("rBut2_0");
var r_but_2_5 = document.getElementById("rBut2_5");
var r_but_3_0 = document.getElementById("rBut3_0");

var r_buttons = document.getElementsByClassName("r_button");

document.querySelector("#butSend").onclick = function (event) {
    event.preventDefault()
    if (!isNumber(text_field.value) || Math.abs(text_field.value) > 5 ||
        text_field.value === "" || !isChecked(checkboxes)) {
        errorY.hidden = true;
        errorX.hidden = true;
        if(!isNumber(text_field.value) || Math.abs(text_field.value) > 5 ||
            text_field.value === ""){
            errorY.hidden = false;
        }
        if(!isChecked(checkboxes)){
            errorX.hidden = false;
        }
    } else {
        document.forms.item(0).requestSubmit()
    }
}

function isChecked(container) {
    for (let i = 0; i < container.length; i++) {
        if (container.item(i).checked) {
            return true
        }
    }
    return false
}

function isNumber(n) {
    return !isNaN(parseFloat(n)) && !isNaN(n - 0)
}

function refresh_button_selection() {
    let index, len;
    for (index = 0, len = r_buttons.length; index < len; ++index) {
        let element = r_buttons[index];
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



