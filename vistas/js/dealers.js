$(function () { // Asegúrate de que el DOM esté completamente cargado
    function setButtonLabel(start, end) {
        // Formatea las fechas y actualiza el texto del botón utilizando el formato español
        let label = start.format('D [de] MMMM [de] YYYY') + ' - ' + end.format('D [de] MMMM [de] YYYY');
        $('#btnDatarangeD span').html(label);

        // Guarda el rango seleccionado en el almacenamiento local
        localStorage.setItem("capturarRango", label);

        // Opcionalmente, actualiza la URL o haz una petición AJAX aquí si no deseas redirigir
        window.location = "index.php?ruta=ventas-dealers&fechaInicial=" + start.format('YYYY-MM-DD') + "&fechaFinal=" + end.format('YYYY-MM-DD');
    }

    // Configura el daterangepicker con las opciones de localización en español
    $('#btnDatarangeD').daterangepicker({
        ranges: {
            'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
            'Este mes': [moment().startOf('month'), moment().endOf('month')],
            'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        },
        startDate: moment(),
        endDate: moment(),
        locale: {
            format: 'D [de] MMMM [de] YYYY', // Formato de fecha en español
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar',
            fromLabel: 'Desde',
            toLabel: 'Hasta',
            customRangeLabel: 'Rango personalizado',
            daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            firstDay: 1 // El primer día de la semana, Lunes
        }
    }, setButtonLabel);

    // Revisa el almacenamiento local para el rango seleccionado previamente
    let capturarRango = localStorage.getItem("capturarRango");
    if (capturarRango) {
        $('#btnDatarangeD span').html(capturarRango);
    } else {
        $('#btnDatarangeD span').html('Rango de Fechas');
    }

    $(".cancelaRangeD").on("click", function () {
        localStorage.removeItem("capturarRango");
        localStorage.clear();
        window.location = "ventas-dealers";
        $('#btnDatarangeD span').html('Rango de Fechas'); // Restablece el texto del botón al predeterminado
    });
});





/*=============================================
REVISAR SI EL DEALER YA ESTÁ REGISTRADO
=============================================*/
$("#nuevoNitD").change(function() {

    $(".alert").remove();

    var dealer = $(this).val();
    var proveedor = $("#proveedor").val();

    var datos = new FormData();
    datos.append("dealer", dealer);
    datos.append("proveedor", proveedor);

    $.ajax({
        url: "ajax/dealers.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            if (respuesta) {

                $("#mensajeRespuestaDealers").html('<div class="alert alert-warning">Este dealer ya existe en la base de datos</div>');

                $("#nuevoNitD").val("");

            }

        }

    })
});



    /*=============================================
    ELIMINAR DEALER
    =============================================*/
$(".tablas").on("click", ".btnEliminarDealer", function() {

    var idDealer = $(this).attr("idDealer");

    swal.fire({
        title: '¿Está seguro de borrar el dealer?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar dealer!'
    }).then(function(result) {

        if (result.value) {

            window.location = "index.php?ruta=dealers&idDealer=" + idDealer;

        }

    })

})