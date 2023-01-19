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
    if(Rgrafico){
        $("#Greporte").empty();
        $("#leyenda").remove();

        posiciones=[]
        nombres = [];
        datos = [];
    }

    let inicio= $('input#inicio').val()
    let fin=$('input#fin').val()

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

        veces+=1

        if(veces==1){
            lastInicio=inicio
            lastFin=fin
            
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
            }
        }
        generarGrafico(inicio,fin)  
    }
    
}
function generarGrafico(inicio,fin){

    var data = new FormData();
    data.append('_token', $('meta[name="_token"]').attr('content'))
    data.append('inicio', inicio)
    data.append('fin', fin)

    $.ajax({
        url: "/presupuestos/grafico",
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
                let canvas= $('<canvas id="canvas" width="00px" height="300px">')
                $('#Greporte').append(canvas)

                

                for (var i = 0; i < data.length; i++) {
                    posiciones.push("Pres. "+(i+1)+"")
                    nombres.push(data[i].codPresupuesto)
                    
                     datos.push(data[i].costoTotal);
                }

                let leyenda= $('<div class="row" id="leyenda">')
                $('#contenido').append(leyenda)
                
                let table= $('<div class="table table-borderless" id="Tleyenda">')
                
                let tbody=$('<tbody>')
                
                for (let i = 0; i < nombres.length; i++) {
                    var fila = '<tr>'+
                        '<td id="pos"> Pres. ' + (i+1) + ': </td>'+
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
    
    const options={
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
                    text: 'Costo (S/)'
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
                text: 'Presupuestos Generados',
                padding: {
                    bottom: 30
                }
            }
            
        }
    }

    const config={
        type: 'bar',
        data,
        options
    }

    var myChart = new Chart(document.getElementById('canvas'),config)
     
    Rgrafico = true
}
function generarTabla(inicio,fin){
    $('#datatablesSimple>tbody').empty();
    $.ajax({
        url: "/presupuestos/reporte/desde="+inicio+'/hasta='+fin,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){

            if(data.length>0){
                $('#Treporte').show()
                
                let table= $('<table class="table" id="datatablesSimple">')
                let thead =$('<thead>')
                let cabecera=$('<tr>')
                cabecera.append('<th scope="col">#</th>')
                cabecera.append('<th scope="col">Nro. Presupuesto</th>')
                cabecera.append('<th scope="col">ID Cliente</th>')
                cabecera.append('<th scope="col">Nombre Cliente</th>')
                cabecera.append('<th scope="col">Total</th>')
                cabecera.append('<th scope="col">Registrado el</th>')
                $(thead).append(cabecera)

                let tbody=$('<tbody>')
                
                for (let i = 0; i < data.length; i++) {
                    var fila = '<tr>'+
                        '<td>' + (i+1) + '</td>'+
                        '<td>' + data[i].cod+ '</td>'+
                        '<td>' + data[i].identificador+
                        '<td>' + data[i].cliente+ '</td>'+
                        '<td>' + data[i].total + '</td>'+
                        '<td>' + data[i].fecha + '</td>'+
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
                Rtabla=true

                verTabla()
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
    let inicio= $('input#inicio').val()
    let fin=$('input#fin').val()
    window.open("http://127.0.0.1:8000/descargar/presupuestos/tabla/"+inicio+"/"+fin)
}
function verGrafico(){

    $('#OreporteT').hide()
    $('#OreporteG').show()
    $('#Treporte').hide()
    $('#Greporte').show()
    $('#leyenda').show()
}
function pdfGrafico(){
    let inicio= $('input#inicio').val()
    let fin=$('input#fin').val()

    window.open("http://127.0.0.1:8000/descargar/presupuestos/grafico/"+inicio+"/"+fin)
}