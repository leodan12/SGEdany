function verificar(){
    if($('select#dni').val() !='' & $('input#monto').val() !='' & $('input#fecha').val() !='' & $('textarea#motivo').val() !=''){
      var fecha=$('input#fecha').val()
      var id=$('select#dni').val()
      var nombre=$('input#nombre').val()
      $.ajax({
        url: "/movimientosDinero/verificar/"+fecha+'/'+id,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
          
         if (data=='success'){
            guardar()
         }
         else{
            Swal.fire({
              title: 'GUARDAR ADELANTO',
              text:'Ya se ha registrado un adelanto para el colaborador '+nombre.toUpperCase()+' en el mes seleccionado.',
              icon: 'error',
              showCloseButton: true,
              confirmButtonText: 'Ok',
              focusConfirm: false
            })
         }  
        }
      });
    }
    else{
      Swal.fire({
        title: 'GUARDAR PROVEEDOR',
        text:'No se ha ingresado los datos necesarios.',
        icon: 'error',
        showCloseButton: true,
        confirmButtonText: 'Ok',
        focusConfirm: false
      })
    }
  }
  function guardar(){

    var data = new FormData();
    var dni=$('select#dni').val()
    var tipo=$('select#tipo').val()
    var monto = $('input#monto').val()
    var fecha = $('input#fecha').val()
    var motivo = $('textarea#motivo').val()
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('dni', dni)
    data.append('fecha', fecha)
    data.append('tipo', tipo)
    data.append('monto', monto)
    data.append('motivo', motivo)
  
    $.ajax({
        url: "/movimientosDinero/guardar",
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
            text='Error al guardar los datos.'
         }
            Swal.fire({
              title: 'GUARDAR MOVIMIENTO DE DINERO',
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
function limpiarModal(){
    $('select#dni').prop("selectedIndex", 0).val()
    $('select#tipo').prop("selectedIndex", 0).val()
    $('input#monto').val('')
    $('input#fecha').val('')
    $('textarea#motivo').val('')
  }

  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' MOVIMIENTO DINERO',
      text: '¿Desea ' + tipo+ ' el movimiento seleccionado?',
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
          url: "/movimientosDinero/eliminar/"+id,
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
  function actualizar(id){

    var data = new FormData();
    var dni=$('select#dni'+id).val()
    var tipo=$('select#tipo'+id).val()
    var monto = $('input#monto'+id).val()
    var fecha = $('input#fecha'+id).val()
    var motivo = $('textarea#motivo'+id).val()
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('dni', dni)
    data.append('fecha', fecha)
    data.append('tipo', tipo)
    data.append('monto', monto)
    data.append('motivo', motivo)

    $.ajax({
      url: "/movimientosDinero/actualizar/"+id,
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
            title: 'ACTUALIZAR MOVIMIENTO DINERO',
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
          title: 'ACTUALIZAR MOVIMIENTO DINERO',
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
  function modal(id){
    var modal = '#modalAct'+id
    $(modal).modal('toggle'); 
  }