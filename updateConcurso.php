<?php
include "conexiones.php";
if (isset($_POST['id_c_ec'])) {
	/*$concursos_abiertos = mysqli_query($con,"select * from concurso where estado_concurso='Abierto'");
	if(mysqli_num_rows($concursos_abiertos) == 0){
		if (isset($_POST['e_c_ec']))
			$e_c = 'Abierto';
		        else
		$e_c = 'Cerrado';
    }
    else{
    		$e_c = 'Cerrado';	
    		echo "<script>";
					echo "alert('Esta mesa ya tiene asignados Jurados y Quesos.');";
				echo "</script>";

    }
*/

		$id_c = $_POST['id_c_ec'];
		$nom_c = $_POST['n_c_ec'];
		$l_c = $_POST['l_c_ec'];

		$update="update concurso set nombre_concurso = '$nom_c',lugar_concurso='$l_c' where id_concurso = $id_c";
	    mysqli_query($con, $update) or die (mysqli_error($con));
	
        header("Location: crearConcurso2.php");
}

?>
