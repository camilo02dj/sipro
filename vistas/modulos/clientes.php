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
                                <li class="breadcrumb-item active">Clientes</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Administrar Clientes</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="" class="table tablasClientes table-sm table-striped  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Codigo</th>
                                            <th>Nit</th>
                                            <th>Razon Social</th>
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