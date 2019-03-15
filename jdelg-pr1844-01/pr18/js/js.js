$(document).ready(function () {
    // console.log("página cargada");

    $("#formoid").submit(function (event) {
        /* detengo el submit por defecto de un formulario al clickear el botón submit */
        // console.log("Submit Detenido")
        event.preventDefault();

        var $form = $(this);
        /* obtengo el atributo "action" del elemento <form action="">  */
        action_url = $form.attr('action');
        /* obtengo el atributo "method" del elemento <form method="">  */
        metodo = $form.attr('method');
        // console.log(action_url);
        // console.log(metodo);

        // Ejecuto ajax para actualizar el área del tríangulo con un proceso que se hace en un archivo php en el servidor
        $.ajax({
            url: action_url,
            type: metodo,
            dataType: "JSON",
            retrieve: true,
            data: {
                "feuros" : $("#feuros").val(),
                "fdivisa": $("#fdivisa").val()               
            },

            success: function (result) {
                if ((result.resultado == "BIEN") && (result.divisa == "PESETAS")) {
                    $("#resultado").html("<h4>"+result.euros+" Euros son: "+result.mensaje + " Pesetas</h4>")
                } else if ((result.resultado == "BIEN") && (result.divisa == "DOLARES")) {
                    $("#resultado").html("<h4>" + result.euros + " Euros son: " + result.mensaje + " Dolares</h4>")
                } else if (result.resultado == "MAL") {
                    $("#resultado").html(result.mensaje)
                } else {
                    $("#resultado").html(result.mensaje)
                }                             
            },

            error: function (xhr) {
                alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);                
            }            
        });
        // console.log("ajax ejecutado")
    });









        
    
});