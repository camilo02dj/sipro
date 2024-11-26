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

                            <button class="btn btn-secondary waves-effect " id="btnDatarangeV">

                                <span>
                                    <i class="fa fa-calendar"> </i> Rango de fecha
                                </span>
                                <i class="fa fa-caret-down"></i>

                            </button>
                            <button class="btn btn-success cancelaFecha">Cancelar Rango</button>
                            <hr>
 
                            <table id="" class="table table-sm table-striped dt-responsive  tablaDetalleVentas">

                            <?php
                            if($_SESSION["perfil"]=="Vip" or $_SESSION["perfil"] =="Administrador"){
                                echo' 
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Centro Operacion</th>
                                    <th>Documento</th>
                                    <th>Cant</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Identificacion</th>
                                   

                                </tr>
                                 </thead>';
                            }else{
                             echo'   <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Centro Operacion</th>
                                    <th>Documento</th>
                                    <th>Producto</th>
                                    <th>Unidades</th>
                                   

                                </tr>
                            </thead>';

                            }
                            ?>
                    
                                <tbody>
                                <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOcultoVentas">
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