<?php

if ($_SESSION["perfil"] == "Estandar") {

    echo '<script>
  
      window.location = "ventas";
  
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
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="inicio">Dashboard</a></li>
                                <li class="breadcrumb-item active">Dealers</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Administrar Dealers</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="mb-3 btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modalAgregarDealer">Crear Dealer</button>
                            <div class="table-responsive">
                                <table id="" class="table table-sm table-striped tablas nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Nit</th>
                                            <th>Nombre</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        if ($_SESSION["perfil"] == "Administrador") {

                                            $item = null;
                                            $valor = null;
                                        } else {
                                            $item = "proveedor";
                                            $valor = $_SESSION["usuario"];
                                        }

                                        $dealers = ControladorDealers::ctrMostrarDealers($item, $valor);

                                        foreach ($dealers as $key => $value) {

                                            echo ' <tr>
                                            <td>' . ($key + 1) . '</td>
                                            <td>' . $value["nit"] . '</td>
                                            <td>' . $value["nombre"] . '</td>
                                            <td>
                                            <div class="btn-group">
                                                
                                                <button class="btn btn-xs btn-danger btnEliminarDealer" idDealer="' . $value["id"] . '"><i class="fa fa-trash"></i></button>
                        
                                            </div>  
                        
                                            </td>
                        
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
<!-- /*=============================================
	MODAL REGISTRAR DEALER
	=============================================*/
 -->

 <div id="modalAgregarDealer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Datos del Dealer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body px-4">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label for="field-2" class="form-label">Nit</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="fe-user"></i></div>
                                    <input type="number" class="form-control" id="nuevoNitD" name="nuevoNitD" placeholder="Ingrese Nit" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label for="field-2" class="form-label">Nombre</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="ti-id-badge"></i></div>
                                    <input type="text" class="form-control" name="nuevoDealer" placeholder="Nombre o Razón Social" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($_SESSION["perfil"] == "Administrador") {
                        echo '<div class="row">
                        <div class="col-md-12">
                            <div class="mb-2">
                                <label for="field-2" class="form-label">Nit Proveedor</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="ti-id-badge"></i></div>
                                    <input type="text" class="form-control" id="proveedor" name="proveedor" placeholder="Nit Proveedor" required>
                                </div>
                            </div>
                        </div>
                    </div>';
                    } else {
                        echo '<input type="hidden" id="proveedor" name="proveedor" value="' . $_SESSION["usuario"] . '">';
                    }
                    ?>

                    <div class="row">
                        <div class="col">
                            <div class="mb-0">
                                <div id="mensajeRespuestaDealers"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Guardar</button>
                </div>
            </form>
            <?php
            $crearDealer = new ControladorDealers();
            $crearDealer->ctrCrearDelears();
            ?>
        </div>
    </div>
</div><!-- /.modal -->




<!-- /*=============================================
	MODAL EDITAR DEALER
	=============================================*/
 -->

<div id="modalEditarDealer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Datos del Dealer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body px-4">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-2">
                                <label for="field-2" class="form-label">Nit</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="fe-user"></i></div>
                                    <input type="text" class="form-control" id="editarNombre" name="editarNitD" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-2" class="form-label">Nombre</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="ti-id-badge"></i></div>
                                    <input type="text" class="form-control" id="editarCargo" name="editarNombreD" placeholder="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Guardar</button>
                </div>
            </form>
            <?php
            $editarDealer = new ControladorDealers();
            $editarDealer->ctrEditarDealer();
            ?>


        </div>
    </div>
</div><!-- /.modal -->
<?php
$eliminarDealer = new ControladorDealers();
$eliminarDealer->ctrBorrarDealer();
?>