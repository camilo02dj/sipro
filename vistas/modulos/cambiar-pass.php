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
                                <li class="breadcrumb-item active">Cambio Password</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Como es la primera vez que ingresas al sistema debes cambiar tu password!</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST">
                                    <div class="row">
                                        <div class="col-12 col-md-4 pb-2 pb-lg-0 mt-lg-2">
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="passwordAnterior" placeholder="Password Anterior" required>
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4 pb-2 pb-lg-0 mt-lg-2">
                                            <div class="input-group">

                                                <input type="password" class="form-control" id="password" name="nuevoPassword" placeholder="Nuevo Password" required>
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4 pb-2 pb-lg-0 mt-lg-2">
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="confirmarPass" placeholder="Confirmar Nuevo Password" required>
                                                <div class="input-group-text" data-password="false">
                                                    <span class="password-eye"></span>

                                                </div>
                                            </div>
                                            <input type="hidden" name="nuevoUsuario" value="<?php echo $_SESSION["usuario"] ?>">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-0">
                                                <div id="mensajePassword"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-success waves-effect waves-light">Guardar</button>
                                        </div>
                                    </div>
                                    <?php
                                    $pass = new ControladorUsuarios();
                                    $pass->ctrActualizarPass();
                                    ?>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>