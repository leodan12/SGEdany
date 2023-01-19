function verificar(){
  var nombre = $('input#nameCa').val()
  if(nombre!=''){
    $.ajax({
      url: "/cargo/verificar/"+nombre,
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
            title: 'GUARDAR CARGO',
            text:'Ya se ha registrado un cargo con el nombre '+nombre.toUpperCase(),
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
      title: 'GUARDAR CARGO',
      text:'No se ha ingresado el nombre del cargo.',
      icon: 'error',
      showCloseButton: true,
      confirmButtonText: 'Ok',
      focusConfirm: false
    })
  }
}
function guardar(){
  var data = new FormData();
  var nameCa = $('input#nameCa').val();
  var areaCa = $('select#areaCa option:selected').val();
  var descCa= $('textarea#descCa').val();


  data.append('_token', $('meta[name="_token"]').attr('content') );
  data.append('nameCa', nameCa);
  data.append('areaCa', areaCa);
  data.append('descCa', descCa);

  $.ajax({
      url: "/cargo/guardar",
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
            title: 'GUARDAR CARGO',
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
  $('input#nameCa').val('');
  $("select#areaCa").prop("selectedIndex", 0).val();
  $('textarea#descCa').val('');
}

function cambioEstado(tipo,id){
  Swal.fire({
    title: tipo.toUpperCase()+' CARGO',
    text: '¿Desea ' + tipo+ ' el cargo seleccionado?',
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
        url: "/cargo/eliminar/"+id,
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

  nombre='input#nameCa'+id
  var nameCa = $(nombre).val();
  
  area='select#areaCa'+id
  var areaCa = $(area).val();
  descripcion = 'textarea#descCa'+id
  var descCa= $(descripcion).val();
  data.append('_token', $('meta[name="_token"]').attr('content') );
  data.append('nameCa', nameCa);
  data.append('areaCa', areaCa);
  data.append('descCa', descCa);


  $.ajax({
    url: "/cargo/actualizar/"+id,
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
          title: 'ACTUALIZAR CARGO',
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