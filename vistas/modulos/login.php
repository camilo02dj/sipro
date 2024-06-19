<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>SIPRO | Sucampo-Sullanta SAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
</head>

<body style="background-image:url(vistas/img/fondo.jpg); width:100%; height:100%; background-position: center; background-size: cover;">
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-6">
                    <div class="card bg-pattern">
                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <img src="vistas/img/logo_sucampo1.webp" alt="" class="img-fluid mb-2">
                                <h3 class="mb-3">Bienvenido a SIPRO</h3> <!-- Mensaje de bienvenida añadido aquí -->
                            </div>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Usuario</label>
                                    <input class="form-control" type="text" name="ingUsuario" required placeholder="Usuario">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" name="ingPassword" class="form-control" placeholder="Password" required>
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center d-grid mb-3">
                                    <button class="btn btn-success" type="submit">Ingresar</button>
                                </div>
                                <div class="text-center">
                                <a href="" class="text-muted" data-bs-toggle="modal" data-bs-target="#modalOlvidoContraseña">¿Olvidó su contraseña?</a>
                              

                                </div>
                                <?php
                                $login = new ControladorUsuarios();
                                $login->ctrIngresoUsuario();
                                ?>
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </div> <!-- end page -->

<!-- Modal contraseña -->

    <div id="modalOlvidoContraseña" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Olvidó su contraseña?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body px-4">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="field-2" class="form-label">Usuario</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-text"><i class="fe-user"></i></div>
                                        <input type="text" class="form-control" name="nuevoOlvido" placeholder="Usuario" required>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success waves-effect waves-light">Enviar</button>
                    </div>
                </form>
                <?php
                $olvidoP = new ControladorUsuarios();
                $olvidoP->ctrOlvidoP();
                ?>
            </div>
        </div>
    </div><!-- /.modal -->


</body>

</html>