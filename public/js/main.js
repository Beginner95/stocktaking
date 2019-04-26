document.addEventListener('DOMContentLoaded', function(){

});

/* Functions */

function getId(id){
    return document.getElementById(id);
}

function getCN(cn){
    return document.getElementsByClassName(cn);
}

function getQS(qs){
    return document.querySelector(qs);
}

function cE(cE){
    return document.createElement(cE);
}

function c(str){
    console.log(str);
}

function ajax(method, url, params, callback){
    let f = callback || function(data){};
    let request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if (request.readyState === 4 && request.status === 200) {
            f(request.responseText);
        }
    };

    request.open(method, url);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(params);
}

function getChar(event) {
    if (event.which == null) {
        if (event.keyCode < 32) return null;
        return String.fromCharCode(event.keyCode) // IE
    }

    if (event.which != 0 && event.charCode != 0) {
        if (event.which < 32) return null;
        return String.fromCharCode(event.which) // остальные
    }

    return null; // специальная клавиша
}