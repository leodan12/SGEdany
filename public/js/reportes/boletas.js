
$('document').ready(
    $('#OreporteT').hide(),
    $('#OreporteG').hide(),
    $('#Treporte').hide(),
    $('#Greporte').hide(),
    $('#leyenda').hide()
);


var posiciones = [];
var nombres = [];
var datos = [];
var color=[]
var borde=[]

let lastPeriodo
var veces=0
var Rtabla = false
var Rgrafico = false

function verificar(){
    var periodo = $('select#periodo').val()

    veces+=1
    
    if(veces==1){
        lastPeriodo=periodo

        $('#alert').hide()
        generarGrafico(periodo) 
    }
    else{
        if(lastPeriodo!= periodo){
            lastPeriodo=periodo

            if(Rtabla)
            $('#Treporte').empty()
            if(Rgrafico){
                $("#Greporte").empty();
                $("#leyenda").remove();

                posiciones=[]
                nombres = [];
                datos = [];
            }

            $('#alert').hide()
            generarGrafico(periodo) 

        }
    }
    
}
function generarGrafico(periodo){

    var data = new FormData();
    data.append('_token', $('meta[name="_token"]').attr('content'))
    data.append('periodo', periodo)

    $.ajax({
        url: "/boletas/grafico",
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
                let canvas= $('<canvas id="grafico" width="00px" height="500px">')
                $('#Greporte').append(canvas)

                for (var i = 0; i < data.length; i++) {
                    var total = parseFloat(data[i].remuneracionNeta) +parseFloat(data[i].essalud)+parseFloat(data[i].sctr)

                    posiciones.push('Col. '+(i+1))
                    nombres.push(data[i].per_apellidos+' '+data[i].per_nombres);
                    datos.push(total.toFixed(2));
                    
                }
                

                let leyenda= $('<div class="row" id="leyenda">')
                $('#contenido').append(leyenda)
                
                let table= $('<div class="table table-borderless" id="Tleyenda">')
                
                let tbody=$('<tbody>')
                
                for (let i = 0; i < nombres.length; i++) {
                    var fila = '<tr>'+
                        '<td id="pos"> ' + posiciones[i] + ': </td>'+
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
                generarTabla(periodo)
            }
            else{
                $('#Alert').hide()
                $('#OreporteT').hide()
                $('#Treporte').hide()
                $('#OreporteG').hide()
                $('#Greporte').hide()

                Swal.fire({
                    title: 'GENERAR REPORTE',
                    text:'No se encontraron datos en el periodo seleccionado',
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
     
    //setup block 
    const data={
        labels: nombres,
        datasets: [{
            data: datos,
            backgroundColor:color,
            borderColor: borde,
            borderWidth: 1
        }]
    }
    //options block
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
                    text: 'Costo de Boleta (S/)'
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
                text: 'Boletas Generadas',
                padding: {
                    bottom: 30
                }
            }
            
        }
    }

    //config block  
    const config = {
        type: 'bar',
        data,
        options
    
    }

    //init block
    var myChart = new Chart(document.getElementById('grafico'),config)
    Rgrafico = true
}
function generarTabla(periodo){
    $.ajax({
        url: "/boletas/reporte/periodo="+periodo,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'GET',
        success: function(data){
            let table= $('<table class="table" id="datatablesSimple">')
            let thead =$('<thead>')
            let cabecera=$('<tr>')
            cabecera.append('<th scope="col">#</th>')
            cabecera.append('<th scope="col">A nombre de</th>')
            cabecera.append('<th scope="col">Cargo</th>')
            cabecera.append('<th scope="col">Total</th>')
            $(thead).append(cabecera)

            let tbody=$('<tbody>')
            for (let i = 0; i < data.length; i++) {
                var total = parseFloat(data[i].remuneracionNeta) +parseFloat(data[i].essalud)+parseFloat(data[i].sctr)
                var fila = '<tr>'+
                    '<td>' + (i+1) + '</td>'+
                    '<td>' + data[i].per_apellidos+' '+data[i].per_nombres + '</td>'+
                    '<td>' + data[i].Car_nombre+  '</td>'+
                    '<td> S/' + total.toFixed(2) + '</td>'+
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
    let periodo= $('select#periodo').val()
    window.open("http://127.0.0.1:8000/descargar/boletas/tabla/"+periodo)
}
function verGrafico(){

    $('#OreporteT').hide()
    $('#OreporteG').show()
    $('#Treporte').hide()
    $('#Greporte').show()
    $('#leyenda').show()
}
function pdfGrafico(){
    let periodo= $('select#periodo').val()

    window.open("http://127.0.0.1:8000/descargar/boletas/grafico/"+periodo)
}