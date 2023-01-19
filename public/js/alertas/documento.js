function verificar(){
    if($('input#codDoc').val() !='' & $('input#precio').val() !='' & $('input#emiDoc').val() !='' & $('input#fileDoc').val() !=''){
      var id=$('select#rucDoc').val()
      var cod =$('input#codDoc').val()
      $.ajax({
        url: "/comprobante/verificar/"+id+'/'+cod,
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
              title: 'GUARDAR COMPROBANTE',
              text:'Ya se ha registrado un comprobate con el código '+nombre.toUpperCase()+'de la empresa'+empresa+'.',
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
        title: 'GUARDAR COMPROBANTE',
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
    var rucDoc=$('select#rucDoc').val()
    var tipoDoc = $('select#tipoDoc').val()
    var codDoc = $('input#codDoc').val()
    var precioDoc = $('input#precioDoc').val()
    var emiDoc = $('input#emiDoc').val()
    var fileDoc = $('input#fileDoc')[0].files[0]
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('rucDoc', rucDoc)
    data.append('tipoDoc', tipoDoc)
    data.append('codDoc', codDoc)
    data.append('precioDoc', precioDoc)
    data.append('emiDoc', emiDoc)
    data.append('fileDoc', fileDoc)
  
    $.ajax({
        url: "/comprobante/guardar",
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
              title: 'GUARDAR COMPROBANTE',
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

    $('select#rucDoc').prop("selectedIndex", 0).val()
    $('select#tipoDoc').prop("selectedIndex", 0).val()
    $('input#codDoc').val('')
    $('input#precioDoc').val('')
    $('input#emiDoc').val('')
    $('input#fileDoc').val('')
  }

  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' COMPROBANTE',
      text: '¿Desea ' + tipo+ ' el comprobante seleccionado?',
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
          url: "/comprobante/eliminar/"+id,
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
  function verificarAct(id){
    if($('input#codDoc'+id).val() !='' & $('input#precio'+id).val() !='' & $('input#emiDoc'+id).val() !=''){
      var id=$('select#rucDoc'+id).val()
      var cod =$('input#codDoc'+id).val()
     console.log(id,cod)
      $.ajax({
        url: "/comprobante/verificar/"+id+'/'+cod,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
          
         if (data=='success'){
            actualizar(id)
         }
         else{
            Swal.fire({
              title: 'ACTUALIZAR COMPROBANTE',
              text:'Ya se ha registrado un comprobate con el código '+nombre.toUpperCase()+'de la empresa'+empresa+'.',
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
        title: 'GUARDAR COMPROBANTE',
        text:'No se ha ingresado los datos necesarios.',
        icon: 'error',
        showCloseButton: true,
        confirmButtonText: 'Ok',
        focusConfirm: false
      })
    }
  }
  function actualizar(id){

    var data = new FormData();
    var rucDoc=$('select#rucDoc'+id).val()
    var tipoDoc = $('select#tipoDoc'+id).val()
    var codDoc = $('input#codDoc'+id).val()
    var precioDoc = $('input#precioDoc'+id).val()
    var emiDoc = $('input#emiDoc'+id).val()
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('rucDoc', rucDoc)
    data.append('tipoDoc', tipoDoc)
    data.append('codDoc', codDoc)
    data.append('precioDoc', precioDoc)
    data.append('emiDoc', emiDoc)
console.log('si')
    $.ajax({
      url: "/comprobante/actualizar/"+id,
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
            title: 'ACTUALIZAR COMPROBANTE',
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
          title: 'ACTUALIZAR COMPROBANTE',
          text:text,
          icon: data,
          showCloseButton: true,
          confirmButtonText: 'Ok',
          focusConfirm: false
        })
       }
       if(data=='error-2'){
        Swal.fire({
            title: 'GUARDAR COMPROBANTE',
            text:'Ya se ha registrado un comprobante con ese código en la empresa seleccionada.',
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
  function modalVis(id){
    var modal = '#modalVis'+id
    $(modal).modal('toggle'); 
  }