/* Functions */
document.addEventListener('DOMContentLoaded', function () {
    let inputs = document.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].setAttribute('autocomplete', 'off');
    }
});

var showingTooltip;
function getId(id){
    return document.getElementById(id);
}

function getCN(cn){
    return document.getElementsByClassName(cn);
}

function getQS(qs){
    return document.querySelector(qs);
}

function getQSA(qs){
    return document.querySelectorAll(qs);
}

function cE(cE){
    return document.createElement(cE);
}

document.onmouseover = function(e) {
    let target = e.target;

    while (target !== this) {
        var tooltip = target.getAttribute('data-tooltip');
        if (tooltip) break;
        target = target.parentNode;
    }

    if (!tooltip) return;

    showingTooltip = showTooltip(tooltip, target);
};

document.onmouseout = function() {
    if (showingTooltip) {
        document.body.removeChild(showingTooltip);
        showingTooltip = false;
    }
};

function showTooltip(text, elem) {

    let tooltipElem = cE('div');
    tooltipElem.className = 'tooltip';
    tooltipElem.innerHTML = text;
    document.body.appendChild(tooltipElem);

    let coords = elem.getBoundingClientRect();

    let left = coords.left + (elem.offsetWidth - tooltipElem.offsetWidth) / 2;
    if (left < 0) {
        left = 0;
    }

    let top = coords.top - tooltipElem.offsetHeight - 5;

    if (top < 0) {
        top = coords.top + elem.offsetHeight + 5;
    }

    tooltipElem.style.left = left + 'px';
    tooltipElem.style.top = top + 'px';

    return tooltipElem;
}

function showCover() {
    let coverDiv = cE('div');
    coverDiv.id = 'cover-div';
    document.body.appendChild(coverDiv);
}

function hideCover() {
    document.body.removeChild(getId('cover-div'));
}

function showPrompt(text, status, url) {
    showCover();
    let container = getId('prompt-form-container');
    getId('prompt-message').innerHTML = text;
    getId('yes').onclick = function() {
        hideCover();
        if (status === true) {
            window.location = url;
        }
        container.style.display = 'none';
    };
    container.style.display = 'block';
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

function moneyFormat(n) {
    return parseFloat(n).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ");
}

function PrintElem(elem) {
    window.print();
    elem.remove();
}

/* Sort table */
let TableIDvalue = "indextable";
let TableLastSortedColumn = -1;

function SortTable() {
    let sortColumn = parseInt(arguments[0]);
    let type = arguments.length > 1 ? arguments[1] : 'T';
    let dateformat = arguments.length > 2 ? arguments[2] : '';
    let table = getId(TableIDvalue);
    let tbody = table.getElementsByTagName("tbody")[0];
    let rows = tbody.getElementsByTagName("tr");
    let arrayOfRows = new Array();
    type = type.toUpperCase();
    dateformat = dateformat.toLowerCase();
    for(let i = 0, len = rows.length; i<len; i++) {
        arrayOfRows[i] = new Object;
        arrayOfRows[i].oldIndex = i;
        let celltext = rows[i].getElementsByTagName("td")[sortColumn].innerHTML.replace(/<[^>]*>/g,"");

        if( type == 'D' ) {
            arrayOfRows[i].value = GetDateSortingKey(dateformat,celltext);
        } else {
            let re = type=="N" ? /[^\.\-\+\d]/g : /[^a-zA-Z0-9]/g;
            arrayOfRows[i].value = celltext.replace(re,"").substr(0,25).toLowerCase();
        }
    }

    if (sortColumn == TableLastSortedColumn) {
        arrayOfRows.reverse();
    } else {
        TableLastSortedColumn = sortColumn;
        switch(type) {
            case "N" : arrayOfRows.sort(CompareRowOfNumbers); break;
            case "D" : arrayOfRows.sort(CompareRowOfNumbers); break;
            default  : arrayOfRows.sort(CompareRowOfText);
        }
    }
    let newTableBody = cE("tbody");
    newTableBody.className = 'item';
    for(let i = 0, len = arrayOfRows.length; i<len; i++) {
        newTableBody.appendChild(rows[arrayOfRows[i].oldIndex].cloneNode(true));
    }
    table.replaceChild(newTableBody,tbody);
}

function CompareRowOfText(a,b) {
    let aval = a.value;
    let bval = b.value;
    return( aval == bval ? 0 : (aval > bval ? 1 : -1) );
}

function CompareRowOfNumbers(a,b) {
    let aval = /\d/.test(a.value) ? parseFloat(a.value) : 0;
    let bval = /\d/.test(b.value) ? parseFloat(b.value) : 0;
    return( aval == bval ? 0 : (aval > bval ? 1 : -1) );
}

function GetDateSortingKey(format,text) {
    if(format.length < 1) { return ""; }

    format = format.toLowerCase();
    text = text.toLowerCase();
    text = text.replace(/^[^a-z0-9]*/,"");
    text = text.replace(/[^a-z0-9]*$/,"");

    if(text.length < 1) { return ""; }

    text = text.replace(/[^a-z0-9]+/g,",");
    let date = text.split(",");

    if(date.length < 3) { return ""; }

    let d=0, m=0, y=0;
    for(let i=0; i<3; i++) {
        let ts = format.substr(i,1);
        if( ts == "d" ) { d = date[i]; }
        else if( ts == "m" ) { m = date[i]; }
        else if( ts == "y" ) { y = date[i]; }
    }

    d = d.replace(/^0/,"");

    if(d < 10) { d = "0" + d; }

    if(/[a-z]/.test(m)) {
        m = m.substr(0,3);
        switch(m) {
            case "jan" : m = String(1); break;
            case "feb" : m = String(2); break;
            case "mar" : m = String(3); break;
            case "apr" : m = String(4); break;
            case "may" : m = String(5); break;
            case "jun" : m = String(6); break;
            case "jul" : m = String(7); break;
            case "aug" : m = String(8); break;
            case "sep" : m = String(9); break;
            case "oct" : m = String(10); break;
            case "nov" : m = String(11); break;
            case "dec" : m = String(12); break;
            default    : m = String(0);
        }
    }

    m = m.replace(/^0/,"");

    if( m < 10 ) { m = "0" + m; }

    y = parseInt(y);

    if( y < 100 ) { y = parseInt(y) + 2000; }

    return "" + String(y) + "" + String(m) + "" + String(d) + "";
}