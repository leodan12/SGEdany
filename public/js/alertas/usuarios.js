function abrirModal(){
  $("#modalAdd").modal("show");
  limpiarModal()
}
function limpiarModal(){ 
$('input#nombres').val('');
$('input#apellidos').val('');
$('input#dni').val('');
$('input#nacimiento').val('');
$('input#direccion').val('');
$('select#sexo').prop("selectedIndex", 0).val();
$('input#cel').val('');
}
function cerrarModal(){
  $("#modalAdd").modal("toggle");
}
  function cambioEstado(tipo,id){
    Swal.fire({
      title: 'USUARIOS',
      text: '¿Desea ' + tipo+ ' el usuario seleccionado?',
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
          url: "/usuario/eliminar/"+id,
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
  function resetPassword(id){
    Swal.fire({
      title: 'USUARIOS',
      text: '¿Desea reiniciar la contraseña del usuario seleccionado?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#28D357',
      cancelButtonColor: '#EC1A1D',
      confirmButtonText: 'Si, reiniciar!',
      cancelButtonText: 'No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "/usuario/reiniciar/"+id,
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
  var nombre, apellidos,dni,nacimiento, direccion, sexo,celular
  function abrirModalAct(id){
    var modal = '#modalAdd'
    $(modal).modal('toggle'); 
    nombre=$('input#nombres'+id).val();
    apellidos=$('input#apellidos'+id).val();
    dni=$('input#dni'+id).val();
    nacimiento=$('input#nacimiento'+id).val();
    direccion=$('input#direccion'+id).val();
    sexo=$('select#sexo'+id).val();
    celular=$('input#cel'+id).val();
  }
  function cerrarModalAct(id){
    $('input#nombres'+id).val(nombre);
    $('input#apellidos'+id).val(apellidos);
    $('input#dni'+id).val(dni);
    $('input#nacimiento'+id).val(nacimiento);
    $('input#direccion'+id).val(direccion);
    $('select#sexo'+id).val(sexo);
    $('input#cel'+id).val(celular);

    var modal = '#modalAct'+id
    $(modal).modal("toggle"); 
  }