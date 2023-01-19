$('document').ready($('div#personaDiv').hide());

$('input#empresa').on('change', this, function(){
    $('div#empresaDiv').show()
    $('div#personaDiv').hide()

    $('input#dni').val('')
    $('input#nombres').val('')
    $('input#apellidos').val('')
    $('input#nacimiento').val("")
    $('select#sexo').prop("selectedIndex", 0).val();
    $('input#celular').val('')
    $('input#direcP').val('')
});
$('input#persona').on('change', this, function(){
    $('div#empresaDiv').hide()
    $('div#personaDiv').show()

    $('input#ruc').val('')
    $('input#razon').val('')
    $('input#nombreE').val('')
    $('input#direcE').val('')
    $('input#rubro').val('')
});