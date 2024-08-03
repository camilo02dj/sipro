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
                                        <th>Departamento</th>
                                        <th>Nit</th>
                                        <th>Dealer (Cliente)</th>
                                        <th>Fecha</th>
                                        <th>Producto</th>
                                        <th>Cant</th>
                                        <th>Neto</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //$item ="item_proveedor";
                                    $proveedor = $_SESSION["usuario"];

                                    if (isset($_GET["fechaInicial"])) {


                                        $fechaInicial = $_GET["fechaInicial"];
                                        $fechaFinal = $_GET["fechaFinal"];
                                    } else {

                                        $fechaInicial = null;
                                        $fechaFinal = null;
                                    }


                                    $ventas = ControladorVentas::ctrMostrarVentasDealers($proveedor, $fechaInicial, $fechaFinal);



                                    foreach ($ventas as $key => $value) {


                                        echo '<tr>

                                                        <td>' . ($key + 1) . '</td>
                                                        <td>' . $value["departamento"] . '</td>
                                                        <td>' . $value["nit"] . '</td>
                                                        <td>' . $value["Dealer"] . '</td>
                                                        <td>' . $value["Fecha"] . '</td>
                                                        <td>' . $value["Producto"] . '</td>
                                                        <td>' . $value["cant"] . '</td>
                                                        <td>' . $value["neto"] . '</td>    
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