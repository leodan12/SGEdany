function verificar(){
    if($('select#dni').val() !='' & $('input#monto').val() !='' & $('input#fecha').val() !=''){
      var fecha=$('input#fecha').val()
      var id=$('select#dni').val()
      var nombre=$('input#nombre').val()
      $.ajax({
        url: "/adelanto/verificar/"+fecha+'/'+id,
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
    var fecha=$('input#fecha').val()
    var monto = $('input#monto').val()
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('dni', dni)
    data.append('fecha', fecha)
    data.append('monto', monto)
  
    $.ajax({
        url: "/adelanto/guardar",
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
              title: 'GUARDAR ADELANTO',
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
    $('select#dni').prop("selectedIndex", 0).val();
    $('input#monto').val('')
    $('input#fecha').val('')
  }
  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' ADELANTO',
      text: '¿Desea ' + tipo+ ' el adelanto seleccionado?',
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
          url: "/adelanto/eliminar/"+id,
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
    var fecha=$('input#fecha'+id).val()
    var monto = $('input#monto'+id).val()
  console.log(fecha)
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('dni', dni)
    data.append('fecha', fecha)
    data.append('monto', monto)
 
    $.ajax({
      url: "/adelanto/actualizar/"+id,
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
            title: 'ACTUALIZAR ADELANTO',
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
          title: 'ACTUALIZAR ADELANTO',
          text:text,
          icon: data,
          showCloseButton: true,
          confirmButtonText: 'Ok',
          focusConfirm: false
        })
      }
      if (data=='error-2'){
        text='Ya se ha registrado un adelanto para el colaborador en el mes seleccionado.'
        Swal.fire({
          title: 'ACTUALIZAR ADELANTO',
          text:text,
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