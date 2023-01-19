$('document').ready(show());
function show(){
    var pension =$('select#colPension option:selected').text()
    if(pension=='ONP'){
        $('div#comision').hide()
    }
    else{
        $('div#comision').show()
    }
}

function guardar(){
    var data = new FormData
    nombre=$('input#colNombres').val();
    apellidos=$('input#colApell').val();
    dni=$('input#colDNI').val();
    nacimiento=$('input#colNac').val();
    direccion=$('input#colDirec').val();
    sexo=$('select#colSexo').val();
    celular=$('input#colCel').val();
    cargo=$('select#colCargo').val();
    sueldo=$('input#colSueldo').val();
    rol=$('select#colRol').val();
    pension=$('select#colPension').val();
    comision=$('select#colComision').val();
    asigFam=$('input#colAsigFam').prop('checked');
    sctr=$('input#colSctr').prop('checked');

    data.append('_token', $('meta[name="_token"]').attr('content') );
   data.append('colNombres', nombre);
   data.append('colDNI', dni);
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
    url: "/colaborador/guardar",
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
        icon=data
     }
     if (data=='error'){
        text='Error al guardar los datos.'
        icon = 'error'
     }
     if (data=='error-2'){
      text='Ya se ha registrado una persona con el DNI '+dni+'.'
      icon = 'error'
   }
        Swal.fire({
          title: 'GUARDAR COLABORADOR',
          text:text,
          icon: icon,
          showCloseButton: true,
          confirmButtonText: 'Ok',
          focusConfirm: false
        }).then((result) => {
          if (data!='error-2'){
          location.href='/Colaborador/registro'
          }
        })  
    }
  });
}