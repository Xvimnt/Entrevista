<?php
require_once("Clases/ClsUsuario.php");
include_once('user_auth_fns.php');

     function consulta_log(){
     $ClsUsu = new ClsUsuario();
     $ClsPerm = new ClsPermiso();
     //esta funcion verifica con que tipo de navegador pretende utilizar el sistema el Usuario
     check_Nav();

     $usu = $_SESSION['usu'];
     $pass = $_SESSION['pass'];
     //////////////////////// CREDENCIALES DE CLIENTE
	$ClsConf = new ClsConfig();
	$result = $ClsConf->get_credenciales();
	if(is_array($result)){
		foreach($result as $row){
			$cliente_nombre = utf8_decode($row['cliente_nombre']);
			$cliente_clave = utf8_decode($row['cliente_clave']);
		}
	}
     ////////////////
     $_SESSION["cliente_nombre"] = $cliente_nombre;
     $_SESSION["cliente_clave"] = $cliente_clave;
     //////////////////////////- CREDENCIALES DEL CLIENTE

     $result = $ClsUsu->get_login($usu,$pass);
     if(is_array($result)) {
          foreach ($result as $row){
               $codigo = $row['usu_codigo'];
               $nombre = utf8_decode($row['usu_nombre']);
               $rol = $row['usu_rol']; // 1 -> Administrador , 2 -> Solicitante, 3 -> Help Desk
               $user_id = $row['usu_dpi']; // ID asignado al Usuario para Kaltua
               $band = $row['usu_habilita'];
               $rol_nombre = utf8_decode($row['rol_nombre']);
          }

          $foto = $ClsUsu->last_foto_usuario($codigo);
          if(file_exists('../CONFIG/Fotos/USUARIOS/'.$foto.'.jpg') && $foto != ""){
               $foto = 'USUARIOS/'.$foto.'.jpg';
          } else {
               $foto = "nofoto.png";
          }

          /// USUARIO
          $_SESSION['codigo'] = $codigo;
          $_SESSION['nombre'] = $nombre;
          $_SESSION['rol'] = $rol;
          $_SESSION['userID'] = $user_id;
          $_SESSION['rol_nombre'] = $rol_nombre;
          $_SESSION['foto'] = $foto;

          //// PERMISOS
          $result = $ClsPerm->get_asi_permisos($codigo);
          if (is_array($result)) {
               $gpcod1 = "";
               $gpcod2 = "";
               foreach ($result as $row){
               	$gpclave = trim($row['gperm_clave']); //Clave de grupo
               	$clave = trim($row['perm_clave']); //clave de permiso
               	$nivel = $row['roll_nombre']; //nombre del rol
               	$_SESSION["GRP_$gpclave"] = 1;
               	$_SESSION["$clave"] = 1;
               }
          }

          ///////// Valida si se pide cambio de contraseña
          if($band != 1){
               //Header('Location: FRMcambia_pass.php');
               redirect('CPUSUARIOS/FRMcambia_pass.php',0);
          }else{
               redirect('menu.php',0);
          }
     }else{
          //redirecciona por medio de $_post
          echo "<form id='f1' name='f1' action='index.php' method='post'>";
          echo "<input type='hidden' name='invalid' value='1' />";
          echo "<input type='hidden' name='seg' value='0' />";
          echo "<script>document.f1.submit();</script>";
          echo "</form>";
     }

}

function redirect($url,$seconds){
     $ss = $seconds * 1000;
     $comando = "<script>window.setTimeout('window.location=".chr(34).$url.chr(34).";',".$ss.");</script>";
     echo ($comando);
}

function check_Nav(){
     $comando = "<script>
     var browser=navigator.appName;
     if (browser == 'Microsoft Internet Explorer'){
          if (confirm('No se puede Ingresar a este Sistema por medio de Internet Explorer, se recomienda utilizar FireFox o algun otro Navegador de Netscape. Desa Descargar FireFox?')){
     	         window.location.href='logout2.php';
          }else{
     	         window.location.href='logout.php';
          }
     }
     </script>";

     echo ($comando);
}

?>
