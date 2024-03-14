<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title> SIPRO | SucampoSullanta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/logo-sucampo.ico">

    <!-- App css -->
    <link href="../assets/css/config/default/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="../assets/css/config/default/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="../assets/css/config/default/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="../assets/css/config/default/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body style="background-image:url(vistas/img/fondo.jpg); width:100%; height:100%; background-position: center; background-size: cover;">
    <div class="container"> <!-- pt-5 se le quito el top-->
        <div class="row justify-content-center ">
            <div class="carta col-xl-10 col-lg-12 col-md-9 "> <!-- pt-5 se le quito el top , se modifico el col-xl-7-->
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- parte izquierda del login donde va la imagen -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="vistas/img/logo-login.jpeg" style="width:100%; height:100%;">
                            </div>
                            <!-- final de la parte izquierda del login donde va la imagen -->
                            <!-- parte derecha del login donde va el formulario -->
                            <div class="col-lg-6 p-5" style="height:auto; display:flex; justify-content:center; align-items:center;">
                                <div class="text-center">
                                    <h1 id="titulo" class="h2 text-gray-900 mb-3">Bienvenido</h1>
                                    <form method="post" class="user">
                                        <div class="mb-3">
                                            <input type="text" name="ingUsuario" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ingrese usuario" style="font-size:20px; border:darkgray 1px solid; color:black; ">
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group input-group-merge">
                                                <input type="password" name="ingPassword" class="form-control" placeholder="Contraseña" required style="font-size:20px; border:darkgray 1px solid; color:black;">
                                                <div class="input-group-text" data-password="false" style="font-size:20px; border:darkgray 1px solid; color:black;">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <button class="btn  btn-user btn-block" style="font-size: 20px; width:100%; background-color:green; color:white; font-weight:bold;" type="submit"> Ingresar</button>
                                        </div>
                                        <?php

                                        $login = new ControladorUsuarios();
                                        $login->ctrIngresoUsuario();

                                        ?>
                                    </form>
                                </div>
                            </div>
                            <!-- final de la parte derecha del login donde va el formulario -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>
      <!-- Sweet Alerts js -->
  <script src="vistas/assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

</body>
<style>




/* Media query para pantallas grandes */
@media screen and (max-width: 1200px) {
    .carta {
      
      width:58.33333333%;
  }
  input[type="text"]{
    font-size: 15px !important;
    
  }
    input[type="password"]{
        font-size: 15px !important;
    }
.input-group-text{
    font-size: 15px !important;
}
}

</style>
</html>