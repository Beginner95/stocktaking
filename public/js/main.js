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