$('document').ready(
    startTime(),
    setDate()
);

function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);

    document.getElementById("title").innerHTML = "Hora y fecha actual:"
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec;
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i
    }
    return i
}
function setDate(){
    var today = new Date()
    var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Augosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
    var days = ['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom']
    var curWeekDay = days[today.getDay()]
    var curDay = today.getDate()
    var curMonth = months[today.getMonth()]
    var curYear = today.getFullYear()
    var date = curWeekDay+", "+curDay+" de "+curMonth+" "+curYear
    $("div#date").append(date)
}

