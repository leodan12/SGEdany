
function productos(){
  $.ajax({
      url: APP_URL + "/getProductosLibre",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      type: 'get',
      success: function(data){
        $('select#prod').empty();
        for (let i = 0; i < data.length; i++) {
          var valor = data[i].idProducto;
          var text =data[i].codProducto;
          $('select#prod').append($("<option>", {
            value: valor,
            text: text
          }));
          if(i==0){
            var menor=valor
          }
        }
        $("select#prod option[value='"+menor+"']").attr("selected", true);
        ubicaciones()
      }
  });
}
function ubicaciones(){
  $.ajax({
      url: APP_URL + "/getUbicaciones",
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      type: 'get',
      success: function(data){
        $('select#ubicacion').empty();
        for (let i = 0; i < data.length; i++) {
          var valor = data[i].idUbicacion;
          var text =data[i].Ubic_nombre;
          $('select#ubicacion').append($("<option>", {
            value: valor,
            text: text
          }));
          if(i==0){
            var menor=valor
          }
        }
        $("select#ubicacion option[value='"+menor+"']").attr("selected", true);
        buscaProducto()
      }
  });
}

function buscaProducto(){
  var data = new FormData();
  var prod = $('#prod').val();
  data.append('_token', $('meta[name="_token"]').attr('content') );
  data.append('prod', prod);

  $.ajax({
      url: APP_URL + "/getProducto",
      data: data,
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data){
          var nombre = document.getElementById('nombre');
          nombre.value = data.Prod_nombre;
          $('#nombre').prop('disabled',true);
          
      }
  });
}

function verificar(){
    if( $('input#cantidad').val() !=''){
      guardar()
    }
    else{
      Swal.fire({
        title: 'GUARDAR KARDEX',
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
    var prod=$('select#prod').val()
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
    
    $('select#prod').prop("selectedIndex", 0).val()
    $('select#ubicacion').prop("selectedIndex", 0).val()
    $('input#cantidad').val('')
  }

  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' KADEX',
      text: '¿Desea ' + tipo+ ' el kardex seleccionado?',
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
          url: "/kardex/eliminar/"+id,
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
    var prod=$('select#prod'+id).val()
    var ubicacion = $('select#ubicacion'+id).val()
    var cantidad = $('input#cantidad'+id).val()
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('prod', prod)
    data.append('ubicacion', ubicacion)
    data.append('cantidad', cantidad)

    $.ajax({
      url: "/kardex/actualizar/"+id,
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
            title: 'ACTUALIZAR KARDEX',
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
          title: 'ACTUALIZAR KARDEX',
          text:text,
          icon: data,
          showCloseButton: true,
          confirmButtonText: 'Ok',
          focusConfirm: false
        })
       }
       if(data=='error-2'){
        Swal.fire({
            title: 'GUARDAR KARDEX',
            text:'Ya se ha registrado un producto en esa ubicación.',
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