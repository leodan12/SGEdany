function verificar(){
    if($('input#ubicName').val() !=''){
      var nombre=$('input#ruc').val()
      $.ajax({
        url: "/proveedor/verificar/"+nombre,
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
              title: 'GUARDAR PROVEEDOR',
              text:'Ya se ha registrado un proveedor con el ruc '+nombre.toUpperCase(),
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
    var ruc = $('input#ruc').val();
    var razon = $('input#razon').val();
    var nombre = $('input#nombre').val();
    var direc = $('input#direc').val();
    var rubro = $('input#rubro').val();
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('ruc', ruc);
    data.append('razon', razon);
    data.append('nombre', nombre);
    data.append('direc', direc);
    data.append('rubro', rubro);
  
    $.ajax({
        url: "/proveedor/guardar",
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
              title: 'GUARDAR PROVEEDOR',
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
    
    $('input#ruc').val('');
    $('input#razon').val('');
    $('input#nombre').val('');
    $('input#direc').val('');
    $('input#rubro').val('');
  }
  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' PROVEEDOR',
      text: '¿Desea ' + tipo+ ' el proveedor seleccionado?',
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
          url: "/proveedor/eliminar/"+id,
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
    var ruc = $('input#ruc'+id).val();
    var razon = $('input#razon'+id).val();
    var nombre = $('input#nombre'+id).val();
    var direc = $('input#direc'+id).val();
    var rubro = $('input#rubro'+id).val();
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('ruc', ruc);
    data.append('razon', razon);
    data.append('nombre', nombre);
    data.append('direc', direc);
    data.append('rubro', rubro);
 
    $.ajax({
      url: "/proveedor/actualizar/"+id,
      data: data,
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data){
        console.log(data)
       var text;
       if (data=='success'){
          text='Se actualizaron correctamente los datos.'
       }
       else{
          text='Error al actualizar los datos.'
       }
          Swal.fire({
            title: 'ACTUALIZAR PROVEEDOR',
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