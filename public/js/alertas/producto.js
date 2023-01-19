
function verificar(){
    if($('input#nombre').val() !='' & $('input#precio').val() !='' & $('input#unidMed').val() !=''){
      var nombre=$('input#nombre').val()
      $.ajax({
        url: "/producto/verificar/"+nombre,
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
              title: 'GUARDAR PRODUCTO',
              text:'Ya se ha registrado un producto con el nombre '+nombre.toUpperCase()+'.',
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
        title: 'GUARDAR PRODUCTO',
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
    var tipo=$('select#tipo').val()
    var nombre = $('input#nombre').val()
    var precio = $('input#precio').val()
    var unidMed = $('input#unidMed').val()
    var minimo = $('input#minimo').val()
    var descripcion = $('textarea#descripcion').val()
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('tipo', tipo)
    data.append('nombre', nombre)
    data.append('precio', precio)
    data.append('unidMed', unidMed)
    data.append('minimo', minimo)
    data.append('descripcion', descripcion)
  
    $.ajax({
        url: "/producto/guardar",
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
              title: 'GUARDAR PRODUCTO',
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
    $('select#tipo').prop("selectedIndex", 0).val()
    $('input#nombre').val('')
    $('input#precio').val('')
    $('input#unidMed').val('')
    $('input#minimo').val('')
    $('input#descripcion').val('')
  }

  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' PRODUCTO',
      text: '¿Desea ' + tipo+ ' el producto seleccionado?',
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
          url: "/producto/eliminar/"+id,
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
    var tipo=$('select#tipo'+id).val()
    var nombre = $('input#nombre'+id).val()
    var precio = $('input#precio'+id).val()
    var unidMed = $('input#unidMed'+id).val()
    var minimo = $('input#minimo'+id).val()
    var descripcion = $('textarea#descripcion'+id).val()
 
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('tipo', tipo)
    data.append('nombre', nombre)
    data.append('precio', precio)
    data.append('minimo', minimo)
    data.append('unidMed', unidMed)
    data.append('descripcion', descripcion)

    $.ajax({
      url: "/producto/actualizar/"+id,
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
            title: 'ACTUALIZAR PRODUCTO',
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
          title: 'ACTUALIZAR PRODUCTO',
          text:text,
          icon: data,
          showCloseButton: true,
          confirmButtonText: 'Ok',
          focusConfirm: false
        })
       }
       if(data=='error-2'){
        Swal.fire({
            title: 'ACTUALIZAR PRODUCTO',
            text:'Ya se ha registrado un producto con ese nombre.',
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