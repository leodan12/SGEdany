var nombre, apellidos,dni,nacimiento, direccion, sexo,celular,cargo,sueldo,rol,pension,comision,asigFam,sctr
function abrirModalAct(id){
    var modal = '#modalAct'+id
    $(modal).modal('toggle'); 
    nombre=$('input#colNombres'+id).val();
    apellidos=$('input#colApell'+id).val();
    dni=$('input#colDNI'+id).val();
    nacimiento=$('input#colNac'+id).val();
    direccion=$('input#colDirec'+id).val();
    sexo=$('select#colSexo'+id).val();
    celular=$('input#colCel'+id).val();
    cargo=$('select#colCargo'+id).val();
    sueldo=$('input#colSueldo'+id).val();
    rol=$('select#colRol'+id).val();
    pension=$('select#colPension'+id).val();
    comision=$('select#colComision'+id).val();
    asigFam=$('input#colAsigFam'+id).prop('checked');
    sctr=$('input#colSctr'+id).prop('checked');
    show(id)
  }
  function cerrarModalAct(id){
    $('input#colNombres'+id).val(nombre);
    $('input#colApell'+id).val(apellidos);
    $('input#colDNI'+id).val(dni);
    $('input#colNac'+id).val(nacimiento);
    $('input#colDirec'+id).val(direccion);
    $('select#colSexo'+id).val(sexo);
    $('input#colCel'+id).val(celular);
    $('select#colCargo'+id).val(cargo);
    $('input#colSueldo'+id).val(sueldo);
    $('select#colRol'+id).val(rol);
    $('select#colPension'+id).val(pension)
    $('input#colAsigFam'+id).prop("checked", asigFam);
    $('input#colSctr'+id).prop("checked", sctr);

    var modal = '#modalAct'+id
    $(modal).modal("toggle"); 
  }
  function cambioEstado(tipo,id){
    Swal.fire({
      title: tipo.toUpperCase()+' COLABORADOR',
      text: '¿Desea ' + tipo+ ' el colaborador seleccionado?',
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
          url: "/Colaborador/eliminar/"+id,
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          cache: false,
          contentType: false,
          processData: false,
          type: 'GET',
          success: function(){
            console.log('si')
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
    nombre=$('input#colNombres'+id).val();
    apellidos=$('input#colApell'+id).val();
    dni=$('input#colDNI'+id).val();
    nacimiento=$('input#colNac'+id).val();
    direccion=$('input#colDirec'+id).val();
    sexo=$('select#colSexo'+id).val();
    celular=$('input#colCel'+id).val();
    cargo=$('select#colCargo'+id).val();
    sueldo=$('input#colSueldo'+id).val();
    rol=$('select#colRol'+id).val();
    pension=$('select#colPension'+id).val();
    comision=$('select#colComision'+id).val();
    asigFam=$('input#colAsigFam'+id).prop('checked');
    sctr=$('input#colSctr'+id).prop('checked');

   data.append('_token', $('meta[name="_token"]').attr('content') );
   data.append('colNombres', nombre);
   data.append('colApell', apellidos);
   data.append('colNac', nacimiento);
   data.append('colDirec', direccion);
   data.append('colSexo', sexo);
   data.append('colCel', celular);
   data.append('colRol', rol);
   data.append('colCargo', cargo);
   data.append('colSueldo', sueldo);
   data.append('colPension', pension);
   data.append('colComision', comision);
   data.append('colAsigFam', asigFam);
   data.append('colSctr', sctr);

   $.ajax({
     url: "/Colaborador/actualizar/"+id,
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
        text='Error al actualizar los datos.'
        icon = 'error'
      }
         Swal.fire({
           title: 'ACTUALIZAR COLABORADOR',
           text:text,
           icon: icon,
           showCloseButton: true,
           confirmButtonText: 'Ok',
           focusConfirm: false
         }).then((result) => {
           /* Read more about isConfirmed, isDenied below */
             location.reload();
          
         })  
     }
   });
 }
 function show(id){
  var select = 'select#colPension'+id+' option:selected'
  var pension =$(select).text()
  if(pension=='ONP'){
      $('div#comision').hide()
  }
  else{
      $('div#comision').show()
  }
}