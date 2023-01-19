function generar(periodo, inicio,fin,registro){
    let detalle= new Array
    const nroFilas=$('#tableP>tbody tr').length;
    var x=0
    if (nroFilas>0){

        var data = new FormData();

        var total=0.00;
       
        $('#tableP>tbody tr').each(function(){
            col=new Array
            for (let i = 0; i < 21; i++) {
                col.push($(this).find('td').eq(i).html())
                // console.log(col)
                if(i>17){
                   total+=parseFloat(col[i].substr(3))
                }
                
            }
            detalle[x]=col
            x+=1
        })
        var datos ={
            periodo:periodo,
            inicio:inicio,
            fin:fin,
            registro:registro,
            detalle:detalle,
            total:total
        }
    
        data.append('_token', $('meta[name="_token"]').attr('content') );
        data.append('datos', JSON.stringify(datos));

        $.ajax({
            url: '/planilla/guardar',
            data:data,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function(data){
                
                var text;
                if (data=='success'){
                    text='Se generó correctamente la planilla, junto con las boletas.'
                }
                else{
                    text='ERROR AL GUARDAR LOS DATOS.'
                }
                    Swal.fire({
                        title: 'GUARDAR PLANILLA',
                        text:text,
                        icon: data,
                        showCloseButton: true,
                        confirmButtonText: 'Ok',
                        focusConfirm: false
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) { 
                            location.href='/Planillas'
                        } 
                    })
            }
        });
       
    }
    else{
        Swal.fire({
            title: 'GUARDAR PLANILLA',
            text:'No existen datos en este periodo. Genérelos primero',
            icon: 'error',
            showCloseButton: true,
            confirmButtonText: 'Ok',
            focusConfirm: false
        })
    }
    
} 
function imprimir(id){
    $.ajax({
        url: "/planilla/descarga/"+id,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
          
        }
      });
}
