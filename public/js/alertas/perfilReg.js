function registrar(tipo){
    $.ajax({
        url: "/usuario/registrar/"+tipo,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
            if (data='success'){
                Swal.fire({
                    title: 'REGISTRAR '+tipo.toUpperCase(),
                    text:'Se registró correctamente su '+tipo+'.',
                    icon: 'success',
                    showCloseButton: true,
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#28D357',
                    focusConfirm: false
                  }).then((result) => {
                      location.reload();
                  })
            }
            else{
                Swal.fire({
                    title: 'REGISTRAR '+tipo.toUpperCase(),
                    text:'Hubo un error al registrar su '+tipo+'.',
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
