$('document').ready(buscaEmpresa);

function buscaEmpresa(){
    
    var ruc = $('#rucDoc').val();

    $.ajax({
        url: APP_URL + "/getEmpresa/"+ruc,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
            $('input#nombre').val(data.NombreComercial)
            $('input#nombre').prop('disabled',true)
            
        }
    });
    
}