$('document').ready(buscaProducto);
function buscaProducto(){
    $('select#prod').val(1)
    var data = new FormData();
    var prod = $('#prod').val();
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('prod', prod);

    $.ajax({
        url: APP_URL + "/getProducto",
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            var nombre = document.getElementById('nombre');
            nombre.value = data.Prod_nombre;
            $('#nombre').prop('disabled',true);
            
        }
    });
}
