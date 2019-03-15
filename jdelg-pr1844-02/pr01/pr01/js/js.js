$('#idboton').on('click', function(){
    var texto = $('#idnombre').val();
    nombre = texto;
    if (texto.length == 0){
        $.alert('Debes introducir el nombre');
    }else{
        texto = $('#iddireccion').val();
        direccion = texto;
        if (texto.length == 0){
            $.alert('Debes introducir la dirección');
        }else{
            hora = $('#idselect').val();
            observaciones = $('#idobservaciones').val();
            texto="<h4>¿Esta seguro de enviar estos datos?</h4>";
            texto+="<p>Nombre: "+nombre+"</p>";
            texto+="<p>Dirección: "+direccion+"</p>";
            texto+="<p>Hora: "+$( 'select option:selected' ).text()+"</p>";
            texto+="<p>Observaciones: "+observaciones+"</p>";
            $.confirm({
                title: 'Confirmación!',
                content: texto,
                buttons: {
                    aceptar: function () {
                        // $.alert('Confirmado!');
                        $.ajax({
                            url: 'http://localhost/PR1844_02CLASE/pr01/php/procesa.php',
                            type: 'POST',
                            retrieve: true,
                            dataType: "JSON",
                            data:{
                                'nombre': nombre,
                                'direccion': direccion,
                                'hora': hora,
                                'observaciones': observaciones,
                            },
                            success: function (viene_de_php){
                                texto="<h5>Datos registrados</h5>";
                                texto+="<p>Nombre: "+viene_de_php.nombre+"</p>";
                                texto+="<p>Dirección: "+viene_de_php.direccion+"</p>";
                                texto+="<p>Hora: "+viene_de_php.hora+"</p>";
                                texto+="<p>Observaciones: "+viene_de_php.observaciones+"</p>";
                                $.alert(texto);
                                // alert ("PERFECTO!!!")
                                // var codigohtml = '';
                                // for (conta = 0; conta < viene_de_php.length; conta++) {
                                //     codigohtml +="<option value='"+conta+"'>"+viene_de_php[conta]+"</option>";
                                // }
                                // $('#idselect').html(codigohtml);

                            },
                            error: function() {
                                alert("ERROR Se ha producido un error en la comunicacion.");
                            }
                        })
                    },
                    cancelar: function () {
                        $.alert('Cancelado!');
                    }
                }
            });
        }
    }
});

$(function() {
    $.ajax({
        url: 'http://localhost/PR1844_02CLASE/pr01/php/damehoras.php',
        type: 'POST',
        retrieve: true,
        dataType: "JSON",
        data:{
            'chequeo': "meloinvento33",
        },
        success: function (viene_de_php){

            var codigohtml = '';
            for (conta = 0; conta < viene_de_php.length; conta++) {
                codigohtml +="<option value='"+conta+"'>"+viene_de_php[conta]+"</option>";
            }
            $('#idselect').html(codigohtml);
            // alert(codigohtml);
        },
        error: function() {
            alert("ERROR Se ha producido un error en la comunicacion.");
        }
    })
});