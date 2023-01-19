function verificar(){
    if($("table#detalle tr").length !=0){
      guardar()
    }
    else{
      Swal.fire({
        title: 'GUARDAR KARDEX',
        text:'No se ha ingresado el detalle de la hoja.',
        icon: 'error',
        showCloseButton: true,
        confirmButtonText: 'Ok',
        focusConfirm: false
      })
    }
  }
  function guardar(){

    var data = new FormData();
    var prod=$('input#codProd').val()
    var ubicacion = $('select#ubicacion').val()
    var cantidad = $('input#cantidad').val()
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('prod', prod)
    data.append('ubicacion', ubicacion)
    data.append('cantidad', cantidad)
  
    $.ajax({
        url: "/kardex/guardar",
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
              title: 'GUARDAR KARDEX',
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
    $('select#codProd').prop("selectedIndex", 0).val()
    $('input#cant').val('')
  }
function eliminar(id){
    Swal.fire({
      title: 'ELIMINAR HOJA DE ALMACÉN',
      text: '¿Desea eliminar la hoja seleccionada?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#28D357',
      cancelButtonColor: '#EC1A1D',
      confirmButtonText: 'Si, eliminar!',
      cancelButtonText: 'No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "/hojaAlmacen/eliminar/"+id,
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
      } else if (result.dismiss === Swal.DismissReason.cancel) {
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
      title:'ELIMINAR HOJA DE ALMACÉN',
      text:'Hoja eliminada correctamente.',
      icon:'success'
    }).then((result) => {
      if (result.isConfirmed) {
        location.reload();
      }
    })
  }