<?php
	
	include "conexiones.php";

	if(isset($_POST['jma'])){
		$id_j = $_POST['jma'];
		$id_m = $_POST['id_m'];

		//TRAIGO TODOS LOS QUESOS DE ESA MESA PARA ASIGNARLES AL JURADO NUEVO
		$tqs = mysqli_query($con,"select * from puntaje p
									where id_mesa = $id_m 
									group by p.id_queso");

		while($tq = mysqli_fetch_array($tqs)){

			$id_q = $tq['id_queso'];
			$id_m_p = $tq['id_muestra_puntaje'];

		if ($id_m_p == '')
			$id_m_p = 'null';

		$agregar = "insert into puntaje(id_mesa,id_jurado,id_queso,id_muestra_puntaje) 
						values($id_m, $id_j, $id_q,$id_m_p)";
						
			
			mysqli_query($con,$agregar) or die (mysqli_error($con));
		}
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}

?>