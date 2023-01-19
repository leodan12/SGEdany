$('document').ready(
    generarTabla()
);


function generarTabla(){
    $.ajax({
        url: "/getproductosAlmacen",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){

            if(data.length>0){
                
                let table= $('<table class="table" id="datatablesSimple">')
                let thead =$('<thead>')
                let cabecera=$('<tr>')
                cabecera.append('<th scope="col">#</th>')
                cabecera.append('<th scope="col">Cod. Producto</th>')
                cabecera.append('<th scope="col">Producto</th>')
                cabecera.append('<th scope="col">Cant. Actual</th>')
                $(thead).append(cabecera)

                let tbody=$('<tbody>')
                
                for (let i = 0; i < data.length; i++) {
                    var fila = '<tr>'+
                        '<td>' + (i+1) + '</td>'+
                        '<td>' + data[i].codProducto+ '</td>'+
                        '<td>' + data[i].Prod_nombre+
                        '<td>' + data[i].Cant_actual+ '</td>'+
                    '</tr>'
    
                    $(tbody).append(fila);
                }

                table.append(thead)
                table.append(tbody)
                $('#Treporte').append(table)
                
                const datatablesSimple = document.getElementById('datatablesSimple');
                if (datatablesSimple) {
                    new simpleDatatables.DataTable(datatablesSimple);
                }
            }
            else{
               
                Swal.fire({
                    title: 'GENERAR INVENTARIO',
                    text:'No se encontraron productos registrados',
                    icon: 'error',
                    showCloseButton: true,
                    confirmButtonText: 'Ok',
                    focusConfirm: false
                  })
            }
            
        }
    })
}
function pdfTabla(){
    window.open("http://127.0.0.1:8000/descargar/inventario")
}