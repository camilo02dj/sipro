/*=============================================
    EDITAR DEALER
=============================================*/
$(".tablas").on("click", ".btnEditarDealer", function() {

    var idDealer = $(this).attr("idDealer");

    var datos = new FormData();
    datos.append("idDealer", idDealer);

    $.ajax({

        url: "ajax/dealers.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#editarNombreD").val(respuesta["nombre"]);
            $("#editarNitD").val(respuesta["nit"]);
        }

    });

})

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
    ELIMINAR USUARIO
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