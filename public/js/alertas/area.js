function verificar(){
  var nombre = $('input#nameA').val()
  if (nombre != ''){
    $.ajax({
      url: "/area/verificar/"+nombre,
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
            title: 'GUARDAR ÁREA',
            text:'Ya se ha registrado un área con el nombre '+nombre.toUpperCase(),
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
      title: 'GUARDAR ÁREA',
      text:'No se ha ingresado el nombre del área.',
      icon: 'error',
      showCloseButton: true,
      confirmButtonText: 'Ok',
      focusConfirm: false
    })
  }
}
function guardar(){
    var data = new FormData();
    var nameA = $('input#nameA').val();
    var descA= $('textarea#desA').val();
  
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('nameA', nameA);
    data.append('descA', descA);
  
    $.ajax({
        url: "/area/guardar",
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
            text='SE GUARDARON CORRECTAMENTE LOS DATOS.'
         }
         else{
            text='ERROR AL GUARDAR LOS DATOS.'
         }
            Swal.fire({
              title: 'GUARDAR ÁREA',
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
    $('input#nameA').val('');
    $('textarea#descA').val('');
  }
  
  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' ÁREA',
      text: '¿Desea ' + tipo+ ' el área seleccionada?',
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
          url: "/area/eliminar/"+id,
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
   
    var data = new FormData
    nombre='input#nameAct'+id
    var nameA = $(nombre).val();
    descripcion = 'textarea#descAct'+id
    var descA= $(descripcion).val();
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('nameA', nameA);
    data.append('descA', descA);

    $.ajax({
      url: "/area/actualizar/"+id,
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
          text='SE ACTUALIZARON CORRECTAMENTE LOS DATOS.'
       }
       else{
          text='ERROR AL ACTUALIZAR LOS DATOS.'
       }
          Swal.fire({
            title: 'ACTUALIZAR ÁREA',
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
    });
  }
  function modal(id){
    var modal = '#modalAct'+id
    $(modal).modal('toggle'); 
  }