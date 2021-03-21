<?php
	
	include "conexiones.php";

	if(isset($_GET['id_q'])){
		$id_q = $_GET['id_q'];
		$id_m = $_GET['id_m'];
		$eliminar = "delete from puntaje where id_queso = $id_q and id_mesa = $id_m";
		mysqli_query($con,$eliminar) or die (mysqli_error($con));
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}

?>