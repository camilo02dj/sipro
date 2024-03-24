<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Estandar") {

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
                                <li class="breadcrumb-item active">Usuarios</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Administrar Usuarios</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="mb-3 btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">Crear Usuario</button>
                            <div class="table-responsive">
                                <table id="" class="table table-sm table-striped tablas nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Nombre</th>
                                            <th>Usuario</th>
                                            <th>Cargo</th>
                                            <th>Perfil</th>
                                            <th>Estado</th>
                                            <th>Último login</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                                        foreach ($usuarios as $key => $value) {
                                           
                                            echo ' <tr>
                                            <td>' . ($key + 1) . '</td>
                                            <td>' . $value["nombre"] . '</td>
                                            <td>' . $value["usuario"] . '</td>
                                            <td>' . $value["cargo"] . '</td>';

                                            echo '<td>' . $value["perfil"] . '</td>';

                                            if ($value["estado"] != 0) {

                                                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["id"] . '" estadoUsuario="0">Activado</button></td>';
                                            } else {

                                                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["id"] . '" estadoUsuario="1">Desactivado</button></td>';
                                            }

                                            echo '<td>' . $value["ultimo_login"] . '</td>
                                            <td>
                        
                                            <div class="btn-group">
                                                
                                                <button class="btn btn-xs btn-success btnEditarUsuario" idUsuario="' . $value["id"] . '" data-bs-toggle="modal" data-bs-target="#modalEditarUsuario"><i class="fa fa-edit"></i></button>
                        
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
	MODAL REGISTRAR USUARIO
	=============================================*/
 -->

<div id="modalAgregarUsuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Datos del Usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body px-4">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-2" class="form-label">Nombres Completos</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="fe-user"></i></div>
                                    <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingrese Nombres Completos" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-2" class="form-label">Responsable</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="ti-id-badge"></i></div>
                                    <input type="text" class="form-control" name="nuevoCargo" placeholder="Cargo" required>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-4" class="form-label">Usuario</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="fe-user"></i></div>
                                    <input type="text" class="form-control" id="nuevoUsuario" placeholder="Ingrese Usuario" name="nuevoUsuario" required>
                                    <div id="mensajeRespuestaUsuarios"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-5" class="form-label">Correo</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="ti-email"></i></div>
                                    <input type="email" class="form-control" placeholder="Ingrese Correo" name="nuevoEmail">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-5" class="form-label">Password</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="ti-key"></i></div>
                                    <input type="password" id="pass" class="form-control" placeholder="Ingrese Password" name="nuevoPassword">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>

                                </div>
                            </div>
                            <input type="hidden" name="password" id="password">
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-3" class="form-label">Perfil</label>
                                <select class="form-control" name="nuevoPerfil">
                                    <option>Seleccione Perfil</option>
                                    <option value="Estandar">Estandar</option>
                                    <option value="Especial">Especial</option>
                                    <option value="Administrador">Administrador</option>
                                    

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-0">
                                <div id="mensajeRespuestaUsuarios"></div>
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
            $crearUsuario = new ControladorUsuarios();
            $crearUsuario->ctrCrearUsuario();
            ?>
        </div>
    </div>
</div><!-- /.modal -->

<!-- /*=============================================
	MODAL EDITAR USUARIO
	=============================================*/
 -->

<div id="modalEditarUsuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Datos del Usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body px-4">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-2">
                                <label for="field-2" class="form-label">Nombres Completos</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="fe-user"></i></div>
                                    <input type="text" class="form-control" id="editarNombre" name="editarNombre" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-2" class="form-label">Cargo</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="ti-id-badge"></i></div>
                                    <input type="text" class="form-control" id="editarCargo" name="editarCargo" placeholder="" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-4" class="form-label">Usuario</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="fe-user"></i></div>
                                    <input type="text" class="form-control" id="editarUsuario" name="editarUsuario" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-5" class="form-label">Correo</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="ti-email"></i></div>
                                    <input type="text" class="form-control" id="editarEmail" placeholder="Ingrese Correo" name="editarEmail">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-5" class="form-label">Password</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-text"><i class="ti-key"></i></div>
                                    <input type="password" class="form-control" name="editarPassword" placeholder="Escriba la nueva contraseña">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="field-3" class="form-label">Perfil</label>
                                <select class="form-control" name="editarPerfil">
                                    <option id="editarPerfil"> Seleccione Perfil</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Estandar">Estandar</option>

                                </select>
                                <input type="hidden" id="passwordActual" name="passwordActual">
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
            $editarUsuario = new ControladorUsuarios();
            $editarUsuario->ctrEditarUsuario();
            ?>


        </div>
    </div>
</div><!-- /.modal -->
<?php
$eliminarUsuario = new ControladorUsuarios();
$eliminarUsuario->ctrBorrarUsuario();
?>