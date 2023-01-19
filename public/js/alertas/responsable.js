var nombreAct,apellidoAct,cargoAct,celAct,emailAct,idempresaAct
function getCliente(){
    var data = new FormData();
    var ruc =$('select#razon').val();

    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('id', ruc);
    data.append('tipo', 'empresa');
    
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
            $('#nameEmp').prop('disabled',false);
            $('#nameEmp').val(data.NombreComercial);
            $('#nameEmp').prop('disabled',true);
        }
    });
}

function limpiarModal(){
    $('select#razon').prop("selectedIndex", 0).val()
    $('input#nameRes').val('')
    $('input#apellRes').val('')
    $('input#carRes').val('')
    $('input#celRes').val('')
    $('input#emailRes').val('')
    getCliente()
}

function guardar(){
    if($('input#nameRes').val() !='' & $('input#apellRes').val() !='' & $('input#carRes').val() !='' & $('input#celRes').val() !='' & $('input#emailRes').val() !=''){
        
        var data = new FormData();
        
        var nombre = $('input#nameRes').val()
        var apellido = $('input#apellRes').val()
        var cargo = $('input#carRes').val()
        var cel = $('input#celRes').val()
        var email = $('input#emailRes').val()
        var razon = $('select#razon').val()
    
        data.append('_token', $('meta[name="_token"]').attr('content') );
        data.append('nombre', nombre)
        data.append('apellido', apellido)
        data.append('cargo', cargo)
        data.append('cel', cel)
        data.append('email', email)
        data.append('razon', razon)
    
        $.ajax({
            url: "/responsable/guardar",
            data: data,
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
                text='Error al intentar guardar los datos'
            }
                Swal.fire({
                title: 'GUARDAR RESPONSABLE',
                text:text,
                icon: data,
                showCloseButton: true,
                confirmButtonText: 'Ok',
                focusConfirm: false
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    limpiarModal()
                    $('#modalAdd').modal('toggle'); 
                    location.reload();
                } 
                })
            
                
            }
        });
    }
    else{
      Swal.fire({
        title: 'GUARDAR PRODUCTO',
        text:'No se ha ingresado los datos necesarios.',
        icon: 'error',
        showCloseButton: true,
        confirmButtonText: 'Ok',
        focusConfirm: false
      })
    }
}

function cambioEstado(tipo,id){
    Swal.fire({
        title: tipo.toUpperCase()+' RESPONSABLE',
        text: '¿Desea ' + tipo+ ' el responsable seleccionado?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28D357',
        cancelButtonColor: '#EC1A1D',
        confirmButtonText: 'Si, '+tipo+'!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/responsable/eliminar/"+id,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                type: 'GET',
                success: function(){
                realizado()
                }
            });
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            Swal.fire({
                confirmButtonColor: '#28D357',
                title:'Cancelado',
                text:'No se realizaron cambios.',
                icon:'error'
            })
            }
        })
}

function realizado(){
    Swal.fire({
      confirmButtonColor: '#28D357',
      title:'Realizado!',
      text:'Modificaciones realizadas correctamente.',
      icon:'success'
    }).then((result) => {
      if (result.isConfirmed) {
        location.reload();
      }
    })
}

function limpiarModalAct(id){
    $('input#nameRes'+id).val('')
    $('input#apellRes'+id).val('')
    $('input#carRes'+id).val('')
    $('input#celRes'+id).val('')
    $('input#emailRes'+id).val('')
}
function modal(id){
    var modal = '#modalAct'+id
    $(modal).modal('toggle'); 
    getResponsableInfo(id)
    getClienteEdit(id)  
}

function getClienteEdit(id){
    var data = new FormData();
    var ruc =$('select#razon'+id).val();
    console.log(ruc)
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('id', ruc);
    data.append('tipo', 'empresa');
    
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
            $('#nameEmp'+id).prop('disabled',false);
            $('#nameEmp'+id).val(data.NombreComercial);
            $('#nameEmp'+id).prop('disabled',true);
        }
    });
}

function actualizar(id){

    var data = new FormData();
    nombreAct = $('input#nameRes'+id).val()
    apellidoAct = $('input#apellRes'+id).val()
    cargoAct = $('input#carRes'+id).val()
    celAct = $('input#celRes'+id).val()
    emailAct = $('input#emailRes'+id).val()
    razonAct = $('select#razon'+id).val()
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('nombre', nombreAct)
    data.append('apellido', apellidoAct)
    data.append('cargo', cargoAct)
    data.append('cel', celAct)
    data.append('email', emailAct)
    data.append('razon', razonAct)

    $.ajax({
      url: "/responsable/actualizar/"+id,
      data: data,
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data){
       
       var text;
       if (data=='success'){
          text='Se actualizaron correctamente los datos.'
          Swal.fire({
            title: 'ACTUALIZAR RESPONSABLE',
            text:text,
            icon: data,
            showCloseButton: true,
            confirmButtonText: 'Ok',
            focusConfirm: false
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              limpiarModal()
             
              location.reload();
            } 
          })  
       }
       if (data=='error'){
        text='Error al actualizar los datos.'
        Swal.fire({
          title: 'ACTUALIZAR RESPONSABLE',
          text:text,
          icon: data,
          showCloseButton: true,
          confirmButtonText: 'Ok',
          focusConfirm: false
        })
       }
      }
    });
}

function getResponsableInfo(id){
    $.ajax({
        url: "/getResponsableInfo/"+id,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
            console.log(data)
            $('select#razon'+id).val(data.idCliente)
            $('input#nameRes'+id).val(data.res_nombres)
            $('input#apellRes'+id).val(data.res_apellidos)
            $('input#carRes'+id).val(data.res_cargo)
            $('input#celRes'+id).val(data.res_contacto)
            $('input#emailRes'+id).val(data.res_correo)
        }
    });
}

function cerrarModalAct(id){
    getResponsableInfo(id)
    var modal = '#modalAct'+id
    $(modal).modal("toggle"); 
}

