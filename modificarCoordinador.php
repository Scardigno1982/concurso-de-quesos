<?php

	if(isset($_GET['id_j'])){
		include "conexiones.php";
		$id_j = $_GET['id_j'];
		$id_m = $_GET['id_m'];

		$update = mysqli_query($con,"update mesa set id_coordinador_mesa = $id_j where id_mesa = $id_m") or die (mysqli_error($con));
		header("Location: configuring.php");

	}

?>