<?php

	include "conexiones.php";
	if(isset($_POST['id_mesa'])){
		$id_mesa = $_POST['id_mesa'];
		$id_queso = $_POST['id_queso'];
		for($i=1; $i<25; $i++){
			if(isset ($_POST['s'.$i])){
				$sel = $_POST['s'.$i];
				
				mysqli_query($con, "update puntaje set campo$i = '$sel'
							where id_queso = $id_queso
							and id_mesa = $id_mesa");
			}
		}
		header("Location: configuring.php");
	}
?>