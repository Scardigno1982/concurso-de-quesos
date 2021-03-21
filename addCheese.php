<?php
	include "conexiones.php";
	if ( isset($_GET['id_q']) && isset($_GET['id_m'])) {
		$id_q = $_GET['id_q'];
		$id_m = $_GET['id_m'];

		$query1 = "INSERT INTO mesa_queso values($id_m,$id_q)";
		mysqli_query($con, $query1);
		header("Location: estadistics.php?id_m=$id_m");
	}
?>
