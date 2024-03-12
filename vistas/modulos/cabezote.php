            <!-- Topbar Start -->
	<div class="navbar-custom" style="background-image: linear-gradient(to right, #3bcb8a, #2fac73, #228e5c, #167147, #095533);">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

       
            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"  style="color:white;"></i>
                </a>
            </li>
    
            <li class="dropdown notification-list topbar-dropdown " >
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <?php

					// if($_SESSION["foto"] != ""){

					// 	echo '<img src="'.$_SESSION["foto"].'" alt="user-image" class="rounded-circle">';

					// }else{


					// 	echo '<img src="vistas/img/usuarios/default/anonymous.png" alt="user-image" class="rounded-circle">';

					// }

					?>    
                
                    <span class="pro-user-name ms-1" style="color:white;">
                    <?php  echo $_SESSION["nombre"]; ?></span> <i class="mdi mdi-chevron-down"></i> 
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Hola !</h6>
                    </div>
    
                    <!-- item-->
                   <!--  <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Account</span>
                    </a> -->
    
                    <!-- item-->
                    <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a>
     -->
                    <!-- item-->
                    <!-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock"></i>
                        <span>Lock Screen</span>
                    </a> -->
    
                    <div class="dropdown-divider"></div>
    
                    <!-- item-->
                    <a href="cambiar-pass" class="dropdown-item notify-item">
                        <i class="fas fa-key"></i>
                        <span>Cambiar Contraseña</span>
                    </a>
                    <a href="salir" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Salir</span>
                    </a>
    
                </div>
            </li>
    
            <!-- <li class="dropdown notification-list">
                <a href="salir" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li> -->
    
        </ul>
    
        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="vistas/assets/images/logo sucampo.png" alt="" height="22">
                    <!-- <span class="logo-lg-text-light">UBold</span> -->
                </span>
                <span class="logo-lg">
                    <img src="vistas/assets/images/logo sucampo.png" alt="" height="20">
                    <!-- <span class="logo-lg-text-light">U</span> -->
                </span>
            </a>
    
            <a href="inicio" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="vistas/assets/images/logo-sucampo.ico" alt="" height="">
                </span>
                <span class="logo-lg">
                <img src="vistas/img/logo_sucampo.webp" alt="" height="">
                </span>
            </a>
        </div>
    
        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-sanidad-vegetal">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
            <!-- <li><a class="titleCo2cero text-white nav-link dropdown-toggle arrow-none waves-effect waves-light">Sucampo Sullanta SAS</a style="font-size: 20px;"></li> -->
            
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->