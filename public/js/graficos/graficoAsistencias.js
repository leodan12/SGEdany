$('document').ready(function(){
    var data = new FormData();

    var inicio = $('#inicio').val();
    var fin = $('#fin').val();


    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('inicio', inicio);
    data.append('fin', fin);


    $.ajax({
        url: APP_URL + "/Asistencias/Grafico",
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){

            var nombres = [];
            var asistencias = [];

            for (var i = 0; i < data.length; i++) {

                nombres.push(data[i].colaborador);
                asistencias.push(data[i].asistencias);
            }
            grafico(nombres,asistencias);
        }
    });
})

function grafico(nombres,asistencias){
    var ctx= document.getElementById('asistencias').getContext('2d');
    var myChart= new Chart(ctx,{
        type: 'line',
        data:{
            labels: nombres,
            datasets:[{
                label:'Grafico Asistencias',
                data:asistencias,
                backgroundColor:[
                    'rgb(223, 91, 91)',
                ],
            }]
        },
        options:{
            scales:{
                yAxes:[{
                    ticks:{
                        beginAtZero: true,
                    }
                }]
            }
        }
    });
}
