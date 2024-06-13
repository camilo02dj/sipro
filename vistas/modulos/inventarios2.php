<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="inicio">Dashboard</a></li>
                                <li class="breadcrumb-item active">Inventarios</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Inventarios - SucampoSullanta</h4>                       
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="" class=" tablas table-sm table-striped nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Producto</th>
                                            <th>Cant Disponible</th>
                                            <th>Vencimiento</th>
                                            <th>Centro Operacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php
                                   $item = null;
                                   $valor = null;
                                   $inventarios = ControladorInventarios::ctrMostrarInventarios($item, $valor);
                                 
                                   foreach ($inventarios as $key => $inventario){
                                    $centro = ControladorCentros::ctrMostrarCentros("id", $inventario["co_bodega"]);
                                    echo '<tr>
                                    <td>' . ($key + 1) . '</td>
                                    <td>' . $inventario["desc_item"] . '</td>
                                    <td>' . $inventario["cant_disponible"] . '</td>
                                    <td>' . $inventario["fecha_vcto_lote"] . '</td>
                                    <td>' . $centro["centro_operacion"] . '</td>

                                   

                            </tr>';
                }
                                   ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div> <!-- container -->

    </div> <!-- content -->
</div>
