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
                        <?php
                        $fechaMax=ModeloInventario::mdlFechaInventario("inventario");
                        echo'<h4 class="page-title">Inventarios actualizado al : '.$fechaMax["fecha"].' </h4> '  ?>                    
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="" class="table tablasInventarios table-sm table-striped nowrap w-100">
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
                                    <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
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
