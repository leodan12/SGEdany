function abrirModal(){
  $("#modalAdd").modal("show");
  limpiarModal()
}
function limpiarModal(){
  $('input#name').val('');
  $('input#nivel').val('1');
}
function verificar(){
    if($('input#name').val() !='' & $('input#nivel').val() !=''){
      var nombre=$('input#name').val()
      $.ajax({
        url: "/rol/verificar/"+nombre,
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
              title: 'GUARDAR ROL',
              text:'Ya se ha registrado un rol con el nombre '+nombre.toUpperCase(),
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
        title: 'GUARDAR ROL',
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
    var name = $('input#name').val();
    var nivel = $('input#nivel').val();
  
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('name', name);
    data.append('nivel', nivel);
  
    $.ajax({
        url: "/rol/guardar",
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
              title: 'GUARDAR ROL',
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
  
  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' ROL',
      text: '¿Desea ' + tipo+ ' el rol seleccionado?',
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
          url: "/rol/eliminar/"+id,
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
   var name = $('input#name'+id).val();
   var nivel = $('input#nivel'+id).val();

 
   data.append('_token', $('meta[name="_token"]').attr('content') );
   data.append('name', name);
   data.append('nivel', nivel);

   $.ajax({
     url: "/rol/actualizar/"+id,
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
         icon=data
      }
      else{
         if(data=='error')
          text='Ya se ha registrado un rol con el nombre '+name.toUpperCase()
         else
          text='Error al actualizar los datos.'
         icon = 'error'
      }
         Swal.fire({
           title: 'ACTUALIZAR ROL',
           text:text,
           icon: icon,
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
 var nombre
 var nivel
  function abrirModalAct(id){
    var modal = '#modalAct'+id
    $(modal).modal('toggle'); 
    nombre=$('input#name'+id).val();
    nivel=  $('input#nivel'+id).val();
  }
  function cerrarModalAct(id){
    var modal = '#modalAct'+id
    $('input#name'+id).val(nombre);
    $('input#nivel'+id).val(nivel);
    $(modal).modal('toggle'); 
  }