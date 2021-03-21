<?php
	
	include "conexiones.php";

	if(isset($_GET['id_j'])){
		$id_j = $_GET['id_j'];
		$id_m = $_GET['id_m'];
		$eliminar = "delete from puntaje where id_jurado = $id_j and id_mesa = $id_m";
		mysqli_query($con,$eliminar) or die (mysqli_error($con));

		$cons = mysqli_query($con,"select distinct id_jurado from puntaje where id_mesa = $id_m");

		if(mysqli_num_rows($cons) == 1){ //SOLO QUEDA LA PLANILLA CONCENSUADA
			$eliminar_concensuada = "delete from puntaje where id_jurado = 1 and id_mesa = $id_m";
			mysqli_query($con,$eliminar_concensuada) or die (mysqli_error($con));
		}

		header("Location: ".$_SERVER['HTTP_REFERER']);
	}

?>