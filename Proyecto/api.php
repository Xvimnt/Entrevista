<?php
ob_start();
header("Cache-control: private, no-cache");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Pragma: no-cache");
header("Cache: no-cahce");
ini_set('max_execution_time', 90000);
ini_set("memory_limit", -1);

include_once('html_fns.php');

$request = $_REQUEST["request"];
switch ($request) {
	case "register":
		$name = $_REQUEST["name"];
		$nick = $_REQUEST["nick"];
		$password = $_REQUEST["password"];
		register($name, $nick, $password);
		break;
	case "search":
		$title = $_REQUEST["title"];
		search($title);
		break;
	case "save":
		$imdb = $_REQUEST["imdb"];
		save($imdb);
		break;
	case "delete":
		$imdb = $_REQUEST["imdb"];
		delete($imdb);
		break;
	case "favorites":
		favorites();
		break;
	default:
		$arr_respuesta = array(
			"status" => false,
			"data" => [],
			"message" => "Seleccione un metodo..."
		);
		echo json_encode($arr_respuesta);
}

function favorites()
{
	$user = $_SESSION["id"];
	$ClsMov = new ClsMovie();
	$result = $ClsMov->get_movie($user);
	if (is_array($result)) {
		$data = '';
		foreach ($result as $row) {
			$imdb = $row["imdb"];
			$response = file_get_contents('http://www.omdbapi.com/?i=' . $imdb . '&apikey=4f8b3d5f');
			$response = json_decode($response);
			// Se construye el html para las peliculas
			$data .= "<div class='row'>";
			$data .= "<div class='col-md-6'>";
			$data .= '<label>Titulo:</label><input readonly class="form-control" value="' . $response->Title . '"/>';
			$data .= '<label>Año:</label><input readonly class="form-control" value="' . $response->Year . '"/>';
			$data .= '<label>Rating:</label><input readonly class="form-control" value="' . $response->Rated . '"/>';
			$data .= '<input hidden class="form-control" value="' . $response->imdbID . '"/>';
			$data .= "<div class='row'>";
			$data .= "<div class='col-md-12 text-center'>";
			$data .= '<button type="button" class="btn btn-danger" id="btn-grabar" onclick="Delete();"><i class="fas fa-trash"></i> Eliminar</button>';
			$data .= '</div>';
			$data .= '</div>';
			$data .= '</div>';
			$data .= "<div class='col-md-6'>";
			$data .= '<div class="img-preview img-preview-sm"><img src="' . $response->Poster . '"></img></div>';
			$data .= '</div>';
			$data .= '</div>';
			$data .= '<hr>';
			$data .= '<br>';
		}
		$arr_respuesta = array(
			"status" => true,
			"data" => $data,
		);
	} else {
		$arr_respuesta = array(
			"status" => false,
			"data" => [],
			"message" => "No se encuentran datos registrados..."
		);
	}
	echo json_encode($arr_respuesta);
}

function delete($imdb)
{
	$user = $_SESSION["id"];
	$ClsMov = new ClsMovie();
	$result = $ClsMov->get_movie($user, $imdb);
	if (!is_array($result)) {
		$arr_respuesta = array(
			"status" => false,
			"message" => "Pelicula no existente, imposible eliminar"
		);
	} else {
		$sql = $ClsMov->deLete_movie($user, $imdb);
		$rs = $ClsMov->exec_sql($sql);
		if ($rs) {
			$arr_respuesta = array(
				"status" => true,
				"message" => "Pelicula eliminada con exito"
			);
		} else {
			$arr_respuesta = array(
				"status" => false,
				"data" => [],
				"message" => $sql
			);
		}
	}
	echo json_encode($arr_respuesta);
}

function save($imdb)
{
	$user = $_SESSION["id"];
	$ClsMov = new ClsMovie();
	$result = $ClsMov->get_movie($user, $imdb);
	if (is_array($result)) {
		$arr_respuesta = array(
			"status" => false,
			"message" => "Pelicula ya existente, pruebe con otra pelicula"
		);
	} else {
		$sql = $ClsMov->insert_movie($user, $imdb);
		$rs = $ClsMov->exec_sql($sql);
		if ($rs) {
			$arr_respuesta = array(
				"status" => true,
				"message" => "Pelicula registrada con exito"
			);
		} else {
			$arr_respuesta = array(
				"status" => false,
				"data" => [],
				"message" => $sql
			);
		}
	}
	echo json_encode($arr_respuesta);
}

function search($title)
{
	$response = file_get_contents('http://www.omdbapi.com/?t=' . $title . '&apikey=4f8b3d5f');
	$response = json_decode($response);
	// Se construye el html para las peliculas
	$data = "<div class='row'>";
	$data .= "<div class='col-md-6'>";
	$data .= '<label>Titulo:</label><input readonly class="form-control" value="' . $response->Title . '"/>';
	$data .= '<label>Año:</label><input readonly class="form-control" value="' . $response->Year . '"/>';
	$data .= '<label>Rating:</label><input readonly class="form-control" value="' . $response->Rated . '"/>';
	$data .= '<input hidden id="imdb" class="form-control" value="' . $response->imdbID . '"/>';
	$data .= '</div>';
	$data .= "<div class='col-md-6'>";
	$data .= '<div class="img-preview img-preview-sm"><img src="' . $response->Poster . '"></img></div>';
	$data .= '</div>';
	$data .= '</div>';
	$data .= '<hr>';
	$data .= '<br>';
	$data .= '<div class="row">';
	$data .= '<div class="col-md-12 text-center">';
	$data .= '<button type="button" class="btn btn-white" id="btn-limpiar" onclick="window.location.reload();"><i class="fas fa-eraser"></i> Limpiar</button>';
	// Comprobar si ya la tiene asignada
	$user = $_SESSION["id"];
	$ClsMov = new ClsMovie();
	$result = $ClsMov->get_movie($user, $response->imdbID);
	if (is_array($result)) {
		$data .= '<button type="button" class="btn btn-danger" id="btn-grabar" onclick="Delete();"><i class="fas fa-trash"></i> Eliminar</button>';
	} else {
		$data .= '<button type="button" class="btn btn-primary" id="btn-grabar" onclick="Save();"><i class="fas fa-save"></i> Guardar</button>';
	}

	$data .= '</div>';
	$data .= '</div>';
	// Respuesta de nuestro api
	$arr_respuesta = array(
		"status" => true,
		"data" => $data,
	);
	echo json_encode($arr_respuesta);
}

function register($name, $nick, $password)
{
	$ClsUsu = new ClsUsuario();
	$id = $ClsUsu->max_user();
	$id++;
	$result = $ClsUsu->get_user('', $nick);
	if (is_array($result)) {
		$arr_respuesta = array(
			"status" => false,
			"message" => "Usuario ya existente, pruebe con otro usuario"
		);
	} else {
		$sql = $ClsUsu->insert_user($id, $nick, $password, $name);
		$rs = $ClsUsu->exec_sql($sql);
		if ($rs) {
			$arr_respuesta = array(
				"status" => true,
				"message" => "Usuario registrado con exito"
			);
		} else {
			$arr_respuesta = array(
				"status" => false,
				"data" => [],
				"message" => $sql
			);
		}
	}
	echo json_encode($arr_respuesta);
}
