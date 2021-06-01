<?php
//-- SISTEMA --
include_once('user_auth_fns.php');
//--CLASES DEL SISTEMA
require_once("Clases/ClsUsuario.php");
require_once("Clases/ClsMovie.php");

//////////////////////////////////////////
include_once('html_menus.php');
////////////////////////////////////////////////////
//Convierte fecha de normal a Informix
////////////////////////////////////////////////////
function escape_format($fecha,$escape) {
	/// recibe y devuelve ---
   return $fecha;
}

////////////////////////////////////////////////////
//quita caracteres de espa�ol
////////////////////////////////////////////////////
function depurador_texto($texto) {
	$texto = trim($texto);
	$texto = str_replace("�","a",$texto);
	$texto = str_replace("�","e",$texto);
	$texto = str_replace("�","i",$texto);
	$texto = str_replace("�","o",$texto);
	$texto = str_replace("�","u",$texto);
	$texto = str_replace("�","A",$texto);
	$texto = str_replace("�","E",$texto);
	$texto = str_replace("�","I",$texto);
	$texto = str_replace("�","U",$texto);
	$texto = str_replace("�","n",$texto);
	$texto = str_replace("�","N",$texto);
     //--
	$texto = str_replace("�","A",$texto);
	$texto = str_replace("�","E",$texto);
	$texto = str_replace("�","I",$texto);
	$texto = str_replace("�","O",$texto);
	$texto = str_replace("�","U",$texto);
	$texto = str_replace("�","a",$texto);
	$texto = str_replace("�","e",$texto);
	$texto = str_replace("�","i",$texto);
	$texto = str_replace("�","o",$texto);
	$texto = str_replace("�","u",$texto);

   return $texto;
}


////////////////////////////////////////////////////
//Convierte fecha de Informix a normal
////////////////////////////////////////////////////
function cambia_fecha($Fecha){
	if ($Fecha<>""){
		$trozos = explode("-",$Fecha,3);
		return $trozos[2]."/".$trozos[1]."/".$trozos[0];
	} else {
		return $Fecha;
	}
}

////////////////////////////////////////////////////
//Convierte fecha de normal a Informix
////////////////////////////////////////////////////
function regresa_fecha($Fecha) {
	if ($Fecha<>""){
		$trozos=explode("/",$Fecha,3);
		return $trozos[2]."-".$trozos[1]."-".$trozos[0];
	} else {
		return $Fecha;
	}
}

////////////////////////////////////////////////////
//Convierte fecha y hora de Informix a normal
////////////////////////////////////////////////////
function cambia_fechaHora($Fecha) {
if ($Fecha<>""){
   $trozos=explode("-",$Fecha);
   $trozos2=explode(" ",$trozos[2]);
   $fecha = $trozos2[0]."/".$trozos[1]."/".$trozos[0];
   $hora = $trozos2[1];
   return "$fecha $hora";
}else
   {return $Fecha;}
}


////////////////////////////////////////////////////
//Convierte fecha y hora de Informix a normal
////////////////////////////////////////////////////
function regresa_fechaHora($Fecha) {
if ($Fecha<>""){
   $trozos=explode("/",$Fecha);
   $trozos2=explode(" ",$trozos[2]);
   $fecha = $trozos2[0]."-".$trozos[1]."-".$trozos[0];
   $hora = $trozos2[1];
   return "$fecha $hora";
}else
   {return $Fecha;}
}

////////////////////////////////////////////////////
// Fecha en formato dd/mm/yyyy o dd-mm-yyyy retorna la diferencia en dias
////////////////////////////////////////////////////

function restaFechas($dFecIni, $dFecFin){

	$date1 = strtotime ( $dFecIni );
	$date2 = strtotime ( $dFecFin );

	$date1 = new DateTime($dFecIni);
	$date2 = new DateTime($dFecFin);
	$interval = $date1->diff($date2);
	//print_r($interval)."<br>";

	return $interval->days;
}


function comparaFechas($fecha1, $fecha2){

	$date1 = strtotime ( $fecha1 );
	$date2 = strtotime ( $fecha2 );

	if($date1 > $date2){
		return 1; //la fecha1 es mayor
	}else if($date2 > $date1){
		return 2; //la fecha2 es mayor
	}else{
		return 0; //las fechas son iguales
	}
}


/////----

function horasYdecimales($tiempo){
	$trozos = explode("/",$tiempo);
	$horas = $trozos[0];
	$minutos = $trozos[1];
	$minutos = $minutos/60;

	return $horas + $minutos;

}

////////////////////////////////////////////////////
// Fecha en formato dd/mm/yyyy retorna fecha con los dias sumados
////////////////////////////////////////////////////

function Fecha_suma_dias($Fecha, $dias){
    $fec = explode("/",$Fecha);
	$day = $fec[0];
	$mon = $fec[1];
	$year = $fec[2];

	$fecha_cambiada = mktime(0,0,0,$mon,$day+$dias,$year);
	$fecha = date("d/m/Y", $fecha_cambiada);
	return $fecha; //devuelve dd/mm/yyyy
}


////////////////////////////////////////////////////
// Fecha en formato dd/mm/yyyy retorna fecha con los dias sumados
////////////////////////////////////////////////////

function Fecha_resta_dias($Fecha, $dias){
    $fec = explode("/",$Fecha);
	$day = $fec[0];
	$mon = $fec[1];
	$year = $fec[2];

	$fecha_cambiada = mktime(0,0,0,$mon,$day-$dias,$year);
	$fecha = date("d/m/Y", $fecha_cambiada);
	return $fecha; //devuelve dd/mm/yyyy
}


////////////////////////////////////////////////////
// compara horarios
////////////////////////////////////////////////////

function compara_horas($hora1, $hora2){
    $h1 = substr($hora1,0,2);
	$m1 = substr($hora1,3,2);
	$h2 = substr($hora2,0,2);
	$m2 = substr($hora2,3,2);
	if($h1 > $h2){
		$mayor = true;
	}else if($h1 == $h2){
		if($m1 > $m2){
			$mayor = true;
		}else{
			$mayor = false;
		}
	}else{
		$mayor = false;
	}

	return $mayor; //devuelve si la hora 1 es mayor a la hora 2
}


////////////////////////////////////////////////////
//Calcular Horas, Minutos y Segundos
////////////////////////////////////////////////////
function calculaHoras($segundos) {
	$horas = ($segundos/3600);
	$horas = number_format($horas,2,".","");
	$separa = explode(".",$horas);
	$horas = $separa[0];
	$decimales = $separa[1];
	//--
	$minutos = ($decimales * 60)/100;
	$minutos = number_format($minutos,2,".","");
	$separa = explode(".",$minutos);
	$minutos = $separa[0];
	$decimales = $separa[1];
	//--
	$segundos = ($decimales * 60)/100;
	$segundos = round($segundos,0);

	return "$horas hora(s), $minutos minuto(s), $segundos segundo(s)";
}


////////////////////////////////////////////////////
// Fecha en formato dd/mm/yyyy retorna fecha con los dias sumados
////////////////////////////////////////////////////

function cambioMoneda($de,$para,$cuanto){
   $dato = $de * $cuanto;
   $dato = $dato/$para;
   $dato = round($dato, 2);
	return $dato;
}


////////////////////////////////////////////////////
//devuelve los Nombres de los meses en letras
////////////////////////////////////////////////////
function Meses_Letra($num){
	switch($num){
		case 1: $letra = "Enero"; break;
		case 2: $letra = "Febrero"; break;
		case 3: $letra = "Marzo"; break;
		case 4: $letra = "Abril"; break;
		case 5: $letra = "Mayo"; break;
		case 6: $letra = "Junio"; break;
		case 7: $letra = "Julio"; break;
		case 8: $letra = "Agosto"; break;
		case 9: $letra = "Septiembre"; break;
		case 10: $letra = "Octubre"; break;
		case 11: $letra = "Noviembre"; break;
		case 12: $letra = "Diciembre"; break;
	}
	return $letra;
}

////////////////////////////////////////////////////
//devuelve los Nombres de los d�as en letras
////////////////////////////////////////////////////
function Dias_Letra($num){
	switch($num){
		case 1: $letra = "Lunes"; break;
		case 2: $letra = "Martes"; break;
		case 3: $letra = "Miercoles"; break;
		case 4: $letra = "Jueves"; break;
		case 5: $letra = "Viernes"; break;
		case 6: $letra = "Sabado"; break;
		case 7: $letra = "Domingo"; break;
	}
	return $letra;
}

//////////-----
function Calcula_Edad($fecnac){
	if($fecnac !== ''){
		//calculo la fecha de hoy
		$hoy = date("d/m/Y");
		$array_fecha = explode("/",$fecnac);
		$ano = intval($array_fecha[2], 10);
		$mes = intval($array_fecha[1], 10);
		$dia = intval($array_fecha[0], 10);
		$edad = date("Y") - $ano;

		////// NOTA //////////
		if ((date("m") - $mes) < 0) {
			$edad--;
			return $edad;
		}
		if ((date("m") - $mes) >= 0) {
			if((date("m") - $mes) == 0){
				if((date("d")) >= $dia) {
					return $edad;
				}else{
					$edad--;
					return $edad;
				}
			}else{
				return $edad;
			}
		}
	}
}

////////////////////////////////////////////////////
//--------------------
////////////////////////////////////////////////////

function Agrega_Ceros($dato){
    $len = strlen($dato);
	switch($len){
		case 1: $dato = "000$dato"; break;
		case 2: $dato = "00$dato"; break;
		case 3: $dato = "0$dato"; break;
	}
	return $dato;
}

function comprobar_email($email){
    $mail_correcto = 0;
    //compruebo unas cosas primeras
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
          //miro si tiene caracter .
          if (substr_count($email,".")>= 1){
             //obtengo la terminacion del dominio
             $term_dom = substr(strrchr ($email, '.'),1);
             //compruebo que la terminacion del dominio sea correcta (@)
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    }
    if ($mail_correcto)
       return 1; // si el correo es valido regresa 1 o true
    else
       return 0; // si el correo no es valido regresa 0 o false
}

////////////////////////////////////////////////////
// URL DEL SERVIDOR
////////////////////////////////////////////////////
function url_origin( $s, $use_forwarded_host = false ){
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false ){
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}

////////////////////////////////////////////////////
//Exportaci�n a Excel
////////////////////////////////////////////////////
function LetrasBase($numero){
	if($numero > 0 && $numero <= 26){
		$letras = Trae_letra($numero);
	}else if($numero > 26 && $numero <= 52){
		$resta = ($numero - 26);
		$letras = "A".Trae_letra($resta);
	}else if($numero > 52 && $numero <= 78){
		$resta = ($numero - 52);
		$letras = "B".Trae_letra($resta);
	}else if($numero > 78 && $numero <= 104){
		$resta = ($numero - 78);
		$letras = "C".Trae_letra($resta);
	}

	return $letras;
}

////////////////////////////////////////////////////
//devuelve las letras de las columnas segun el numero de columna
////////////////////////////////////////////////////
function Trae_letra($numero){
	switch($numero){
		case 1: $letra = "A"; break;
		case 2: $letra = "B"; break;
		case 3: $letra = "C"; break;
		case 4: $letra = "D"; break;
		case 5: $letra = "E"; break;
		case 6: $letra = "F"; break;
		case 7: $letra = "G"; break;
		case 8: $letra = "H"; break;
		case 9: $letra = "I"; break;
		case 10: $letra = "J"; break;
		case 11: $letra = "K"; break;
		case 12: $letra = "L"; break;
		case 13: $letra = "M"; break;
		case 14: $letra = "N"; break;
		case 15: $letra = "O"; break;
		case 16: $letra = "P"; break;
		case 17: $letra = "Q"; break;
		case 18: $letra = "R"; break;
		case 19: $letra = "S"; break;
		case 20: $letra = "T"; break;
		case 21: $letra = "U"; break;
		case 22: $letra = "V"; break;
		case 23: $letra = "W"; break;
		case 24: $letra = "X"; break;
		case 25: $letra = "Y"; break;
		case 26: $letra = "Z"; break;
	}
	return $letra;
}

function quita_tildes($cadena){
	$cadena = str_replace("�","A",$cadena);
	$cadena = str_replace("�","E",$cadena);
	$cadena = str_replace("�","I",$cadena);
	$cadena = str_replace("�","O",$cadena);
	$cadena = str_replace("�","U",$cadena);
	$cadena = str_replace("�","n",$cadena);
	$cadena = str_replace("�","a",$cadena);
	$cadena = str_replace("�","e",$cadena);
	$cadena = str_replace("�","i",$cadena);
	$cadena = str_replace("�","o",$cadena);
	$cadena = str_replace("�","u",$cadena);
	$cadena = str_replace("�","n",$cadena);
	//--
	$cadena = str_replace("�","A",$cadena);
	$cadena = str_replace("�","E",$cadena);
	$cadena = str_replace("�","I",$cadena);
	$cadena = str_replace("�","O",$cadena);
	$cadena = str_replace("�","U",$cadena);
	$cadena = str_replace("�","a",$cadena);
	$cadena = str_replace("�","e",$cadena);
	$cadena = str_replace("�","i",$cadena);
	$cadena = str_replace("�","o",$cadena);
	$cadena = str_replace("�","u",$cadena);

	return $cadena;
}



////////////////////////////////////////////////////
//Valida el script (pagina) en ejecuci�n (vista actualmente)
////////////////////////////////////////////////////

function current_page(){
	$url = $_SERVER['PHP_SELF'];
	$arreglo = explode("/", $url);
	$contador = count($arreglo);
	$pagina = $arreglo[$contador - 1];

	return $pagina;
}

?>
