function guardar(){
    var data = new FormData();
    var ruc =$('input#ruc').val()
    var razon=$('input#razon').val()
    var nombreE=$('input#nombreE').val()
    var direcE = $('input#direcE').val()
    var rubro=$('input#rubro').val()

    var dni=$('input#dni').val()
    var nombres=$('input#nombres').val()
    var apellidos=$('input#apellidos').val()
    var nacimiento=$('input#nacimiento').val()
    var sexo=$('select#sexo').val();
    var celular=$('input#celular').val()
    var direcP=$('input#direcP').val()
  
  
    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('ruc', ruc);
    data.append('razon', razon);
    data.append('nombreE', nombreE);
    data.append('direcE', direcE);
    data.append('rubro', rubro);

    data.append('dni', dni);
    data.append('nombres', nombres);
    data.append('apellidos', apellidos);
    data.append('nacimiento', nacimiento);
    data.append('sexo', sexo);
    data.append('celular', celular);
    data.append('direcP', direcP);
  
    $.ajax({
        url: "/cliente/guardar",
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
              title: 'GUARDAR CLIENTE',
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
    $('input#empresa').prop("checked",true)
    $('div#empresaDiv').show()
    $('div#personaDiv').hide()
    $('input#persona').prop("checked",false)

    //Empresa
    limpiarEmpresa()

    //Persona
    limpiarPersona()

  }
  function limpiarEmpresa(){
    $('input#ruc').val('')
    $('input#razon').val('')
    $('input#nombreE').val('')
    $('input#direcE').val('')
    $('input#rubro').val('')
  }
  
  function limpiarPersona(){
    $('input#dni').val('')
    $('input#nombres').val('')
    $('input#apellidos').val('')
    $('input#nacimiento').val("")
    $('select#sexo').prop("selectedIndex", 0).val();
    $('input#celular').val('')
    $('input#direcP').val('')
  }
  
  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' CLIENTE',
      text: '¿Desea ' + tipo+ ' el cliente seleccionado?',
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
          url: "/cliente/eliminar/"+id,
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
    var ruc =$('input#ruc'+id).val()
    var razon=$('input#razon'+id).val()
    var nombreE=$('input#nombreE'+id).val()
    var direcE = $('input#direcE'+id).val()
    var rubro=$('input#rubro'+id).val()

    var dni=$('input#dni'+id).val()
    var nombres=$('input#nombres'+id).val()
    var apellidos=$('input#apellidos'+id).val()
    var nacimiento=$('input#nacimiento'+id).val()
    var sexo=$('select#sexo'+id).val();
    var celular=$('input#celular'+id).val()
    var direcP=$('input#direcP'+id).val()

    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('ruc', ruc);
    data.append('razon', razon);
    data.append('nombreE', nombreE);
    data.append('direcE', direcE);
    data.append('rubro', rubro);

    data.append('dni', dni);
    data.append('nombres', nombres);
    data.append('apellidos', apellidos);
    data.append('nacimiento', nacimiento);
    data.append('sexo', sexo);
    data.append('celular', celular);
    data.append('direcP', direcP);

    $.ajax({
      url: "/cliente/actualizar/"+id,
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
          text='Se actualizaron correctamente los dato.'
       }
       else{
          text='Error al actualizar los datos.'
       }
          Swal.fire({
            title: 'ACTUALIZAR CLIENTE',
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