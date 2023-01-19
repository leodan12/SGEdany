function guardar(){
  var data = new FormData();
  var colJub = $('select#colJub option:selected').val();


  data.append('_token', $('meta[name="_token"]').attr('content') );
  data.append('colJub', colJub);

  $.ajax({
      url: "/jubilacion/guardar",
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
            title: 'GUARDAR JUBILACION',
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
  $("select#colJub").prop("selectedIndex", 0).val();
}

function cambioEstado(tipo,id){
  Swal.fire({
    title: tipo.toUpperCase()+' JUBILACIÓN',
    text: '¿Desea ' + tipo+ ' la jubilación seleccionada?',
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
        url: "/jubilacion/eliminar/"+id,
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
  col = 'select#colAct'+id;
  var colJub=$(col).val();
  

  data.append('_token', $('meta[name="_token"]').attr('content') );
  data.append('colJub', colJub);


  $.ajax({
    url: "/jubilacion/actualizar/"+id,
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
          title: 'ACTUALIZAR JUBILACIÓN',
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