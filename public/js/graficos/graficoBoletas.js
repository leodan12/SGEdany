$('document').ready(function(){
    $.ajax({
        url: APP_URL + "/Boletas/Grafico" ,
        type: 'get',
        success: function(data){

            var meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Set','Oct','Nov','Dic'];
            var boletas = [];

            for (var i = 0; i < data.length; i++) {

                boletas.push(data[i].boletas);
            }
            console.log(boletas);
            grafico(meses,boletas);
        }
    });
})

function grafico(meses,boletas){
    var ctx= document.getElementById('boletas').getContext('2d');
    var myChart= new Chart(ctx,{
        type: 'line',
        data:{
            labels:meses,
            fontColor:'black',
            datasets:[{
                label:'Grafico Horas Trabajadas',
                data:boletas,
                backgroundColor:'rgb(105, 54, 241 )',
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

                  fontColor: 'rgb(105, 54, 241 )'
                }
            }
        }
    });
}
