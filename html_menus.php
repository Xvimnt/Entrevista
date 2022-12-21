<?php
//-- SISTEMA --
include_once('user_auth_fns.php');
//////////////////////////////////////////////////// //////////////// ////////////////////////////////////////////////////
//////////////////////////////////////////////////// SECCION DE MENU /////////////////////////////////////////////////////
//////////////////////////////////////////////////// //////////////// ////////////////////////////////////////////////////

//////////////////////////////////// PERFIL ////////////////////////////////////
function menu_user($nivel = '',$collapse = true) {
	$nombre = utf8_decode($_SESSION["name"]);
	$foto = "https://image.flaticon.com/icons/png/512/747/747376.png";
	$collapse = ($collapse == true)?"collapse":"";
	// Obtiene al pagina actual
	$pagina = current_page();
	////----
	$salida = '';
	$salida.='<div class="user">';
		// foto
		$salida.='<div class="photo">';
		$salida.='<img src="'.$foto.'" />';
		$salida.='</div>';
		//--
		$salida.='<div class="user-info">';
			$salida.='<a data-toggle="collapse" href="#collapseExample" class="username">';
				$salida.='<span>'.$nombre.' <b class="caret"></b></span>';
			$salida.='</a>';
			$salida.='<div class="clearfix"></div>';
			$salida.='<div class="'.$collapse.'" id="collapseExample">';
				$salida.='<ul class="nav">';
					//--
					$activeitem = ($pagina == "FRMperfil.php")?"active":"";
					$salida.='<li class="nav-item '.$activeitem.'">';
					$salida.='<a class="nav-link" href="'.$nivel.'CPPERFIL/FRMperfil.php">';
					$salida.='<span class="sidebar-mini"><i class="fas fa-user"></i></span>';
					$salida.='<span class="sidebar-normal"> Perfil </span>';
					$salida.='</a>';
					$salida.='</li>';
					//--
					$activeitem = ($pagina == "FRMpassword.php")?"active":"";
					$salida.='<li class="nav-item '.$activeitem.'">';
					$salida.='<a class="nav-link" href="'.$nivel.'CPPERFIL/FRMpassword.php">';
					$salida.='<span class="sidebar-mini"><i class="fas fa-unlock-alt"></i></span>';
					$salida.='<span class="sidebar-normal"> Contrase&ntilde;a </span>';
					$salida.='</a>';
					$salida.='</li>';
					//--
					$activeitem = ($pagina == "FRMajustes.php")?"active":"";
					$salida.='<li class="nav-item '.$activeitem.'">';
					$salida.='<a class="nav-link" href="'.$nivel.'CPPERFIL/FRMajustes.php">';
					$salida.='<span class="sidebar-mini"><i class="fas fa-cog"></i></span>';
					$salida.='<span class="sidebar-normal"> Ajustes </span>';
					$salida.='</a>';
					$salida.='</li>';
				$salida.='</ul>';
			$salida.='</div>';
		$salida.='</div>';
	$salida.='</div>';

	return $salida;
}

function menu_navigation_top($nivel = '') {
	////----
	$salida = '';
	$salida.='<li class="nav-item dropdown">';
		$salida.='<a class="nav-link" href="javascript:void(0);" id="navbarNitify" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
		$salida.='<i class="fas fa-bell"></i><span id="push-badge" class="notification"></span>';
		$salida.='<p class="d-lg-none d-md-block">...</p>';
		$salida.='</a>';
		$salida.='<div id="list-notifications" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">';
		$salida.='<a class="dropdown-item" href="javascript:void(0)">---</a>';
		$salida.='</div>';
	$salida.='</li>';
	$salida.='<li class="nav-item dropdown">';
		$salida.='<a class="nav-link" href="javascript:void(0);" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
		$salida.='<i class="fas fa-user"></i>';
		$salida.='<p class="d-lg-none d-md-block">Perfil</p>';
		$salida.='</a>';
		$salida.='<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">';
		$salida.='<a class="dropdown-item" href="'.$nivel.'CPPERFIL/FRMperfil.php"><i class="fa fa-user"></i> &nbsp; Datos del Perfil</a>';
		$salida.='<a class="dropdown-item" href="'.$nivel.'CPPERFIL/FRMpassword.php"><i class="fa fa-key"></i> &nbsp; Usuario y Contrase&ntilde;a</a>';
		$salida.='<a class="dropdown-item" href="'.$nivel.'CPPERFIL/FRMajustes.php"><i class="fa fa-cog"></i> &nbsp; Ajustes</a>';
		$salida.='</div>';
	$salida.='</li>';
	$salida.='<li class="nav-item">';
		$salida.='<a class="nav-link" href="'.$nivel.'ayuda.php">';
			$salida.='<i class="fas fa-question-circle"></i>';
			$salida.='<p class="d-lg-none d-md-block">Ayuda</p>';
		$salida.='</a>';
	$salida.='</li>';
	$salida.='<li class="nav-item">';
		$salida.='<a class="nav-link" href="'.$nivel.'logout.php">';
			$salida.='<i class="fas fa-power-off"></i>';
			$salida.='<p class="d-lg-none d-md-block">Salir</p>';
		$salida.='</a>';
	$salida.='</li>';

	return $salida;
}


//////////////////////////////////// ADMINISTRACION ////////////////////////////////////
function menu_administracion($nivel = '',$collapse = true) {
	$collapse = ($collapse == true)?"collapse":"";
	$activemenu = ($collapse == true)?"":"active";
	// Obtiene al pagina actual
	$pagina = current_page();
	////----
	$salida = '';
	if($_SESSION["GRP_GPADMIN"] == 1){
		$salida.='<li class="nav-item ">';
		$salida.='<a class="nav-link" data-toggle="collapse" href="#administracio">';
		$salida.='<i class="fa fa-users-cog"></i>';
		$salida.='<p>';
		$salida.='Administraci&oacute;n';
		$salida.='<b class="caret"></b>';
		$salida.='</p>';
		$salida.='</a>';
		$salida.='<div class="'.$collapse.'" id="administracio">';
		$salida.='<ul class="nav">';
		if($_SESSION["GUSU"] == 1){
			//--
			$activeitem = ($pagina == "FRMusuarios.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPUSUARIOS/FRMusuarios.php">';
			$salida.='<span class="sidebar-mini"><i class="fa fa-user"></i></span>';
			$salida.='<span class="sidebar-normal">Gestor de Usuarios </span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		if($_SESSION["ASIROL"] == 1){
			//--
			$activeitem = ($pagina == "FRMasignacion_rol.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPUSUARIOS/FRMasignacion_rol.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fa fa-key"></i></span>';
			$salida.='<span class="sidebar-normal"> Administrador de Permisos </span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		if($_SESSION["GPERM"] == 1){
			//--
			$activeitem = ($pagina == "FRMpermisos.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPPERMISOS/FRMpermisos.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fas fa-list-ol"></i></span>';
			$salida.='<span class="sidebar-normal"> Gestor de Permisos </span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		if($_SESSION["GRUPPERM"] == 1){
			//--
			$activeitem = ($pagina == "FRMgrupos.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPPERMISOS/FRMgrupos.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fas fa-unlock-alt"></i></span>';
			$salida.='<span class="sidebar-normal"> Grupos de Permisos </span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		if($_SESSION["GESROL"] == 1){
			//--
			$activeitem = ($pagina == "FRMrol.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPPERMISOS/FRMrol.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fas fa-cogs"></i></span>';
			$salida.='<span class="sidebar-normal"> Gestor de Roles </span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		if($_SESSION["USUSED"] == 1){
			//--
			$activeitem = ($pagina == "FRMusuario_sede.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPUSUARIOS/FRMusuario_sede.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fa fa-bank"></i></span>';
			$salida.='<span class="sidebar-normal"> Usuarios / Sedes </span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		if($_SESSION["USUDEP"] == 1){
			//--
			$activeitem = ($pagina == "FRMusuario_departamento.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPUSUARIOS/FRMusuario_departamento.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fa fa-building-o"></i></span>';
			$salida.='<span class="sidebar-normal"> Usuarios / Departamento </span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		if($_SESSION["USUCAT"] == 1){
			//--
			$activeitem = ($pagina == "FRMusuario_categoria.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPUSUARIOS/FRMusuario_categoria.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fa fa-tags"></i></span>';
			$salida.='<span class="sidebar-normal"> Usuarios / Categor&iacute;as </span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		$salida.='</ul>';
		$salida.='</div>';
		$salida.='</li>';
	}
	return $salida;
}



function menu_gestion_tecnica($nivel = '',$collapse = true) {
	$collapse = ($collapse == true)?"collapse":"";
	$activemenu = ($collapse == true)?"":"active";
	// Obtiene al pagina actual
	$pagina = current_page();
	////----
	$salida = '';
	if($_SESSION["GRP_GESTEC"] == 1){
		$salida.='<li class="nav-item '.$activemenu.'">';
		$salida.='<a class="nav-link" data-toggle="collapse" href="#gestores">';
		$salida.='<i class="fa fa-cogs"></i>';
		$salida.='<p>';
		$salida.='Gestores T&eacute;cnicos';
		$salida.='<b class="caret"></b>';
		$salida.='</p>';
		$salida.='</a>';
		$salida.='<div class="'.$collapse.'" id="gestores">';
		$salida.='<ul class="nav">';
		if($_SESSION["GESSED"] == 1){
			//--
			$activeitem = ($pagina == "FRMsede.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPSEDE/FRMsede.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fa fa-bank"></i></span>';
			$salida.='<span class="sidebar-normal"> Gestor de Sedes </span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		if($_SESSION["GESDEP"] == 1){
			//--
			$activeitem = ($pagina == "FRMdepartamento.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPDEPARTAMENTO/FRMdepartamento.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fa fa-building-o"></i></span>';
			$salida.='<span class="sidebar-normal"> Gestor de Departamento </span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		if($_SESSION["GESCC"] == 1){
			//--
			$activeitem = ($pagina == "FRMcentrocosto.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPCCOSTO/FRMcentrocosto.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fab fa-creative-commons"></i></span>';
			$salida.='<span class="sidebar-normal"> Gestor de Centros de Costo </span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		if($_SESSION["GESMON"] == 1){
			//--
			$activeitem = ($pagina == "FRMmoneda.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPMONEDA/FRMmoneda.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fa fa-money"></i></span>';
			$salida.='<span class="sidebar-normal"> Gestor de Monedas</span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		if($_SESSION["GESVER"] == 1){
			//--
			$activeitem = ($pagina == "FRMversion.php")?"active":"";
			$salida.='<li class="nav-item '.$activeitem.'">';
			$salida.='<a class="nav-link" href="'.$nivel.'CPVERSION/FRMversion.php">';
			$salida.='<span class="sidebar-mini-icon"><i class="fas fa-mobile"></i></span>';
			$salida.='<span class="sidebar-normal"> Admin. Versiones</span>';
			$salida.='</a>';
			$salida.='</li>';
		}
		$salida.='</ul>';
		$salida.='</div>';
		$salida.='</li>';
	}

	return $salida;
}


//////////////////////////////// FOOTER //////////////////////////////////////////

function menu_footer($nivel) {
	$salida = '';
	$salida.='<footer class="footer">';
	$salida.='<div class="container-fluid">';
	$salida.='<nav class="float-left">';
	$salida.='<ul>';
	$salida.='<li>';
	$salida.='<a href="https://www.farasi.com.gt">';
	$salida.='Versi&oacute;n 1.1.2 | Powered By <strong>Farasi Software</strong>';
	$salida.='</a>';
	$salida.='</li>';
	$salida.='</ul>';
	$salida.='</nav>';
	$salida.='<div class="copyright float-right">';
	$salida.='&copy; 2021, Copyright';
	$salida.='<a href="https://www.farasi.com.gt" target="_blank"> Farasi S.A.</a>';
	$salida.='</div>';
	$salida.='</div>';
	$salida.='</footer>';

	return $salida;
}


//////////////////////////////// TEMPLATES SCRIPTS //////////////////////////////////////////

function scripts_CSS($nivel, $titulo) {
	$salida = '';
	$salida.= '<meta charset="utf-8" />';
     $salida.= '<link rel="apple-touch-icon" sizes="76x76" href="https://image.flaticon.com/icons/png/512/633/633600.png">';
     $salida.= '<link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/633/633600.png">';
     $salida.= '<title> '.$titulo.' </title>';
	$salida.= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
     $salida.= '<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport" />';
     // <!--     Fonts and icons     --> //
     $salida.= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />';
     // <!-- fontawesome --> //
     $salida.= '<script src="https://kit.fontawesome.com/907a027ade.js" crossorigin="anonymous"></script>';
	// <!-- Swal --> //
	$salida.= '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
	// <!-- CSS Files --> //
     $salida.= '<link href="'.$nivel.'assets/css/material-dashboard.css" rel="stylesheet" />';
     // <!-- CSS Just for demo purpose, don't include it in your project --> //
     $salida.= '<link href="'.$nivel.'assets/css/propios/formulario.css" rel="stylesheet" />';
	// <!-- Personal CSS --> //
	$salida.= '<link href="'.$nivel.'assets/css/plugins/cropper/cropper.min.css" rel="stylesheet">';

	return $salida;
}

function scripts_JS($nivel) {
	$salida = '';
	// <!--   Core JS Files   --> //
     $salida.= '<script src="'.$nivel.'assets/js/core/jquery.min.js"></script>';
     $salida.= '<script src="'.$nivel.'assets/js/core/popper.min.js"></script>';
     $salida.= '<script src="'.$nivel.'assets/js/core/bootstrap-material-design.min.js"></script>';
     $salida.= '<script src="'.$nivel.'assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>';
	// <!-- Plugin for the momentJs  --> //
     $salida.= '<script src="'.$nivel.'assets/js/plugins/moment.min.js"></script>';
     // <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select --> //
     $salida.= '<script src="'.$nivel.'assets/js/plugins/bootstrap-selectpicker.js"></script>';
     // <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ --> //
     $salida.= '<script src="'.$nivel.'assets/js/plugins/bootstrap-datetimepicker.min.js"></script>';
     // <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  --> //
     $salida.= '<script src="'.$nivel.'assets/js/plugins/jquery.dataTables.min.js"></script>';
     // <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  --> //
     $salida.= '<script src="'.$nivel.'assets/js/plugins/bootstrap-tagsinput.js"></script>';
     // <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput --> //
     $salida.= '<script src="'.$nivel.'assets/js/plugins/jasny-bootstrap.min.js"></script>';
     // <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    --> //
     $salida.= '<script src="'.$nivel.'assets/js/plugins/fullcalendar.min.js"></script>';
     // <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ --> //
     $salida.= '<script src="'.$nivel.'assets/js/plugins/jquery-jvectormap.js"></script>';
     // <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ --> //
     $salida.= '<script src="'.$nivel.'assets/js/plugins/nouislider.min.js"></script>';
     // <!-- Chartist JS --> //
     $salida.= '<script src="'.$nivel.'assets/js/plugins/chartist.min.js"></script>';
     // <!--  Notifications Plugin    --> //
     $salida.= '<script src="'.$nivel.'assets/js/plugins/bootstrap-notify.js"></script>';
     // <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc --> //
     $salida.= '<script src="'.$nivel.'assets/js/material-dashboard.js" type="text/javascript"></script>';
	// <!-- cropper --> //
	$salida.= '<script type="text/javascript" src="'.$nivel.'assets/js/plugins/cropper/cropper.min.js"></script>';
	// <!-- select2 --> //
	$salida.= '<script src="'.$nivel.'assets/js/plugins/select2/select2.full.min.js"></script>';
     // <!-- propios --> //
	$salida.= '<script type="text/javascript" src="'.$nivel.'assets/js/modules/ejecutaModal.js"></script>';
     $salida.= '<script type="text/javascript" src="'.$nivel.'assets/js/modules/loading.js"></script>';
     $salida.= '<script type="text/javascript" src="'.$nivel.'assets/js/modules/util.js"></script>';

	return $salida;
}

?>
