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
                "foperacion": $("#foperacion").val()
            },

            success: function (result) {

                if (result.resultado === "SUMA") {
                    $("#resultado").html("<h2>La suma de " + $("#fval1").val() + " y " +     $("#fval2").val()  + " es: " + result.mensaje + "</h2>")

                } else if (result.resultado === "RESTA") {
                    $("#resultado").html("<h2>La resta de " + $("#fval1").val() + " y " + $("#fval2").val() + " es: " + result.mensaje + "</h2>")
                } else if (result.resultado === "MULTIPLICACION") {
                    $("#resultado").html("<h2>La multiplicación de " + $("#fval1").val() + " y " + $("#fval2").val() + " es: " + result.mensaje + "</h2>")

                } else if (result.resultado === "DIVISION") {
                    $("#resultado").html("<h2>La división de " + $("#fval1").val() + " y " + $("#fval2").val() + " es: " + result.mensaje + "</h2>")
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