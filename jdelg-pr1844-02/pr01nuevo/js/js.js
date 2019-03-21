$(document).ready(function () {

    // Esta función es para cargar las horas disponibles en un php llamado damehoras.php en el formulario de selección
    $(function () {
        $.ajax({
            url: 'http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr01nuevo/php/damehoras.php',
            type: 'POST',
            dataType: 'JSON',
            retrieve: true,
            data: {
                'chequeo' : 'verdadero',
            },

            success: function (result) {
                var html_code = "";
                
                // Aquí debo construir el contenido del formulario <select class="form-control" id="horas">
                // Debe quedar algo así como <option value="int">Valor dado por php<option>
                for (con = 0; con < result.length; con++) {

                    if (con==0) {
                        html_code += "<option value=''>" + result[con] + "</option>"
                        
                    } else {
                        html_code += "<option value='" + result[con] + "'>" + result[con] + "</option>"
                    }
                }

               $("#horas").html(html_code) //inyecto el código html dentro del formulario de selección
            },

            error: function (xhr) {
                $.alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
            }
        })
    })


    $("#formoid").submit(function (event) {
        /* detengo el submit por defecto de un formulario al clickear el botón submit */
        event.preventDefault();
        // console.log("Submit Detenido")
        // console.log($("#formoid").attr("class"))
        
        // ****** Chequeo los campos del formulario
        $("form").attr("class", "was-validated"); // Cambio el atributo class del formulario para que me muestre los campos que hace falta rellenar utilizando bootstrap

        // Chequeo si los datos están completos para proceder a enviarlos por ajax
        var fnombre= $("#fnombre").val()
        var fdireccion= $("#fdireccion").val()
        var horas= $("#horas").val()
        var observaciones = $("#observaciones").val()
        if (((fnombre === "") || (fdireccion === "") || (horas === ""))) {
            $.alert("Introduzca los datos obligatorios")

        } else {
            console.log("entro en ajax")
            $.ajax({
                url: 'http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr01nuevo/php/procesa.php',
                type: 'POST',
                dataType: 'JSON',
                retrieve: true,
                data: {
                    'fnombre' : fnombre, 
                    'fdireccion' : fdireccion,
                    'horas': horas,
                    'observaciones': observaciones
                },

                success: function (result) {
                    var contenido=""

                    if (result.length == 3) {
                        contenido = 'Nombre: ' + result[0] + '</br> \
                                  Dirección: ' + result[1] + '</br>\
                                  Entre las horas: ' + result[2] + ' </br>\
                                  Observaciones: NINGUNA'

                    } else {
                        contenido = 'Nombre: ' + result[0] + '</br> \
                                  Dirección: ' + result[1] + '</br>\
                                  Entre las horas: ' + result[2] + '</br>\
                                  Observaciones: ' + result[3]
                    }
                    
                    $.confirm({
                        title: 'Por favor chequee sus datos y confirme su pedido!',
                        content: contenido,
                        buttons: {
                            'Confirme envío': function () {
                                $.alert('Confirmed!');
                            },
                            cancel: function () {
                                $.alert('Canceled!');
                            },
                            // somethingElse: {
                            //     text: 'Something else',
                            //     btnClass: 'btn-blue',
                            //     keys: ['enter', 'shift'],
                            //     action: function () {
                            //         $.alert('Something else?');
                            //     }
                            // }
                        }
                    });
                    
                },

                error: function (xhr) {
                    $.alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
                }
            })
    
        }

        


    })







})