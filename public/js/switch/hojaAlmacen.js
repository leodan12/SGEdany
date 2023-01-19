$('document').ready(showDiv());
function showDiv(){
   
    var tipo = $('#tipo').val();
    var divEntrada = document.getElementById('entrada')
    var divSalida = document.getElementById('salida')
    if (tipo =='entrada'){
        divEntrada.style.display='block';
        divSalida.style.display='none';
    }else{
        divSalida.style.display='block';
        divEntrada.style.display='none';
    }
}

