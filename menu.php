<?php
include_once('html_fns.php');
$id = $_SESSION["id"];
$name = utf8_decode($_SESSION["name"]);
$nick = utf8_decode($_SESSION["nick"]);

if ($name != "") {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head> <?php echo scripts_CSS('', 'Movie Center'); ?> </head>

	<body class="sidebar-mini">
		<div class="wrapper ">
			<div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar.jpg">
				<div class="logo">
					<a href="./" class="simple-text logo-mini">
						<img src="https://image.flaticon.com/icons/png/512/633/633600.png" alt="logo" width="30px">
					</a>
					<a href="./" class="simple-text logo-normal">Movie Center</a>
				</div>
				<div class="sidebar-wrapper">
					<?php echo menu_user(''); ?>
					<ul class="nav">
						<li class="nav-item active">
							<a class="nav-link" href="./">
								<i class="fas fa-home"></i>
								<p> Inicio </p>
							</a>
						</li>
						<?php echo menu_administracion(''); ?>
						<?php echo menu_gestion_tecnica(''); ?>
						<hr>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">
								<i class="fas fa-power-off"></i>
								<p>Salir</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="main-panel">
				<!-- Navbar -->
				<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
					<div class="container-fluid">
						<div class="navbar-wrapper">
							<div class="navbar-minimize">
								<button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
									<i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
									<i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
								</button>
							</div>
							<a class="navbar-brand" href="./">Movie Center</a>
						</div>
						<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
							<span class="sr-only">...</span>
							<span class="navbar-toggler-icon icon-bar"></span>
							<span class="navbar-toggler-icon icon-bar"></span>
							<span class="navbar-toggler-icon icon-bar"></span>
						</button>
						<div class="collapse navbar-collapse justify-content-end">
							<ul class="navbar-nav">
								<?php echo menu_navigation_top(''); ?>
							</ul>
						</div>
					</div>
				</nav>
				<!-- End Navbar -->
				<div class="content">
					<div class="container-fluid">
						<div class="card">
							<div class="card-header card-header-primary card-header-icon">
								<div class="card-icon">
									<i class="material-icons">dashboard</i>
								</div>
								<h4 class="card-title"> Panel Central</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<a href="search.php" class="card border-bottom-primary shadow h-100 py-2">
											<div class="card-body">
												<div class="row no-gutters align-items-center">
													<div class="col mr-2">
														<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Buscar y Agregar Pel&iacute;culas</div>
														<small class="mb-0 font-weight-bold text-primary">ir al m&oacute;dulo <i class="fas fa-caret-right"></i></small>
													</div>
													<div class="col-auto">
														<i class="fas fa-search fa-2x text-primary"></i>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="col-md-6">
										<a href="favorites.php" class="card border-bottom-primary shadow h-100 py-2">
											<div class="card-body">
												<div class="row no-gutters align-items-center">
													<div class="col mr-2">
														<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mis Pel&iacute;culas</div>
														<small class="mb-0 font-weight-bold text-primary">ir al m&oacute;dulo <i class="fas fa-caret-right"></i></small>
													</div>
													<div class="col-auto">
														<i class="fas fa-star fa-2x text-primary"></i>
													</div>
												</div>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- JSs -->
		<?php echo scripts_JS(''); ?>
	</body>

	</html>
<?php
} else {
	echo "<form id='f1' name='f1' action='logout.php' method='post'>";
	echo "<script>document.f1.submit();</script>";
	echo "</form>";
}
?>