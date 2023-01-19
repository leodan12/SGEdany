document.addEventListener("DOMContentLoaded", function(event) { 
    showDatosEmpresa();
    showDiv();
  });

function showDatosEmpresa(){
    var data = new FormData();
    var id = $('#idDoc').val();
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('id', id);

    $.ajax({
        url: "/getDocInfo",
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            // console.log(data);
            $('#ruc').val(data.RUC);
            $('#nombreE').val(data.NombreComercial);
            $('#ruc').prop('disabled',true);
            $('#nombreE').prop('disabled',true);
            
        }
    });
}
function showDiv(){
    $('#detalle>tbody').empty();
    var tipo = $('#tipo').val();
    if (tipo =='entrada'){
        $('#entrada').show();
        $('#salida').hide();
    }else{
        $('#entrada').hide();
        $('#salida').show();
        
    }
}
function buscaProducto(){
    var data = new FormData();
    var prod = $('#codProd').val();
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('prod', prod);
    $.ajax({
        url: "/getProducto",
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            $('#producto').val(data.Prod_nombre);
            $('#producto').prop('disabled',true);
            $('#precio').val('S/'+data.Prod_precio);
            $('#precio').prop('disabled',true);
        }
    });
}

var filas=0;
var detalle = [];

function addFila(){
filas+=1;
    $('#modalAdd').modal('toggle'); 
    var codigo = $('#codProd').find('option:selected').text();
    var producto=$('#producto').val();
    var precio=$('#precio').val();
    var cantidad= $('#cant').val();
    var subtotal = 0.00;
    subtotal = precio.substring(2)*cantidad;
    var fila = '<tr id="fila'+filas+'">'+
        '<td id="codigo">' + codigo + '</td>'+
        '<td id="producto">' + producto + '</td>'+
        '<td id="precio">' + precio + '</td>'+
        '<td id="cantidad">' + cantidad + '</td>'+
        '<td id="subtotal">S/' + subtotal.toFixed(2) + '</td>'+
        '<td>  <button type="button" class="btn btn-danger" '+"onclick='eliminarFila("+filas+");'"+ '><i class="fas fa-trash-alt" style="color: rgb(161, 26, 26)"></i></button></td>'
      '</tr>';
      
    $('#detalle>tbody').append(fila);
   limpiarDatos();
}
function eliminarFila(nro){
    Swal.fire({
        title: 'ELIMINAR FILA',
        text: '¿Desea eliminar el detalle seleccionado?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28D357',
        cancelButtonColor: '#EC1A1D',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $("#fila"+nro).remove();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire({
            confirmButtonColor: '#28D357',
            title:'Cancelado',
            text:'No se realizaron cambios.',
            icon:'error'
          })
        }
      })
    
}
function limpiarDatos(){
    $('#cant').val('');
}
function registrar(){

    detalle=[]
    const nroFilas=$('#detalle>tbody tr').length;
    var $x=0;


    if (nroFilas>0){

        Swal.fire({
            title: 'NUEVO PRESUPUESTO',
            text: '¿Los datos ingresados son correctos?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28D357',
            cancelButtonColor: '#EC1A1D',
            confirmButtonText: 'Si!',
            cancelButtonText: 'No!',
            reverseButtons: true
          }).then((result) => {
                if (result.isConfirmed) {
                    var data = new FormData();

                    var total=0.00;
                    //datos cabecera
                    var tipo = $('#tipo').val();
                    var dni = $('#dni').val();
                    console.log(dni)
                    var idDoc = $('#idDoc').val();
                    var descripcion = $('#descripcion').val();

                    $('#detalle>tbody tr').each(function(){
                        detalle.push($(this).find('td').eq(0).html())
                        detalle.push($(this).find('td').eq(1).html())
                        detalle.push($(this).find('td').eq(2).html())
                        detalle.push($(this).find('td').eq(3).html())
                        detalle.push($(this).find('td').eq(4).html())
                        total+=parseFloat(detalle[4+(5*$x)].substr(2))
                        $x+=1
                    })
                    var datos ={
                        tipo:tipo,
                        dni:dni,
                        idDoc:idDoc,
                        descripcion:descripcion,
                        detalle:detalle,
                        total:total
                    }
                
                    data.append('_token', $('meta[name="_token"]').attr('content') );
                    data.append('datos', JSON.stringify(datos));
            

                    $.ajax({
                        url: '/hojaAlmacenSave',
                        data:data,
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST',
                        success: function(data){
                            var text;
                            if (data=='success'){
                            text='Se guardaron correctamente los datos.'
                            }
                            else{
                            text='Error al guardar los datos.'
                            }
                            Swal.fire({
                                title: 'GUARDAR PRESUPUESTO',
                                text:text,
                                icon: data,
                                showCloseButton: true,
                                confirmButtonText: 'Ok',
                                focusConfirm: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.href='/hojaAlmacen'
                                } 
                            })
                        }
                    });
                }
            })

        
    } else{
        Swal.fire({
            title: 'GUARDAR HOJA DE ALMACÉN',
            text:'No se ha ingresado el detalle de la hoja.',
            icon: 'error',
            showCloseButton: true,
            confirmButtonText: 'Ok',
            focusConfirm: false
          })
    }
}
