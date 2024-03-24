$(function() { // Asegúrate de que el DOM esté completamente cargado
    function setButtonLabel(start, end) {
        // Formatea las fechas y actualiza el texto del botón utilizando el formato español
        let label = start.format('D [de] MMMM [de] YYYY') + ' - ' + end.format('D [de] MMMM [de] YYYY');
        $('#btnDatarange span').html(label);

        // Guarda el rango seleccionado en el almacenamiento local
        localStorage.setItem("capturarRango", label);

        // Opcionalmente, actualiza la URL o haz una petición AJAX aquí si no deseas redirigir
        window.location = "index.php?ruta=ventas&fechaInicial=" + start.format('YYYY-MM-DD') + "&fechaFinal=" + end.format('YYYY-MM-DD');
    }

    // Configura el daterangepicker con las opciones de localización en español
    $('#btnDatarange').daterangepicker({
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
        $('#btnDatarange span').html(capturarRango);
    } else {
        $('#btnDatarange span').html('Rango de Fechas');
    }

    $(".cancelaRange").on("click", function() {
        localStorage.removeItem("capturarRango");
        localStorage.clear();
        window.location = "ventas";
        $('#btnDatarange span').html('Rango de Fechas'); // Restablece el texto del botón al predeterminado
    });
});

//Mostrar Detalle Productos
$(".tablasDetallePro").on("click", ".btnVerDetalle", function() {
    var item = $(this).attr("item");
    var proveedor = $(this).attr("proveedor");
    var fechaInicial = $(this).attr("fechaInicial");
    var fechaFinal = $(this).attr("fechaFinal");
    var datos = new FormData();
    datos.append("item", item);
    datos.append("proveedor", proveedor);
    datos.append("fechaInicial", fechaInicial);
    datos.append("fechaFinal", fechaFinal);

    $.ajax({
        url: "ajax/ventas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            var table = $(".tableSubQuery").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        title: function() {
                            return 'Detalle del Producto: ' + $("#nombreProducto").text();
                        }
                    },
                    {
                        extend: 'pdf',
                        title: function() {
                            return 'Detalle del Producto: ' + $("#nombreProducto").text();
                        }
                    }
                ]
            });
            
            table.clear(); // Limpia los datos existentes antes de añadir los nuevos
    
            // Asumiendo que la respuesta es un objeto que incluye el nombre del producto bajo la clave 'nombreProducto'
            // Si la respuesta es un arreglo, asegúrate de acceder al nombre del producto correctamente
            $("#nombreProducto").text(respuesta[0]["desc_item"]); // Actualiza el título del modal con el nombre del producto
    
            respuesta.forEach(function(item) {
                table.row.add([
                    item["centro_operacion"],
                    number_format(item["totalVendido"],0)
                ]);
            });
    
            table.draw(); // Redibuja la tabla con los nuevos datos
        }
    });
    
});
