$('document').ready(function(){
    var data = new FormData();

    var inicio = $('#inicio').val();
    var fin = $('#fin').val();


    data.append('_token', $('meta[name="_token"]').attr('content') );
    data.append('inicio', inicio);
    data.append('fin', fin);


    $.ajax({
        url: APP_URL + "/HorasTrabajadas/Grafico",
        data: data,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){

            var nombres = [];
            var horas = [];
            var colores = [];

            for (var i = 0; i < data.length; i++) {

                nombres.push(data[i].colaborador);
                horas.push(data[i].horas);
                colores.push('rgb(13, 132, 78');
            }
            console.log(colores);
            grafico(nombres,horas,colores);
        }
    });
})

function grafico(nombres,horas,color){
    var ctx= document.getElementById('horas_trabajadas').getContext('2d');
    var myChart= new Chart(ctx,{
        type: 'bar',
        data:{
            labels:nombres,
            fontColor:'black',
            datasets:[{
                label:'Grafico Horas Trabajadas',
                data:horas,
                backgroundColor:color,
                lineTension: 0,
                fontColor: 'black',
            }]
        },

        options:{

            scales:{
                yAxes:[{
                    ticks:{
                        beginAtZero: true,
                    }
                }]
            },
            legend: {
                display: true,
                position: 'top',
                labels: {

                  fontColor: 'rgb(21, 212, 125)'
                }
            }
        }
    });
}
