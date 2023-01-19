function pdf(){
    id= $('h3').attr("id")
    
    window.open("http://127.0.0.1:8000/descargar/presupuesto/nro="+id)
}