function cargarCodigoTipo(){
    var tipo =$('select#tipo option:selected').text()
   
    $.ajax({
        url: "/getCodTipoProd/"+tipo,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
         $('input#cod').val(data.TP_codigo)
         $('input#cod').prop('disabled',true)
        }
    });
}