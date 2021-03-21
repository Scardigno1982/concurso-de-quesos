<?php
include "conexiones.php";
if (isset($_POST['n_m_em'])){
	$nom_m = $_POST['n_m_em'];
    $turno_m = $_POST['t_m_em'];
	$id_m_em = $_POST['id_m_em'];
	//echo "update queso set nombre_muestra='$nom_m', turno_muestra='$turno_m' where id_muestra=$id_m_em";
	mysqli_query($con, "update muestra set nombre_muestra='$nom_m' 
					where id_muestra=$id_m_em");

	/*for($i=1; $i<25; $i++){
		if(isset ($_POST['s'.$i])){
			$sel = $_POST['s'.$i];

			mysqli_query($con, "update puntaje set campo$i = '$sel'
							where id_muestra_puntaje = $id_m_em");
		}
	}*/

    header("Location: muestras.php");
}
?>
