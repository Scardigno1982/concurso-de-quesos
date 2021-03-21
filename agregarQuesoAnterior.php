<?php
	include "conexiones.php";
	if (isset($_GET['id_q'])){

                                $id_q = $_GET['id_q'];
				$check = mysqli_query($con,"select id_queso from queso where id_queso=$id_q") or die(mysqli_error($con));;
                                if (mysqli_num_rows($check) == 0){
	                                $insert = "insert into queso select * from queso_viejo where id_queso = $id_q"; 
        	                        mysqli_query($con, $insert) or die(mysqli_error($con));
					echo "<script type='text/javascript'>alert('Queso Agregado');</script>";
					echo "<script type='text/javascript'>window.opener.location.reload();</script>";
                                        echo "<script type='text/javascript'>window.location.href = 'traerQuesosAnteriores.php';</script>";
				}
				else{
                                        echo "<script type='text/javascript'>";
                                        echo "alert('El queso ya está asignado al concurso actual');";
                                        echo "window.location.href = 'traerQuesosAnteriores.php';";
                                        echo "</script>";
                                }
        			exit("El queso ha sido agregado");                        
	}
?>
