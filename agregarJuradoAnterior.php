<?php
	include "conexiones.php";
	if (isset($_GET['id_j'])){

                                $id_j = $_GET['id_j'];
				//CHEQUEA QUE EL JURADO VIEJO NO TENGA MISMO USUARIO QUE ALGUN JURADO ACTUAL
				//$query = "select id_jurado from jurado where id_jurado=$id_j";
				//$query2 = "select id_jurado from jurado_viejo where id_jurado=$id_j";
				
				//Chequeo si el jurado que estoy trayendo no es ya jurado
				$check = mysqli_query($con,"select id_jurado from jurado where id_jurado=$id_j") or die(mysqli_error($con));;
				if (mysqli_num_rows($check) == 0){
                                	//$insert = "insert into jurado select null,nombre_jurado, id_usuario,id_empresa_jurado from jurado_viejo where id_jurado = $id_j"; 
                                	$insert = "insert into jurado select * from jurado_viejo where id_jurado = $id_j"; 
                               		mysqli_query($con, $insert) or die(mysqli_error($con));
					echo "<script type='text/javascript'>";
					echo "alert('Jurado Agregado');";
					echo "window.opener.location.reload();";
					echo "window.location.href = 'traerJuradosAnteriores.php';";
					echo "</script>";
				}
				else{
					echo "<script type='text/javascript'>";
					echo "alert('El Jurado ya está asignado al concurso actual');";
					echo "window.location.href = 'traerJuradosAnteriores.php';";
					echo "</script>";
				}

                                
				//$delete = "delete from jurado_viejo where id_jurado = $id_j"; 
                                //mysqli_query($con, $delete) or die(mysqli_error($con));
        			
	}
?>
