function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

function showRegister(){
    var x = document.getElementById("registerDiv");
    x.style.display = 'block';

    var x = document.getElementById("newsDiv");
    x.style.display = 'none';

    var firstField = document.getElementById('matricNo');
    firstField.focus();
}

function cancelRegister(){
    var x = document.getElementById("registerDiv");
    x.style.display = 'none';

    var x = document.getElementById("newsDiv");
    x.style.display = 'block';
}

function show_AddEntry() {  
    var x = document.getElementById("form");
    x.style.display = 'block';
    var firstField = document.getElementById('sem');
    firstField.focus();
    hideKPI();
}

function hide_AddEntry() {  
    var x = document.getElementById("form");
    x.style.display = 'none';
    var firstField = document.getElementById('sem');
    firstField.focus();
    showKPI();
}

function hideKPI(){
    var x = document.getElementById("kpi");
    x.style.display = 'none';
}

function showKPI(){
    var x = document.getElementById("kpi");
    x.style.display = 'flex';
}