<?php
$consulta = ControladorUsuarios::ctrMostrarUsuarios("id", $_SESSION["id"]);
$primera_vez = $consulta["primera_vez"];
if ($primera_vez != 1) {

    echo '<script>

    window.location = "cambiar-pass";

  </script>';

    return;
}

?>
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div class="page-title-left">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="inicio">Dashboard</a></li>
                                <li class="breadcrumb-item active">Informes</li>
                            </ol>
                        </div>
                        <?php
                        $fechas = ControladorVentas::ctrFechaMaxima();
                        ?>
                        <small class="text-muted page-title">Datos desde:
                            <?= $fechas["fechaMinima"] ?> hasta:
                            <?= $fechas["fechaMaxima"] ?>
                        </small>
                    </div>
                </div>
            </div>

            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <button class="btn btn-secondary waves-effect " id="btnDatarange">

                                <span>
                                    <i class="fa fa-calendar"> </i> Rango de fecha
                                </span>
                                <i class="fa fa-caret-down"></i>

                            </button>
                            <button class="btn btn-success cancelaRange">Cancelar Rango</button>
                            <hr>

                            <table id="" class="table table-sm table-striped dt-responsive tablas tablasDetallePro">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Unidades</th>
                                        <th>Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$item ="item_proveedor";
                                    $nit = $_SESSION["usuario"];

                                    if (isset($_GET["fechaInicial"])) {


                                        $fechaInicial = $_GET["fechaInicial"];
                                        $fechaFinal = $_GET["fechaFinal"];
                                    } else {

                                        $fechaInicial = null;
                                        $fechaFinal = null;
                                    }


                                    $ventas = ControladorVentas::ctrMostrarVentas($nit, $fechaInicial, $fechaFinal);



                                    foreach ($ventas as $key => $value) {


                                        echo '<tr>

                                                        <td>' . ($key + 1) . '</td>
                                                     
                                                        <td>' . $value["desc_item"] . '</td>

                                                        <td>' . number_format($value["totalVendido"], 0) . '</td>
                                                        <td>  
                                                        <div class="btn-group">
                                              
                                                        <button class="btn btn-xs btn-success btnVerDetalle" data-bs-toggle="modal" data-bs-target="#modalVerVentas" fechaInicial="' . $fechaInicial . '" fechaFinal="' . $fechaFinal . '"  item="' . $value["item"] . '" proveedor="' . $value["item_proveedor"] . '" producto = "' . $value["desc_item"] . '">
            
                                                          <i class=" fas fa-search-plus"></i>
                                  
                                                        </button></td>

                                                </tr>';
                                    }

                                    ?>
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div> <!-- container -->

    </div> <!-- content -->
</div>
<!--MODAL MOSTRAR PROYECTOS ASOCIADOS -->

<div id="modalVerVentas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalle del Producto: <span id="nombreProducto"></span></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body px-12">
                    <table id="" class="table tableSubQuery">
                        <thead>
                            <tr>
                                <th>Centro O.</th>
                                <th>Unidades</th>


                            </tr>
                        </thead>
                        <tbody id="detalleProducto"> 
                        </tbody>
                    </table>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>

                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->