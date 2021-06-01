<?php
require_once("ClsConex.php");
date_default_timezone_set('America/Guatemala');

class ClsUsuario extends ClsConex
{
	function get_user($codigo = '', $nick = '', $password = '')
	{
		$password = $this->encrypt($password, $nick); //encrypta el pasword
		$sql = "SELECT * ";
		$sql .= " FROM user";
		$sql .= " WHERE 1 = 1";
		if (strlen($codigo) > 0) {
			$sql .= " AND id = $codigo";
		}
		if (strlen($nick) > 0) {
			$sql .= " AND nick LIKE '%$nick%'";
		}
		if (strlen($password) > 0) {
			$sql .= " AND password LIKE '%$password%'";
		}
		$result = $this->exec_query($sql);
		// echo $sql;
		return $result;
	}


	function insert_user($codigo, $nick, $password, $name)
	{
		$pass = $this->encrypt($password, $nick); //encrypta el pasword

		$sql = "INSERT INTO user ";
		$sql .= " VALUES($codigo,'$nick', '$pass', '$name'); ";
		//echo $sql;
		return $sql;
	}

	function max_user()
	{

		$sql = "SELECT max(id) as max ";
		$sql .= " FROM user";

		$result = $this->exec_query($sql);
		foreach ($result as $row) {
			$max = $row["max"];
		}
		//echo $sql;
		return $max;
	}
}
