$('#btnDatarange').daterangepicker({
    ranges: {
        //'Hoy': [moment(), moment()],
        //'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
        'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
        'Este mes': [moment().startOf('month'), moment().endOf('month')],
        'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],

    },
    startDate: moment(),
    endDate: moment()
},
function(start, end) {
    $('#btnDatarange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#btnDatarange span").html();

    localStorage.setItem("capturarRango", capturarRango);

    window.location = "index.php?ruta=ventas&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;

}

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".cancelaRange").on("click", function() {

localStorage.removeItem("capturarRango");
localStorage.clear();
window.location = "ventas";
})


//Mostrar Detalle Productos
$(".tablasDetallePro").on("click", ".btnVerDetalle", function() {
    var item = $(this).attr("item");
    var fechaInicial = $(this).attr("fechaInicial");
    var fechaFinal = $(this).attr("fechaFinal");
    var datos = new FormData();
    datos.append("item", item);
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
            var table = $(".tableSubQuery").DataTable();
            table.clear(); // Limpia los datos existentes antes de añadir los nuevos

            respuesta.forEach(function(item) {
                table.row.add([
                    item["fecha"],
                    item["centro_operacion"],
                    item["totalVendido"]
                ]);
            });

            table.draw(); // Redibuja la tabla con los nuevos datos
        }
    });
});
