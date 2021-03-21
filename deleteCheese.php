<?php
	include "conexiones.php";
	if ( isset($_GET['id_q']) && isset($_GET['id_m'])) {
		$id_q = $_GET['id_q'];
		$id_m = $_GET['id_m'];

		$query1 = "delete from mesa_queso where id_mesa=$id_m and id_queso=$id_q";
		mysqli_query($con, $query1);
		header("Location: estadistics.php?id_m=$id_m");
	}
?>
