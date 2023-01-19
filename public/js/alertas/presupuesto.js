function cambioEstado(id){
    Swal.fire({
      title: 'ELIMINAR PRESUPUESTO',
      text: '¿Desea eliminar el presupuesto seleccionado?',
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
          url: "/presupuesto/eliminar/"+id,
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

function crearInforme(){

  // imagenes = []
  // altos = []
  // anchos = []
  // input = $('input#images')[0]

  alto = []
  ancho= []
  input = document.getElementById('images')

  var data = new FormData();
  data.append('_token', $('meta[name="_token"]').attr('content') );

  for (let x = 0; x < input.files.length; x++) {
   
    file = $('input#images')[0].files[x]
    data.append('img'+x, file)
    cant=x
  }

  data.append('cantidad', cant+1)
  id= $('h3').attr("id");
 
  data.append('id', id)

  $.ajax({
    url: "/imgInforme/guardar",
    data: data,
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST'
  });
   
}





function crearInformesssssss(){
  imagenes = []
  altos = []
  anchos = []
  input = document.getElementById('images')

  for (let x = 0; x < input.files.length; x++) {
    imagenes.push(input.files[x]);
    imagen = input.files[x]
    var _URL = window.URL || window.webkitURL;
    var img = new Image();
    img.src = _URL.createObjectURL(imagen);
    img.onload = function () {
        altos.push(img.height)
        anchos.push(img.width)
    }
    
  }
console.log($("input#images").val(''))
  var datos ={
    imagenes:imagenes,
    ancho:anchos,
    alto:altos,
   
  }

  var data = new FormData();
  data.append('_token', $('meta[name="_token"]').attr('content') );
  data.append('datos', JSON.stringify(datos));

  $.ajax({
    url: "/informePresupuesto/guardar",
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
function limpiarImagenes(){
  $('input#images').val('');
}