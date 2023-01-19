$(document).ready(function() {
    $('#datatablesSimple').DataTable( {
        "language": {
            "sSearch":"Buscar:",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Sin registros aún",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros disponibles",
            "infoFiltered": "(filtrado de  _MAX_ registros totales)",
            "perPageSelect": [10, 30, 50, -1],
            "pageLength": 10,
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            
        }
    } );
});