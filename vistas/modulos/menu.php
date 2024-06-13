<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

	<div class="h-100" data-simplebar>
		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<ul id="side-menu">
				<li class="menu-title mt-2">Menú</li>

				<li>
					<a href="ventas" class="menu-item">
					<i class="fas fa-shopping-basket"></i>

						<span>Ventas</span>
					</a>
				</li>
				<li>
					<a href="inventarios" class="menu-item">
					<i class="fas fa-warehouse"></i>

						<span>Inventarios</span>
					</a>
				</li>

				<?php
				if ($_SESSION["perfil"] == "Administrador") {
					echo '
                    <li>
                        <a href="#sidebarDashboards" data-bs-toggle="collapse" class="menu-item">
                            <i class="fe-settings"></i>
                            <span>Configuracion</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarDashboards">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="usuarios" class="sub-menu-item">
                                        <i class="fas fa-user"></i> Usuarios
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>';
				}
				?>
			</ul>
		</div>
		<!-- End Sidebar -->
		<div class="clearfix"></div>
	</div>
	<!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->

<style>
	.menu-item {
		font-size: 18px;
	}

	.menu-item:hover,
	.menu-item:focus {
		background-color: #f5f5f5;
	}

	.sub-menu-item {
		font-size: 16px;
	}
</style>