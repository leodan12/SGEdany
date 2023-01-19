function cancelar(){
    $('input#actual').val('')
    $('input#nueva').val('')
    $('input#repetida').val('')
}
function verificar(id){

    var contra = $('input#actual').val()
    var nueva = $('input#nueva').val()
    var repetida = $('input#repetida').val()
    
    if(contra!='' && nueva!=''&& repetida!=''){
        var data = new FormData();
        data.append('_token', $('meta[name="_token"]').attr('content') );
        data.append('contra', contra);
        $.ajax({
            url: "/contraseña/verificar/"+id,
            data: data,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data){
                if(data=='success'){
                    actualizarContraseña(id)
                }
                else{
                    Swal.fire({
                        title: 'ACTUALIZAR CONTRASEÑA',
                        text:'La contraseña actual no es correcta',
                        icon: 'error',
                        showCloseButton: true,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#28D357',
                        focusConfirm: false
                    })
                }
            }
        })
    }
    else{
        Swal.fire({
            title: 'ACTUALIZAR CONTRASEÑA',
            text:'Faltan datos requeridos',
            icon: 'error',
            showCloseButton: true,
            confirmButtonText: 'Ok',
            confirmButtonColor: '#28D357',
            focusConfirm: false
        })
    }
    
    
    
}
function actualizarContraseña(id){

    let nueva = $('input#nueva').val()
    let repetida = $('input#repetida').val()

    if(nueva == repetida){
        Swal.fire({
            title: 'ACTUALIZAR CONTRASEÑA',
            text: '¿Desea actualizar su contraseña?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28D357',
            cancelButtonColor: '#EC1A1D',
            confirmButtonText: 'Si, actualizar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed){

                var data = new FormData();
                var nueva = $('input#nueva').val()

                data.append('_token', $('meta[name="_token"]').attr('content') );
                data.append('nueva', nueva);

                $.ajax({
                url: "/contraseña/actualizar/"+id,
                data: data,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data){
                    if(data=='success'){
                        realizado()
                    }
                    else{
                        Swal.fire({
                            confirmButtonColor: '#28D357',
                            title:'ERROR',
                            text:'No se pudo actualizar su contraseña.',
                            icon:'error'
                        })
                    }
                    }
                })
            } else if ( result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                  confirmButtonColor: '#28D357',
                  title:'Cancelado',
                  text:'No se realizaron cambios.',
                  icon:'error'
                })
            }
        })
    }
    else{
        Swal.fire({
            title: 'ACTUALIZAR CONTRASEÑA',
            text:'Las constraseñas no coinciden.',
            icon: 'error',
            showCloseButton: true,
            confirmButtonText: 'Ok',
            focusConfirm: false
          })
    }
    
}
function realizado(){
    Swal.fire({
      confirmButtonColor: '#28D357',
      title:'REALIZADO!',
      text:'Se actualizó correctamente su contraseña.',
      icon:'success'
    }).then((result) => {
      if (result.isConfirmed) {
        location.reload();
      }
    })
  }