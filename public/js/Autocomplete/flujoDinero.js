function cargarNombre(){
    var dni =$('select#dni option:selected').text()
    $.ajax({
        url: "/getNombres/"+dni,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
         $('input#nombre').val(data.per_apellidos+' '+data.per_nombres)
         $('input#nombre').prop('disabled',true)
        }
    });
}