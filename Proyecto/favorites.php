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

	<body class="">
		<div class="wrapper ">
			<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets.1.1.2/img/sidebar.jpg">
				<div class="logo">
					<a href="" class="simple-text logo-mini">
						<img src="https://image.flaticon.com/icons/png/512/633/633600.png" alt="logo" width="30px">
					</a>
					<a href="" class="simple-text logo-normal">Movie Center</a>
				</div>
				<div class="sidebar-wrapper">
					<?php echo menu_user('', false); ?>
					<ul class="nav">
						<li class="nav-item">
							<a class="nav-link" href="menu.php">
								<i class="fas fa-home"></i>
								<p> Inicio </p>
							</a>
						</li>
						<?php echo menu_administracion(''); ?>
						<?php echo menu_gestion_tecnica(''); ?>
						<hr>
						<li class="nav-item">
							<a class="nav-link" href="../logout.php">
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
							<a class="navbar-brand" href=""><?php echo $cliente_nombre; ?></a>
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
					<div class="content">
						<div class="container-fluid">
							<div class="card">
								<div class="card-header card-header-primary card-header-icon">
									<div class="card-icon">
										<i class="fa fa-star"></i>
									</div>
									<h4 class="card-title">Mis Peliculas Favoritas</h4>
								</div>
								<div class="card-body">
									<br><br>
									<div id="result">
									</div>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- JSs -->
		<?php echo scripts_JS(''); ?>
		<script type="text/javascript" src="assets/js/modules/movies/favorites.js"></script>
		<script type="text/javascript" src="assets/js/modules/movies/search.js"></script>
		<script>
			Favorites();
		</script>
	</body>

	</html>
<?php
} else {
	echo "<form id='f1' name='f1' action='../logout.php' target='_parent' method='post'>";
	echo "<script>document.f1.submit();</script>";
	echo "</form>";
}
?>