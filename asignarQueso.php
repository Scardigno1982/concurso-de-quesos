<?php
include "conexiones.php";
$anterior = $_SERVER['HTTP_REFERER'];
if (isset($_GET['id_q'])){
	$id_mues = $_GET['id_mues'];
	$id_q = $_GET['id_q'];
	$id_mesa = $_GET['id_mesa'];


	//LE ASIGNO NOMBRE DE CAMPO IGUAL QUE EL RESTO EN LA MUESTRA
	/*$consulta = "select * from puntaje where id_muestra_puntaje = $id_mues group by id_muestra_puntaje";
	$camp = mysqli_query($con,$consulta);
	
	while($row = mysqli_fetch_array($camp)){
			for($i=1; $i<25; $i++){
				$c = $row["campo$i"];
				mysqli_query($con,"update puntaje set campo$i = '$c' where id_muestra_puntaje = $id_mues");
			}
	}*/
	

	//AGREGO A PUNTAJE EL ID DE MUESTRA
	mysqli_query($con, "update puntaje 
						set id_muestra_puntaje=$id_mues
						where id_queso=$id_q
						and id_mesa = $id_mesa");

    header("Location: $anterior");
}
?>
