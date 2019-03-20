$(document).ready(function () {

    $("#formoid").submit(function (event) {
        /* detengo el submit por defecto de un formulario al clickear el botón submit */
        // console.log("Submit Detenido")
        event.preventDefault();

        alert("Se presionó el botón submit");

    })
})