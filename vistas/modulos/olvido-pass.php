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
                                <h3 class="mb-3">Olvido Contraseña?</h3> 
                            </div>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Usuario</label>
                                    <input class="form-control" type="text" name="ingUsuario" required placeholder="Usuario">
                                </div>
                                <div class="text-center d-grid mb-3">
                                    <button class="btn btn-success" type="submit">Ingresar</button>
                                </div>
                                <div class="text-center">
                                    <a href="login.php" class="text-muted">Login</a>
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
</body>
</html>
