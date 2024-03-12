<?php

if ($_SESSION["perfil"] == "Especial") {

    echo '<script>
  
      window.location = "inicio";
  
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
                                <li class="breadcrumb-item active">Ventas</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Ventas X Proveedor</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="" class="tablasR table-sm table-striped nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Producto</th>
                                            <th>Unidades Vendidas</th>
                                            <th>Acciones</th>
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

