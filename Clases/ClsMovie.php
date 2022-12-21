<?php
require_once("ClsConex.php");
date_default_timezone_set('America/Guatemala');

class ClsMovie extends ClsConex
{
	function get_movie($user = '', $imdb = '')
	{
		$sql = "SELECT * ";
		$sql .= " FROM movie";
		$sql .= " WHERE 1 = 1";
		if (strlen($user) > 0) {
			$sql .= " AND user = $user";
		}
		if (strlen($imdb) > 0) {
			$sql .= " AND imdb LIKE '%$imdb%'";
		}
		$result = $this->exec_query($sql);
		// echo $sql;
		return $result;
	}


	function deLete_movie($user = '', $imdb = '')
	{
		$sql = "DELETE ";
		$sql .= " FROM movie";
		$sql .= " WHERE 1 = 1";
		if (strlen($user) > 0) {
			$sql .= " AND user = $user";
		}
		if (strlen($imdb) > 0) {
			$sql .= " AND imdb LIKE '%$imdb%'";
		}
		// echo $sql;
		return $sql;
	}

	function insert_movie($user, $imdb)
	{
		$sql = "INSERT INTO movie ";
		$sql .= " VALUES($user,'$imdb'); ";
		//echo $sql;
		return $sql;
	}

}
