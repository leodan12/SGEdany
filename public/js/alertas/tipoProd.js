function verificar(){
    if($('input#nameTipo').val() !='' & $('input#codTipo').val() !=''){
      var nombre=$('input#nameTipo').val()
      $.ajax({
        url: "/tipoProducto/verificar/"+nombre,
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
              title: 'GUARDAR TIPO DE PRODUCTO',
              text:'Ya se ha registrado un tipo de producto con el nombre '+nombre.toUpperCase(),
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
        title: 'GUARDAR TIPO DE PRODUCTO',
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
    var nameTipo = $('input#nameTipo').val();
    var codTipo = $('input#codTipo').val();
  
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('nameTipo', nameTipo);
    data.append('codTipo', codTipo);
  
    $.ajax({
        url: "/tipoProducto/guardar",
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
              title: 'GUARDAR TIPO PRODUCTO',
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
    $('input#nameTipo').val('');
    $('input#codTipo').val('');
  }
  
  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' TIPO PRODUCTO',
      text: '¿Desea ' + tipo+ ' el tipo de producto seleccionado?',
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
          url: "/tipoProducto/eliminar/"+id,
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
    var nameTipo = $('input#nameTipo'+id).val();
    var codTipo = $('input#codTipo'+id).val();
  console.log(nameTipo)
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('nameTipo', nameTipo);
    data.append('codTipo', codTipo);
 
    $.ajax({
      url: "/tipoProducto/actualizar/"+id,
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
            title: 'ACTUALIZAR TIPO PRODUCTO',
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