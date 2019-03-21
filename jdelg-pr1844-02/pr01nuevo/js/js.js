$(document).ready(function () {

    $("#formoid").submit(function (event) {
        /* detengo el submit por defecto de un formulario al clickear el botón submit */
        // console.log("Submit Detenido")
        event.preventDefault();

        $.alert({
            animation: 'none',
            closeAnimation: 'scaleY',
            // theme: 'dark',
            title: 'Botón clickeado!',
            content: 'Acaba de enviar el pedido.',
        });

    })
})