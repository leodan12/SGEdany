$('document').ready(
    $('#alert').hide(),
    $('#OreporteT').hide(),
    $('#OreporteG').hide(),
    $('#Treporte').hide(),
    $('#Greporte').hide(),
    $('#leyenda').hide()
);

var posiciones = [];
var nombres = [];
var datos = [];
var color
var borde


let lastInicio
let lastFin
var veces=0
var Rtabla = false
var Rgrafico = false


function verificar(){
    let inicio= $('select#inicio').val()
    let fin=$('select#fin').val()

    veces+=1
    

    if(veces==1){
        lastInicio=inicio
        lastFin=fin

        if(inicio>fin){
            Swal.fire({
                title: 'GENERAR REPORTE',
                text:'No se pudo generar el reporte debido a un error en las fechas seleccionadas.',
                icon: 'error',
                showCloseButton: true,
                confirmButtonText: 'Ok',
                focusConfirm: false
            })
            $('#alert').show();
        }
        else{
            $('#alert').hide()
            generarGrafico(inicio,fin)  
        }
    }
    else{
        
        if(lastInicio!= inicio || lastFin!=fin){
            lastInicio=inicio
            lastFin=fin
            if(Rtabla)
                $('#Treporte').empty()
            if(Rgrafico){
                $("#Greporte").empty();
                $("#leyenda").remove();

                posiciones=[]
                nombres = [];
                datos = [];
            }


            if(inicio>fin){
                Swal.fire({
                    title: 'GENERAR REPORTE',
                    text:'No se pudo generar el reporte debido a un error en las fechas seleccionadas.',
                    icon: 'error',
                    showCloseButton: true,
                    confirmButtonText: 'Ok',
                    focusConfirm: false
                })
                $('#alert').show();
            }
            else{
                $('#alert').hide()
                generarGrafico(inicio,fin)  
            }
        }
    }
    
}
function generarGrafico(inicio,fin){

    var data = new FormData();
    data.append('_token', $('meta[name="_token"]').attr('content'))
    data.append('inicio', inicio)
    data.append('fin', fin)

    $.ajax({
        url: "/planillas/grafico",
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){

            if(data.length>0){

                $('#Greporte').show()
                let canvas= $('<canvas id="grafico" width="00px" height="400px">')
                $('#Greporte').append(canvas)

                

                for (var i = 0; i < data.length; i++) {
                    posiciones.push("Per. "+(i+1)+"")
                    nombres.push(data[i].Periodo);
                    datos.push(data[i].Plan_costo);
                }

                let leyenda= $('<div class="row" id="leyenda">')
                $('#contenido').append(leyenda)
                
                let table= $('<div class="table table-borderless" id="Tleyenda">')
                
                let tbody=$('<tbody>')
                var fila = '<tr>'+
                        '<td> LEYENDA: </td>'
                    '</tr>'
                $(tbody).append(fila);
                for (let i = 0; i < nombres.length; i++) {
                    var fila = '<tr>'+
                        '<td id="pos"> Per. ' + (i+1) + ': </td>'+
                        '<td id="nombre">' + nombres[i] + '</td>'+
                    '</tr>'

                    $(tbody).append(fila);
                }
                table.append(tbody)
                $('#leyenda').append(table)
                $('#leyenda').hide()

                var a=161
                var b=2
                var c=2

                var random=Math.round(Math.random() * (122 - 1) + 1)

                if(random%2==0){
                    b=random
                }else{
                    c=random
                }
                color='rgba('+a+','+b+', '+c+', 0.5)'
                borde='rgba('+a+','+b+', '+c+', 1)'
            
                grafico(posiciones,datos,color,borde);


                
                $('#Greporte').hide()
                generarTabla(inicio,fin)
            }
            else{
                $('#Alert').hide()
                $('#OreporteT').hide()
                $('#Treporte').hide()
                $('#OreporteG').hide()
                $('#Greporte').hide()

                if(inicio==fin)
                    text='No se encontraron datos en la fecha seleccionada'
                else
                    text='No se encontraron datos en el rango de fechas seleccionado'
                Swal.fire({
                    title: 'GENERAR REPORTE',
                    text:text,
                    icon: 'info',
                    showCloseButton: true,
                    confirmButtonText: 'Ok',
                    focusConfirm: false
                })
            }
        }
    });
}

function grafico(nombres,datos,color,borde){

    Chart.register(ChartDataLabels)

    const data={
        labels: nombres,
        datasets: [{
            data: datos,
            backgroundColor:color,
            borderColor: borde,
            borderWidth: 1
        }]
    }

    const options = {
        maintainAspectRatio:false,
        responsive:true,
        layout: {
            padding:{
                bottom: 20
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Costo de Planilla (S/)'
                  }
            }
        },
        plugins: {
            
            datalabels: {
                anchor:'end',
                align: 'end',
                font:{
                    weight: 'bold'
                }
            },
            legend:{
                display: false
            },
            title: {
                display: true,
                text: 'Planillas',
                padding: {
                    bottom: 30
                }
            }
            
        }
    }

    const config = {
        type: 'bar',
        data,
        options
    
    }
    var myChart = new Chart(document.getElementById('grafico'),config)
    Rgrafico = true
}
function generarTabla(inicio,fin){
    $.ajax({
        url: "/planillas/reporte/desde="+inicio+"/hasta="+fin,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
            if(data.length>0){
                
                let table= $('<table class="table" id="datatablesSimple">')
                let thead =$('<thead>')
                let cabecera=$('<tr>')
                cabecera.append('<th scope="col">#</th>')
                cabecera.append('<th scope="col">Periodo</th>')
                cabecera.append('<th scope="col">Registro</th>')
                cabecera.append('<th scope="col">Total</th>')
                $(thead).append(cabecera)

                let tbody=$('<tbody>')

                for (let i = 0; i < data.length; i++) {
                    var fecha = new Date(data[0].Plan_registro)
                    var fila = '<tr>'+
                        '<td>' + (i+1) + '</td>'+
                        '<td>' + data[i].Periodo+ '</td>'+
                        '<td>' + fecha.getDate()+'-'+fecha.getMonth().toString().padStart(2,0)+'-'+fecha.getFullYear() +  '</td>'+
                        '<td> S/' + data[i].Plan_costo + '</td>'+
                    '</tr>'
    
                    $(tbody).append(fila);
                }

                table.append(thead)
                table.append(tbody)
                $('#Treporte').append(table)
                const datatablesSimple = document.getElementById('datatablesSimple');
                if (datatablesSimple) {
                    new simpleDatatables.DataTable(datatablesSimple);
                }
                
                verTabla()
            }
            else{

                $('#Alert').hide()
                $('#OreporteT').hide()
                $('#Treporte').hide()
                $('#OreporteG').hide()
                $('#Greporte').hide()
                
                if(inicio==fin)
                    text='No se encontraron datos en el año '+inicio
                else
                    text='No se encontraron datos en el rango de años desde '+inicio+' hasta '+fin
                Swal.fire({
                    title: 'GENERAR REPORTE',
                    text:text,
                    icon: 'info',
                    showCloseButton: true,
                    confirmButtonText: 'Ok',
                    focusConfirm: false
                })
            }
        }
    })
    
}
function verTabla(){
    $('#OreporteT').show()
    $('#OreporteG').hide()
    $('#Treporte').show()
    $('#Greporte').hide(),
    $('#leyenda').hide()
}
function pdfTabla(){
    let inicio= $('select#inicio').val()
    let fin=$('select#fin').val()
    window.open("http://127.0.0.1:8000/descargar/planillas/tabla/"+inicio+"/"+fin)
}
function verGrafico(){

    $('#OreporteT').hide()
    $('#OreporteG').show()
    $('#Treporte').hide()
    $('#Greporte').show()
    $('#leyenda').show()
}
function pdfGrafico(){
    let inicio= $('select#inicio').val()
    let fin=$('select#fin').val()

    window.open("http://127.0.0.1:8000/descargar/planillas/grafico/"+inicio+"/"+fin)
}







function generar(inicio,fin){
    
    $('#datatablesSimple>tbody').empty();
    $.ajax({
        url: "/planillas/reporte/desde="+inicio+"/hasta="+fin,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
            if(data.length>0){
                
                let table= $('<table class="table" id="datatablesSimple">')
                let thead =$('<thead>')
                let cabecera=$('<tr>')
                cabecera.append('<th scope="col">#</th>')
                cabecera.append('<th scope="col">Periodo</th>')
                cabecera.append('<th scope="col">Registro</th>')
                cabecera.append('<th scope="col">Total</th>')
                $(thead).append(cabecera)

                let tbody=$('<tbody>')

                for (let i = 0; i < data.length; i++) {
                    var fecha = new Date(data[0].Plan_registro)
                    var fila = '<tr>'+
                        '<td>' + (i+1) + '</td>'+
                        '<td>' + data[i].Periodo+ '</td>'+
                        '<td>' + fecha.getDate()+'-'+fecha.getMonth().toString().padStart(2,0)+'-'+fecha.getFullYear() +  '</td>'+
                        '<td> S/' + data[i].Plan_costo + '</td>'+
                    '</tr>'
    
                    $(tbody).append(fila);
                }

                table.append(thead)
                table.append(tbody)
                $('#Treporte').append(table)
                const datatablesSimple = document.getElementById('datatablesSimple');
                if (datatablesSimple) {
                    new simpleDatatables.DataTable(datatablesSimple);
                }
                
                $('#Oreporte').show()
                $('#Treporte').show()
            }
            else{
                $('#Areporte').hide()
                $('#Oreporte').hide()
                $('#Treporte').hide()
                if(inicio==fin)
                    text='No se encontraron datos en el año '+inicio
                else
                    text='No se encontraron datos en el rango de años desde '+inicio+' hasta '+fin
                Swal.fire({
                    title: 'GENERAR REPORTE',
                    text:text,
                    icon: 'info',
                    showCloseButton: true,
                    confirmButtonText: 'Ok',
                    focusConfirm: false
                  })
            }
        }
    })
}

function pdf(){
    let inicio= $('select#inicio').val()
    let fin=$('select#fin').val()
    window.open("http://127.0.0.1:8000/descargar/planillas/"+inicio+'/'+fin)
}