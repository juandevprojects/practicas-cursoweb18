$(document).ready(function () {
   

    // Esta función es para chequear los campos del formulario html y enviar luego esos datos por ajax a un php llamado procesa.php
    $("#formoid").submit(function (event) {
        /* detengo el submit por defecto de un formulario al clickear el botón submit */
        event.preventDefault();
        // console.log("Submit Detenido")
        // console.log($("#formoid").attr("class"))
        
        // ****** Chequeo los campos del formulario
        $("form").attr("class", "was-validated"); // Cambio el atributo class del formulario para que me muestre los campos que hace falta rellenar utilizando bootstrap

        // Chequeo si los datos están completos para proceder a enviarlos por ajax
        var fsolicitante = $("#fsolicitante").val()
        var fambito = $("#fambito").val()
        var faula = $("#faula").val()
        var fcategoria = $("#fcategoria").val()
        var fsubcat = $("#fsubcat").val()        
        var fincidencia = $("#fincidencia").val()

        fprioalta = document.getElementById("fprioalta").checked;
        fpriobaja = document.getElementById("fpriobaja").checked;

        if (fprioalta) {
            var prioridad = "1"
        } else if (fpriobaja) {
            var prioridad = "0"
        } else {
            var prioridad = ""; // Esto se establece así en el caso de que no se seleccione ninguna prioridad
        }

        console.log("Código fsolicitante: " + fsolicitante)
        console.log("Código fambito: " + fambito)
        console.log("Código faula: " + faula)
        console.log("Código fcategoria: " + fcategoria)
        console.log("Código fsubcat: " + fsubcat)
        console.log("Código fincidencia: " + fincidencia)
        console.log("Pioridad: " + prioridad)
        // console.log("Prio baja es: " + fpriobaja)
        // console.log("Prio alta es: " + fprioalta)


        // if (((fsolicitante === "") || (fambito === "") || (faula === "") || (fcategoria === "") || (fsubcat === "") || (fprioalta === "") || (fpriobaja === "") || (fincidencia === "") )) {
        if (((fsolicitante === "") || (fambito === "") || (faula === "") || (fcategoria === "") || (fsubcat === "") || (fincidencia === "") || (prioridad === ""))) {
            $.alert("Introduzca los datos obligatorios")

        } else {
            console.log("entro en ajax")
            $.ajax({
                url: 'http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr06/php/procesa.php',
                type: 'POST',
                dataType: 'JSON',
                retrieve: true,
                data: {
                    'fsolicitante': fsolicitante,
                    'fambito' : fambito,
                    'faula': faula,
                    'fcategoria': fcategoria,
                    'fsubcat': fsubcat,
                    'fincidencia': fincidencia,
                    'prioridad': prioridad,
                },

                success: function (result) {
                    $.alert("El resultado es: "+result)
                    
                    
                },

                error: function (xhr) {
                    $.alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
                }
            })    
        }
    })



    // Esta función es para chequear los campos del formulario html que están en el php constructor
    $("#formobservaciones").submit(function (event) {    

        if ($("#fobservaciones").val() === "" ) {
            event.preventDefault(); // Si el formulario está vacío detengo el submit
            // ****** Chequeo los campos del formulario
            $("form").attr("class", "was-validated"); // Cambio el atributo class del formulario para que me muestre los campos que hace falta rellenar utilizando bootstrap
           
        } else {      
       
        }
    })


    // Este código es para chequear si se envió la incidencia o no
    $(function () {
        console.log($("#controlador").text())

        if ($("#controlador").text() == "1" ) {
            $.alert("Las observaciones se han guardado en la base de datos exitosamente")
        } else if ($("#controlador") == "2") {
            $.alert("No se guardaron las observaciones, porque no conectó  a la base de datos")
        } else {

        }
    })

    // Esta función es para que cuando el usuario salga del campo nombre, se realice una llamada Ajax a un programa php (compruebanombre.php) que verificará si el nombre comienza por J o por A, lo considerará válido; sino, mostrará una alerta en pantalla y pondrá el cursor (foco) en el campo nombre para que se modifique por otro válido.
    // $("#fnombre").on('blur', function () {
    // // document.getElementById("fnombre").addEventListener("blur", function () {
    //     // $.alert("OJO! te saliste del campo nonmbre")
    //     var fnombre = $("#fnombre").val()
    //     var flag = 0
    //     $.ajax({
    //         url: 'http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr04/php/compruebanombre.php',
    //         type: 'POST',
    //         dataType: 'JSON',
    //         retrieve: true,
    //         data: {
    //             'fnombre': fnombre,                
    //         },
    //         async: 'false',

    //         success: function (result) {
                
    //             if (result == "SN") {
    //                 flag = 1;
    //                 $.alert("Debe introducir el nombre");
    //                 // console.log(window.activeElement)                    
    //             } else if (result == "BIEN") {
    //             // No hace nada, porque el nombre del formulario comienza por j o por a
    //             } else {
    //                 // $("#fnombre").get(0).addEventListener("focus", function () {}, false);
    //                 flag = 1;                    
    //                 $.alert("El nombre debe comenzar por J o por A");                    
    //                 // document.getElementById("fnombre").focus();
    //                 // Busca en google set focus element after blur event javascript
    //             }  

    //             return flag;                          
                
    //         },
            
    //         error: function (xhr) {
    //             $.alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
    //         }
    //     })    

    //     console.log("verifico el focus")
    //     console.log("flag igual a: "+ flag)
    //     // console.log("prueba igual a: " + prueba)

    //     if (flag == 1) {
    //         document.getElementById("fnombre").focus();
    //         flag = 0;
    //     }
    // })

    

    // Esta función modifica el formulario anterior añadiendo un nuevo desplegable (select) antes de el de las horas que tenga las ciudades de entrega “Valencia, Burjasot y Paterna” de tal forma que el cambiar el valor de la ciudad se realice una llamada Ajax a un programa php (damehoras2.php) que devolverá las horas disponibles de entrega y con ellas se rellenará el desplegable de forma dinámica el segundo desplegable. (En Valencia se entrega por las mañanas y en Burjasot y Paterna por las tardes)
    // $("#ciudades").change(function (){
    //     ciudad = $("#ciudades").val()

    //     $.ajax({
    //         url: 'http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr04/php/damehoras2.php',
    //         type: 'POST',
    //         dataType: 'JSON',
    //         retrieve: true,
    //         data: {
    //             'ciudad': ciudad,
    //         },

    //         success: function (result) {

    //             if (result == "MALO") {
    //                 $.alert("Debe seleccionar una ciudad!")
    //             } else {
    //                 var html_code = "";

    //                 // Aquí debo construir el contenido del formulario <select class="form-control" id="horas">
    //                 // Debe quedar algo así como <option value="int">Valor dado por php<option>
    //                 for (con = 0; con < result.length; con++) {

    //                     if (con == 0) {
    //                         html_code += "<option value=''>" + result[con] + "</option>"

    //                     } else {
    //                         html_code += "<option value='" + result[con] + "'>" + result[con] + "</option>"
    //                     }
    //                 }

    //                 $("#horas").html(html_code) //inyecto el código html dentro del formulario de selección
    //             }
                
    //         },

    //         error: function (xhr) {
    //             $.alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
    //         }
    //     })
    // })


    // Modificar el formulario anterior añadiendo un nuevo desplegable(select) antes de el de las ciudades que tenga los días de la semana de tal forma que se realizará una llamada Ajax cuando se cambie el día de la semana para que se admitan entregas: Los lunes, miércoles y viernes por las tardes las entregas son en Paterna, los martes y jueves por las tardes en Burjasot y durante todos los días de la semana excepto el domingo, se puede entregar por las mañanas en Valencia.

    // $("#dias").change(function () {
    //     dia = $("#dias").val()
    //     // ciudad = $("#ciudades").val()

    //     $.ajax({
    //         url: 'http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr04/php/dameciudades.php',
    //         type: 'POST',
    //         dataType: 'JSON',
    //         retrieve: true,
    //         data: {
    //             'dia': dia,
    //             // 'ciudad': ciudad,
    //         },

    //         success: function (result) {

    //             if (result == "MALO") {
    //                 $.alert("Debe seleccionar una ciudad!")
    //             } else {
    //                 var html_code = "";

    //                 // Aquí debo construir el contenido del formulario <select class="form-control" id="horas">
    //                 // Debe quedar algo así como <option value="int">Valor dado por php<option>
    //                 for (con = 0; con < result.length; con++) {

    //                     if (con == 0) {
    //                         html_code += "<option value=''>" + result[con] + "</option>"

    //                     } else {
    //                         html_code += "<option value='" + result[con] + "'>" + result[con] + "</option>"
    //                     }
    //                 }

    //                 $("#ciudades").html(html_code) //inyecto el código html dentro del formulario de selección
    //             }

    //         },

    //         error: function (xhr) {
    //             $.alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
    //         }
    //     })
    // })





     // Esta función es para cargar las horas disponibles en un php llamado damehoras.php en el formulario de selección. ***La comento para que tenga efecto la función que despliega el horario por ciudades
    //  $(function () {
    //      $.ajax({
    //          url: 'http://localhost/practicas-cursoweb18/jdelg-pr1844-02/pr04/php/damehoras.php',
    //          type: 'POST',
    //          dataType: 'JSON',
    //          retrieve: true,
    //          data: {
    //              'chequeo': 'verdadero',
    //          },

    //          success: function (result) {
    //              var html_code = "";

    //              // Aquí debo construir el contenido del formulario <select class="form-control" id="horas">
    //              // Debe quedar algo así como <option value="int">Valor dado por php<option>
    //              for (con = 0; con < result.length; con++) {

    //                  if (con == 0) {
    //                      html_code += "<option value=''>" + result[con] + "</option>"

    //                  } else {
    //                      html_code += "<option value='" + result[con] + "'>" + result[con] + "</option>"
    //                  }
    //              }

    //              $("#horas").html(html_code) //inyecto el código html dentro del formulario de selección
    //          },

    //          error: function (xhr) {
    //              $.alert("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
    //          }
    //      })
    //  })



})