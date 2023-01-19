document.addEventListener("DOMContentLoaded", function(event) { 
    showDiv();
  });

function showDiv(){
    if($("#OptEmpresa").is(':checked')){
        $('#empresa').show();
        $('#persona').hide();
    } else{
        $('#persona').show();
        $('#empresa').hide();
    }
    $('#nombre').val('');
    buscaClienteInfo();
}

function buscaClienteInfo(){
    var data = new FormData();
    var id;
    var tipo;
    if($("#OptEmpresa").is(':checked')){
       
        id=$('#clienteE').val();
        tipo='empresa';
    } else {
        
        id=$('#clienteP').val();
        tipo='persona';
    }
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('id', id);
    data.append('tipo', tipo);
    $.ajax({
        url: "/getClienteInfo",
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            if(tipo=='empresa'){
                $('#nombre').val(data.RazonSocial);
            }
            else{
                $('#nombre').val(data.per_apellidos+' '+data.per_nombres);
            }
            $('#nombre').prop('disabled',true);
        }
    });
    buscaResponsables(id)
    buscaRespInfo()
}
function buscaResponsables(id){
    $.ajax({
        url: "/getResponsables/"+id,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
            $("select#nameRes").empty();
            if(data.length<1){
                $("div#responsable").hide()
                Swal.fire({
                    confirmButtonColor: '#28D357',
                    title:'Atención!',
                    text:'No se han registrados responsables en este cliente.',
                    icon:'info  '
                  })
            }
            else{
               
                $("div#responsable").show() 
                for (let i = 0; i < data.length; i++) {
                    $("select#nameRes").append('<option value='+data[i].idResponsable+'>'+data[i].res_apellidos+' '+data[i].res_nombres+'</option>');
                    buscaRespInfo()
                }   
            }
            
        }
    });
}
function buscaRespInfo(){
    var id=$("select#nameRes").val()
    $.ajax({
        url: "/getResponsableInfo/"+id,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
            
            $('#carRes').val(data.res_cargo);
            $('#celRes').val(data.res_contacto);
            $('#emailRes').val(data.res_correo);
        }
    });
}
function inicio(){
    $("#codServ").prop("selectedIndex", 0).val();
    buscaServicio()
}
function buscaServicio(){
    
    var data = new FormData();
    var serv = $('#codServ').val();
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('serv', serv);
    $.ajax({
        url: "/getServicio",
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
            
            $('#servicio').val(data.serv_nombre);
            $('#servicio').prop('disabled',true);
            $('#costo').val('S/'+data.serv_costo);
            $('#costo').prop('disabled',true);
        }
    });
}
function limpiarDatos(){
    $('#cant').val('');
}
var filas=0;
var detalle = [];

function addFila(){
    filas+=1;
    $('#modalAdd').modal('toggle'); 
    var codigo = $('#codServ').find('option:selected').text();
    var servicio=$('#servicio').val();
    var costo=$('#costo').val();
    var cantidad= $('#cant').val();
    var subtotal = 0.00;
    subtotal = costo.substr(2)*cantidad;
    var fila = '<tr id="fila'+filas+'">'+
        '<td id="codigo">' + codigo + '</td>'+
        '<td id="servicio">' + servicio + '</td>'+
        '<td id="costo">' + costo + '</td>'+
        '<td id="cantidad">' + cantidad + '</td>'+
        '<td id="subtotal">S/' + subtotal.toFixed(2) + '</td>'+
        '<td>  <button type="button" class="btn btn-danger" '+"onclick='eliminarFila("+filas+");'"+ '><i class="fas fa-trash-alt" style="color: rgb(161, 26, 26)"></i></button></td>'
        '</tr>';
        
    $('#detalle>tbody').append(fila);
    limpiarDatos();
 }
 function eliminarFila(nro){
    $("#fila"+nro).remove();
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
            confirmButtonText: 'Si, guardar!',
            cancelButtonText: 'No!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                var data = new FormData();

                var subtotal=0.00;

                //datos cabecera
                var idCliente
                if($("#OptEmpresa").is(':checked')){
                    idCliente = $('#clienteE option:selected').val();
                    tipo='empresa'
                }
                else{
                    idCliente = $('#clienteP option:selected').val();
                    tipo='persona'
                }

                var idResponsable = $('#nameRes option:selected').val();

                $('#detalle>tbody tr').each(function(){
                    detalle.push($(this).find('td').eq(0).html())
                    detalle.push($(this).find('td').eq(1).html())
                    detalle.push($(this).find('td').eq(2).html())
                    detalle.push($(this).find('td').eq(3).html())
                    detalle.push($(this).find('td').eq(4).html())
                    subtotal+=parseFloat(detalle[4+(5*$x)].substr(2))
                    $x+=1
                })

                var lugar = $('#lugar').val();
                var concepto = $('#asunto').val();
                var admGastos = parseFloat($('#admGastos').val());
                var fecha = $('#fecha').val();

                var datos ={
                    idCliente:idCliente,
                    idResponsable:idResponsable,
                    lugar:lugar,
                    concepto:concepto,
                    tipo:tipo,
                    detalle:detalle,
                    subtotal:subtotal,
                    admGastos:admGastos,
                    fecha:fecha
                }
          
                data.append('_token', $('meta[name="_token"]').attr('content') );
                data.append('datos', JSON.stringify(datos));
          
                $.ajax({
                    url: '/presupuestoSave',
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
                            location.href='/presupuestos'
                        })
                    }
                });

            } 
          })

    }
    else{
        Swal.fire({
            title: 'GUARDAR PRESUPUESTO',
            text:'No se ingresó detalle del presupuesto.',
            icon: 'error',
            showCloseButton: true,
            confirmButtonText: 'Ok',
            focusConfirm: false
          })
    }
}
