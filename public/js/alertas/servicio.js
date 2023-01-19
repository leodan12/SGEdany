function verificar(){
    if($('input#nombre').val() !='' & $('input#codigo').val() !='' & $('input#costo').val() !=''){
      var cod=$('input#codigo').val()
      var nombre=$('input#nombre').val()
      var data = new FormData();
      data.append('_token', $('meta[name="_token"]').attr('content') );
      data.append('cod', cod)
      data.append('nombre', nombre)

      $.ajax({
        url: "/servicio/verificar",
        data:data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
          
         if (data=='success'){
            guardar()
         }
         else{
            Swal.fire({
              title: 'GUARDAR SERVICIO',
              text:'Ya se ha registrado un producto con ese '+data.toUpperCase()+'.',
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
        title: 'GUARDAR SERVICIO',
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
    
    var nombre = $('input#nombre').val()
    var codigo = $('input#codigo').val()
    var detalle = $('input#detalle').val()
    var costo = $('input#costo').val()
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('nombre', nombre)
    data.append('codigo', codigo)
    data.append('detalle', detalle)
    data.append('costo', costo)
  
    $.ajax({
        url: "/servicio/guardar",
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
              title: 'GUARDAR SERVICIO',
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
    $('input#nombre').val('')
    $('input#codigo').val('')
    $('input#detalle').val('')
    $('input#costo').val('')
  }

  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' SERVICIO',
      text: '¿Desea ' + tipo+ ' el servicio seleccionado?',
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
          url: "/servicio/eliminar/"+id,
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
    
    var nombre = $('input#nombre'+id).val()
    var codigo = $('input#codigo'+id).val()
    var detalle = $('input#detalle'+id).val()
    var costo = $('input#costo'+id).val()
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('nombre', nombre)
    data.append('codigo', codigo)
    data.append('detalle', detalle)
    data.append('costo', costo)

    $.ajax({
      url: "/servicio/actualizar/"+id,
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
            title: 'ACTUALIZAR SERVICIO',
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
          title: 'ACTUALIZAR SERVICIO',
          text:text,
          icon: data,
          showCloseButton: true,
          confirmButtonText: 'Ok',
          focusConfirm: false
        })
       }
       if(data=='error-2'){
        Swal.fire({
            title: 'ACTUALIZAR SERVICIO',
            text:'Ya se ha registrado un servicio con ese nombre.',
            icon: 'error',
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