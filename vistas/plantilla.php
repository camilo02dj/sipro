<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <title>Reporte Cartera | SucampoSullanta</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
  <meta content="Coderthemes" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- App favicon -->
  <!-- <link rel="shortcut icon" href="vistas/assets/images/favicon.ico"> -->
  <link rel="icon" type="image/png" href="vistas/assets/images/logo-sucampo.ico">


  <!-- App css -->

  <link href="vistas/assets/css/config/default/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />


  <link href="vistas/assets/css/config/default/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
  <link href="vistas/assets/css/config/default/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

  <!-- third party css -->
  <link href="vistas/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="vistas/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="vistas/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="vistas/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

  <link href="vistas/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

  <!-- Select2-->
  <link href="vistas/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

  <!--  css Daterangepicker -->
  <link href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css" />
  <link href="vistas/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css"/>

  <!-- third party css end -->

  <!-- icons -->
  <link href="vistas/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

  <link href="vistas/assets/css/config/default/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

  <!-- Css Custom -->
  <link href="vistas/assets/css/custom.css" rel="stylesheet" type="text/css" />

</head>

<!-- body start -->

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

  <?php

  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

    echo '<div id="wrapper">';

    /*=============================================
    CABEZOTE
    =============================================*/

    include "modulos/cabezote.php";

    /*=============================================
    MENU
    =============================================*/

    include "modulos/menu.php";

    /*=============================================
    CONTENIDO
    =============================================*/

    if (isset($_GET["ruta"])) {

      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "cambiar-pass"||
        $_GET["ruta"] == "ventas"||
        $_GET["ruta"] == "salir"
      ) {

        include "modulos/" . $_GET["ruta"] . ".php";
      } else {

        include "modulos/404.php";
      }
    } else {

      include "modulos/inicio.php";
    }

    /*=============================================
    FOOTER
    =============================================*/

    include "modulos/footer.php";

    echo '</div>';
  } else {

    include "modulos/login.php";
  }

  ?>



  <!-- Vendor js -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
  <script src="vistas/assets/js/vendor.min.js"></script>

  <!-- Plugins js -->
  <!-- <script src="vistas/assets/libs/morris.js06/morris.min.js"></script> -->
  <script src="vistas/assets/libs/raphael/raphael.min.js"></script>

  <!-- Dashboard init-->
  <!-- <script src="vistas/assets/js/pages/dashboard-4.init.js"></script> -->

  <!-- <script src="vistas/assets/js/pages/datatables.init.js"></script> -->

  <!-- App js -->
  <script src="vistas/assets/js/app.min.js"></script>

  <!-- third party js -->
  <script src="vistas/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="vistas/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vistas/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
  <script src="vistas/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="vistas/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="vistas/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="vistas/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="vistas/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="vistas/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="vistas/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
  <script src="vistas/assets/libs/pdfmake/build/pdfmake.min.js"></script>
  <script src="vistas/assets/libs/pdfmake/build/vfs_fonts.js"></script>
  <script src="vistas/bower_components/jqueryNumber/jquerynumber.min.js"></script>
  <!--<script src="https://coderthemes.com/ubold/layouts/assets/libs/bootstrap-table/bootstrap-table.min.js"></script>-->
 <!-- <script src="https://coderthemes.com/ubold/layouts/assets/js/pages/bootstrap-tables.init.js"></script>-->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  

  <!-- Sweet Alerts js -->
  <script src="vistas/assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

  <!-- Select2 js -->
  <script src="vistas/assets/libs/select2/js/select2.full.min.js"></script>
  <script src="vistas/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>


 <!--rangedatepicker -->
  <script type="text/javascript" src="vistas/bower_components/daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="vistas/bower_components/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="vistas/bower_components/daterangepicker/daterangepicker.css" />

  <!-- third party js ends -->
  <!-- Script Propios -->
  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/reportes.js"></script>
  <script src="vistas/js/usuarios.js"></script>
  

</body>

</html>