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
                "fval1": $("#fval1").val(),
                "fval2": $("#fval2").val(),
                "fval3": $("#fval3").val(),
                "fval4": $("#fval4").val(),
                "fval5": $("#fval5").val(),
                "fval6": $("#fval6").val(),
                "fval7": $("#fval7").val(),
                "fval8": $("#fval8").val(),
                "fval9": $("#fval9").val(),
                "fval10": $("#fval10").val(),
            },

            success: function (result) {

                if (result.resultado === "BIEN") {
                    $("#resultado").html("<h2>El prómedio de los 10 números es: "+ result.mensaje +"</h2>")

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