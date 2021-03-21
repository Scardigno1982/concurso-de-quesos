<?php
include "conexiones.php";
$anterior = $_SERVER['HTTP_REFERER'];
if (isset($_POST['id_m'])){
	$id_muestra=$_POST['id_m'];
	
	$consulta = mysqli_query($con, "select * from puntaje where id_muestra_puntaje = $id_muestra group by id_muestra_puntaje");
	while ($c = mysqli_fetch_array($consulta)){
			for($i = 1; $i < 25; $i++){       
				$n_campo = $_POST['s$i'];
				
            	if ($c['campo'.$i] != null){

            		mysqli_query($con, "update puntaje set campo$i='$n_campo'
										where id_muestra_puntaje=$id_muestra");
                    
            	}
            }
	}
	header("Location: $anterior");

}
?>
