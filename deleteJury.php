<?php
	include "conexiones.php";
	if ( isset($_GET['id_j']) && isset($_GET['id_m'])) {
		$id_j = $_GET['id_j'];
		$id_m = $_GET['id_m'];

		$query1 = "delete from mesa_jurado where id_mesa=$id_m and id_jurado=$id_j";
		mysqli_query($con, $query1);
		header("Location: estadistics.php?id_m=$id_m");
	}
?>
