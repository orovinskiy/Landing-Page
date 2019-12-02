//document.getElementById("guestForm").onsubmit = validate;

let isValid = true;
function validate(){
    isValid = true;
    nameValid("first");
    nameValid("last");
    mail();
    checkLink();
    weMet();
    return isValid;
}

//function to validate how we met is correctly filled out
function weMet(){
    let $meetType = $("#meetType");
    let $text = $("#metLable");
    let $other = $("#other");
    let $otherLabel = $("#otherLabel");

    $meetType.removeClass("alert-danger");
    $text.removeClass("text-danger");
    $other.removeClass("alert-danger");
    $otherLabel.removeClass("text-danger");

    if($meetType.val() === "none"){
        $meetType.addClass("alert-danger");
        $text.addClass("text-danger");
        isValid = false;
    }
    else if ($meetType.val() === "other" && $other.val() ===""){
        $other.addClass("alert-danger");
        $otherLabel.addClass("text-danger");
        isValid = false;
    }
}

// Made for name fields for validation
function nameValid(string){
    let $name = $("#"+string+"Name");
    let $text = $("#"+string+"D");

    $name.removeClass("alert-danger");
    $text.removeClass("text-danger");

    if($name.val() === "" || $name.val().indexOf(" ") !== -1){
        $name.addClass("alert-danger");
        $text.addClass("text-danger");
        isValid = false;
    }
}

// checks if the email has @ and a . and no spaces
function mail() {
    let $email = $("#mail");
    let $text = $("#mailD");
    let $checkMail = $("#agree");

    $email.removeClass("alert-danger");
    $text.removeClass("text-danger");

    if ($email.val() !== "" || $checkMail.prop("checked") === true) {
        if ($email.val().indexOf(" ") !== -1 || $email.val().indexOf("@") === -1 || $email.val().indexOf(".") === -1) {
            $email.addClass("alert-danger");
            $text.addClass("text-danger");
            isValid = false;
        }
    }
}

// checks if the url provided is valid
function checkLink() {
    let $link = $("#linked");
    let $text = $("#linkedD");


    $link.removeClass("alert-danger");
    $text.removeClass("text-danger");

    if ($link.val() !== "") {
        if(jsQuery($link.val()) === false){
            $link.addClass("alert-danger");
            $text.addClass("text-danger");
            isValid = false;
        }
    }
}

// I tried using ajax and it would not work so I used someones query from stack overflow to check for me.
function jsQuery(str) {
    let pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    if (pattern.test(str)) {
        return true;
    }
    return false;
}


// shows the radio buttons for format if clicked;
$("#agree").on("click", function(){
    $("#format").toggleClass("hidden");
});


let $meetType = $("#meetType");
$meetType.on("change",function(){
    if($meetType.val() === "other"){
        $("#other-group").removeClass("hidden");
    }
    else{
        $("#other-group").addClass("hidden");
    }
});

