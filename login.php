<?php
include_once('user_auth_fns.php');
require_once("Clases/ClsUsuario.php");
$username = $_REQUEST['nick'];
$password = $_REQUEST['password'];
$seg = $_REQUEST['seg'];

if ($username != '' && $password != '') {
	if (login($username, $password)) {

		echo "<script>window.location='index.php';</script>";
	} else {
		//redirecciona por medio de $_post
		echo "<form id='f1' name='f1' action='index.php' method='post'>";
		echo "<input type='hidden' name='invalid' value='1' />";
		echo "<input type='hidden' name='seg' value='$seg' />";
		echo "<script>document.f1.submit();</script>";
		echo "</form>";
	}
} else {
	//redirecciona por medio de $_post
	echo "<form id='f1' name='f1' action='index.php' method='post'>";
	echo "<input type='hidden' name='invalid' value='2' />";
	echo "<input type='hidden' name='seg' value='$seg' />";
	echo "<script>document.f1.submit();</script>";
	echo "</form>";
}
