<?php

if ($_SESSION["perfil"] != "Administrador") {

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
                                <li class="breadcrumb-item active">Cnetros Operacion</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Administrar Centros Operacion</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="mb-3 btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modalAgregarCentro">Crear Centro Operacion</button>
                            <div class="table-responsive">
                                <table id="" class="table table-sm table-striped tablas nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Codigo</th>
                                            <th>Centro Operacion</th>
                                            <th>Depto</th>
                                            <th>Tipo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $centros = ControladorCentros::ctrMostrarCentros($item, $valor);

                                        foreach ($centros as $key => $value) {

                                            echo ' <tr>
                                            <td>' . ($key + 1) . '</td>
                                            <td>' . $value["codigo"] . '</td>
                                            <td>' . $value["centro_operacion"] . '</td>
                                            <td>' . $value["depto"] . '</td>
                                            <td>' . $value["tipo"] . '</td>
                                            <td>
                                            <div class="btn-group">
                                                
                                                <button class="btn btn-xs btn-success btnEditarCentro" codigoCentro="' . $value["codigo"] . '" data-bs-toggle="modal" data-bs-target="#modalEditarCentro"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-xs btn-danger btnEliminarCentro" codigoCentro="' . $value["codigo"] . '"><i class="fa fa-trash"></i></button>
                        
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
	MODAL REGISTRAR CENTRO OPERACION
	=============================================*/
 -->

<div id="modalAgregarCentro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Datos del Centro Operacion</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body px-4">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-2" class="form-label">Codigo</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="mdi mdi-barcode"></i></div>
                                    <input type="text" class="form-control" name="nuevoCodigo" placeholder="Codigo" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-2" class="form-label">Centro Operacion</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="mdi mdi-bank"></i></div>
                                    <input type="text" class="form-control" name="nuevoCentro" placeholder="Centro Operacion" required>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-4" class="form-label">Depto</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="mdi mdi-map"></i></div>
                                    <input type="text" class="form-control"  laceholder="Depto" name="nuevoDepto" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-5" class="form-label">Tipo</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="fas fa-briefcase"></i></div>
                                    <input type="text" class="form-control" placeholder="Tipo" name="nuevoTipo">
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
           $crearCentro = new ControladorCentros();
           $crearCentro -> ctrCrearCentroOperacion();
            ?>
        </div>
    </div>
</div><!-- /.modal -->

<!-- /*=============================================
	MODAL EDITAR CENTRO OPERACION
	=============================================*/
 -->

 <div id="modalEditarCentro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Datos del Centro Operacion</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body px-4">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-2" class="form-label">Codigo</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="mdi mdi-barcode"></i></div>
                                    <input type="text" id="editarCodigo"  class="form-control"  name="editarCodigo" placeholder="Codigo" readonly>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-2" class="form-label">Centro Operacion</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="mdi mdi-bank"></i></div>
                                    <input type="text" id="editarCentro" class="form-control" name="editarCentro" placeholder="Centro Operacion" required>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-4" class="form-label">Depto</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="mdi mdi-map"></i></div>
                                    <input type="text" id="editarDepto" class="form-control"  laceholder="Depto" name="editarDepto" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-5" class="form-label">Tipo</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="fas fa-briefcase"></i></div>
                                    <input type="text" class="form-control" id="editarTipo" placeholder="Tipo" name="editarTipo">
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
           $editarCentro = new ControladorCentros();
           $editarCentro -> ctrEditarCentroOperacion();
            ?>
        </div>
    </div>
</div><!-- /.modal -->
<?php
$eliminarCentro = new ControladorCentros();
$eliminarCentro->ctrBorrarCentro();
?>