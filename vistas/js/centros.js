/*=============================================
    EDITAR CENTRO
=============================================*/
$(".tablas").on("click", ".btnEditarCentro", function() {

    var codigoCentro = $(this).attr("codigoCentro");

    var datos = new FormData();
    datos.append("codigoCentro", codigoCentro);

    $.ajax({

        url: "ajax/centros.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#editarCodigo").val(respuesta["codigo"]);
            $("#editarCentro").val(respuesta["centro_operacion"]);
            $("#editarDepto").val(respuesta["depto"]);
            $("#editarTipo").val(respuesta["tipo"]);

        }

    });

})


//ELIMINAR CENTRO

$(".tablas").on("click", ".btnEliminarCentro", function() {

    var codigoCentro = $(this).attr("codigoCentro");
    swal.fire({
        title: '¿Está seguro de borrar el Centro de Operacion?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Centro Operacion!'
    }).then(function(result) {

        if (result.value) {

            window.location = "index.php?ruta=centros-operacion&codigoCentro=" + codigoCentro;

        }

    })

})