function guardar(){
    var data = new FormData();
    var namePen = $('input#namePen').val();
    var oblig= $('input#oblig').val();
    var comFlujo= $('input#comFlujo').val();
    var comMixta= $('input#comMixta').val();
    var seg= $('input#seg').val();
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('namePen', namePen);
    data.append('oblig', oblig);
    data.append('comFlujo', comFlujo);
    data.append('comMixta', comMixta);
    data.append('seg', seg);
  
    $.ajax({
        url: "/pension/guardar",
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
              title: 'GUARDAR PENSIÓN',
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
    $('input#namePen').val('');
    $('input#oblig').val('');
    $('input#comFlujo').val('');
    $('input#comMixta').val('');
    $('input#seg').val('');
  }
  
  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' PENSIÓN',
      text: '¿Desea ' + tipo+ ' el sistema de pensión seleccionada?',
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
          url: "/pension/eliminar/"+id,
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
   
    $('input#namePen').val('');
    $('input#oblig').val('');
    $('input#comFlujo').val('');
    $('input#comMixta').val('');
    $('input#seg').val('');


    var data = new FormData

    pension='input#namePen'+id
    var namePen = $(pension).val();
    obligatorio ='input#oblig'+id
    var oblig=$(obligatorio).val()
    flujo='input#comFlujo'+id
    var comFlujo=$(flujo).val()
    mixta='input#comMixta'+id
    var comMixta=$(mixta).val()
    seguro='input#seg'+id
    var seg=$(seguro).val()

    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('namePen', namePen);
    data.append('oblig', oblig);
    data.append('comFlujo', comFlujo);
    data.append('comMixta', comMixta);
    data.append('seg', seg);

    $.ajax({
      url: "/pension/actualizar/"+id,
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
            title: 'ACTUALIZAR PENSIÓN',
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